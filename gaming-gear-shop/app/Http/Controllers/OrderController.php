<?php
namespace App\Http\Controllers; 

use App\Models\Order; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\View\View;
use Illuminate\Auth\Access\AuthorizationException;

class OrderController extends Controller
{
    /**
     * 
     *
     * @param Request $request 
     * @param Order $order 
     * @return View
     * @throws AuthorizationException
     */
    public function show(Request $request, Order $order): View
    {

        $loggedInUserId = $request->user()->id;
        if ($loggedInUserId !== $order->user_id) {

            abort(403, 'TRUY CẬP BỊ TỪ CHỐI');
        }

        $order->load([
            'orderDetails' => function($query) {
                $query->with('product:id,name,image'); 
            }

        ]);

        return view('orders.show', compact('order'));
    }
}