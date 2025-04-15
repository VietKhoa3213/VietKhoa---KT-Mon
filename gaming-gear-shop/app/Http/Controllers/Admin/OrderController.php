<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order; 
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Mail\OrderStatusUpdated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue; 
use App\Mail\OrderPlaced;

class OrderController extends Controller
{
    
    public function index(Request $request, $status = null): View 
    {
        
        $statuses = Order::getAllStatuses(); 
        $allowedStatuses = array_keys($statuses); 

        $currentStatus = $request->query('status'); 

        if (!$currentStatus && $status) {
            $currentStatus = $status;
        }
 

        
        if ($currentStatus && !in_array($currentStatus, $allowedStatuses)) {
             $currentStatus = null;
        }

        $query = Order::with('user')->orderBy('created_at', 'desc');

        if ($currentStatus && in_array($currentStatus, $allowedStatuses)) {
            $query->where('shipping_status', $currentStatus);
        }

        $orders = $query->paginate(15)->appends($request->query());

        
        
        $currentStatusText = $currentStatus ? ($statuses[$currentStatus] ?? $currentStatus) : 'Tất cả';

        return view('admin.orders.index', compact(
            'orders',           
            'statuses',         
            'currentStatus',    
            'currentStatusText' 
        ));
    }

   
    public function show(Order $order): View 
    {
        $order->load(['user', 'orderDetails.product']); 


        return view('admin.orders.show', compact('order' ));
    }


public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $allowedStatuses = array_keys(Order::getAllStatuses());
        $validated = $request->validate([
            'status' => ['required', 'string', Rule::in($allowedStatuses)],
        ],[
            'status.required' => 'Vui lòng chọn trạng thái mới.',
            'status.in' => 'Trạng thái mới không hợp lệ.',
        ]);

        $newStatus = $validated['status'];
        $oldStatus = $order->shipping_status; 

        if ($newStatus !== $oldStatus) {
            Log::info("Admin User ID: " . Auth::id() . " updating Order ID: {$order->id} status from '{$oldStatus}' to '{$newStatus}'.");

            $order->shipping_status = $newStatus;

            if ($newStatus === Order::STATUS_DELIVERED) {

                 $order->payment_status = 'paid'; 
                 Log::info("Order ID {$order->id}: Payment status automatically set to 'paid' because shipping status is 'delivered'.");

            }

            try {
                $order->save();
                Log::info("Order ID {$order->id} saved successfully with new status.");
            } catch (\Exception $e) {
                 Log::error("Error saving order status update for Order ID {$order->id}: " . $e->getMessage());
                 return redirect()->back()->with('error', 'Lỗi khi lưu trạng thái đơn hàng.');
            }


          
            if (filter_var($order->customer_email, FILTER_VALIDATE_EMAIL)) {
                 try {
                     Log::info("Attempting to send Order Status Update email for Order ID {$order->id} to {$order->customer_email}. New status: {$newStatus}");
                     Mail::to($order->customer_email)->send(new OrderStatusUpdated($order));
                     Log::info("Order Status Update email sent successfully for Order ID {$order->id}.");
                 } catch (\Exception $mailEx) {
                     Log::error("Failed to send Order Status Update email for Order ID {$order->id}: " . $mailEx->getMessage());
                      return redirect()->route('admin.orders.index', ['status' => $newStatus])
                                     ->with('warning', "Cập nhật trạng thái ĐH #{$order->id} thành công, nhưng gửi email thất bại.");
                 }
            } else {
                 Log::warning("Order ID {$order->id}: Invalid customer email '{$order->customer_email}', skipping status update email.");
            }

             return redirect()->route('admin.orders.index', ['status' => $newStatus])
                            ->with('success', "Cập nhật trạng thái ĐH #{$order->id} thành công!");

        } else {
             Log::info("Admin User ID: " . Auth::id() . " attempted update for Order ID: {$order->id}, but status '{$newStatus}' was unchanged.");
             return redirect()->back()->with('info', "Trạng thái đơn hàng #{$order->id} không có gì thay đổi.");
        }
    } 


}