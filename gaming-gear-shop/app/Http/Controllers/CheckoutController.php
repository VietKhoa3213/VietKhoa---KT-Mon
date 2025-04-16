<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceOrderRequest; 
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Mail\OrderPlaced; 
use Illuminate\Support\Facades\Mail; 

class CheckoutController extends Controller
{
    
    public function index(): View|RedirectResponse
    {
        $cartItems = Session::get('cart', []);

        if (empty($cartItems)) {
            return redirect()->route('home')->with('error', 'Giỏ hàng trống, không thể thanh toán.');
        }

        $cartSubtotal = 0;
        foreach ($cartItems as $item) {
             $cartSubtotal += ($item['quantity'] ?? 0) * ($item['price'] ?? 0);
        }
         $shippingFee = 30000;
         $discountAmount = 0;
         $finalTotal = $cartSubtotal + $shippingFee - $discountAmount;


        $user = Auth::user(); 

        return view('checkout.index', compact('cartItems', 'cartSubtotal', 'shippingFee', 'discountAmount', 'finalTotal', 'user'));
    }

  
    public function placeOrder(PlaceOrderRequest $request): RedirectResponse
    {
        $cartItems = Session::get('cart', []);
        if (empty($cartItems)) {
            return redirect()->route('home')->with('error', 'Giỏ hàng trống!');
        }

        $validated = $request->validated();

        $customerInfo = [
            'name' => $validated['customer_name'] ?? Auth::user()?->name, 
            'email' => $validated['customer_email'] ?? Auth::user()?->email,
            'phone' => $validated['customer_phone'] ?? Auth::user()?->phone,
            'address' => $validated['customer_address'] ?? Auth::user()?->address,
            'note' => $validated['note'] ?? null,
            'user_id' => Auth::id(), 
        ];

        $cartSubtotal = 0;
        $productIds = array_keys($cartItems);
        $productsInCart = Product::whereIn('id', $productIds)->where('status', true)->get()->keyBy('id');

        if(count($productsInCart) != count($productIds)){
             return redirect()->route('cart.index')->with('error', 'Một số sản phẩm trong giỏ hàng không còn tồn tại hoặc đã ngừng bán.');
        }

        $orderTotalAmount = 0;
        $finalOrderDetails = [];

        foreach ($cartItems as $id => $item) {
             $product = $productsInCart->get($id);
             $requestedQuantity = $item['quantity'] ?? 0;

             if(!$product || $product->stock_quantity < $requestedQuantity) {
                 return redirect()->route('cart.index')->with('error', "Sản phẩm '" . ($product->name ?? $item['name']) . "' không đủ số lượng tồn kho (chỉ còn {$product->stock_quantity}).");
             }

             $currentPrice = ($product->discount_price > 0 && $product->discount_price < $product->price) ? $product->discount_price : $product->price;
             $itemTotal = $requestedQuantity * $currentPrice;
             $orderTotalAmount += $itemTotal;

             $finalOrderDetails[] = [
                 'product_id' => $id,
                 'quantity' => $requestedQuantity,
                 'price' => $currentPrice,
                 'product_name' => $product->name, 
             ];
        }

         $shippingFee = 30000; 
         $discountAmount = 0; 
         $finalTotal = $orderTotalAmount + $shippingFee - $discountAmount;

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => $customerInfo['user_id'],
                'customer_name' => $customerInfo['name'],
                'customer_email' => $customerInfo['email'],
                'customer_phone' => $customerInfo['phone'],
                'shipping_address' => $customerInfo['address'],
                'note' => $customerInfo['note'],
                'payment_method' => $validated['payment_method'],
                'total_amount' => $orderTotalAmount,
                'shipping_fee' => $shippingFee,
                'discount_amount' => $discountAmount,
                'final_amount' => $finalTotal,
                'shipping_status' => Order::STATUS_PENDING, 
                'payment_status' => 'unpaid', 
            ]);
            $orderCode = 'ORD-' . now()->format('Ymd') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT);
            $order->code = $orderCode;
            $order->save(); 
            Log::info("Generated and saved Order Code {$orderCode} for Order ID {$order->id}");

             foreach ($finalOrderDetails as &$detail) { 
                 $detail['order_id'] = $order->id;
             }
             unset($detail); 
            OrderDetail::insert($finalOrderDetails); 

            foreach ($cartItems as $id => $item) {
                Product::find($id)->decrement('stock_quantity', $item['quantity']);
            }

            Session::forget('cart');

            DB::commit();

            try {
                Log::info("Queueing Order Placed email for Order ID {$order->id} to {$order->customer_email}.");
                Mail::to($order->customer_email)->send(new OrderPlaced($order)); 
            } catch(\Exception $mailEx) {
                 Log::error("Checkout - Failed to queue Order Placed email...: " . $mailEx->getMessage());
            }
    
            return redirect()->route('checkout.thankyou', $order); 
    
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Order placement failed for user " . (Auth::id() ?? 'guest') . ": " . $e->getMessage());
            return redirect()->route('checkout.index')->with('error', 'Đã xảy ra lỗi nghiêm trọng khi đặt hàng: ' . $e->getMessage());
        }
    }

    
    public function thankYou(Order $order): View 
    {
         $order->load(['orderDetails.product']);
        return view('checkout.thankyou', compact('order'));
    }
}
