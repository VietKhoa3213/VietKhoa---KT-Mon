<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CartController extends Controller
{
    
    public function add(Request $request, Product $product): RedirectResponse 
    {
        $quantity = $request->input('quantity', 1);
        if (!is_numeric($quantity) || $quantity < 1) {
            return redirect()->back()->with('error', 'Số lượng không hợp lệ.');
        }
        $quantity = intval($quantity); 

        if (!$product || !$product->status) {
             return redirect()->back()->with('error', 'Sản phẩm không tồn tại hoặc đã ngừng bán.');
        }

        $cart = session()->get('cart', []);

        $currentQuantityInCart = $cart[$product->id]['quantity'] ?? 0; 
        $requestedTotalQuantity = $currentQuantityInCart + $quantity;

        if ($product->stock_quantity < $requestedTotalQuantity) {
            $canAdd = $product->stock_quantity - $currentQuantityInCart;
            if ($canAdd <= 0) {
                return redirect()->back()->with('error', "Sản phẩm {$product->name} đã hết hàng hoặc số lượng trong giỏ đã tối đa.");
            } else {
                 return redirect()->back()->with('error', "Chỉ có thể thêm tối đa {$canAdd} sản phẩm {$product->name} vào giỏ.");
            }
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
   
            $cart[$product->id] = [
                "id" => $product->id,
                "name" => $product->name, 
                "quantity" => $quantity,
                "price" => ($product->discount_price > 0 && $product->discount_price < $product->price) ? $product->discount_price : $product->price, 
                "image" => $product->image 
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
        
    }

    public function index(): View 
    {
        $cartItems = session()->get('cart', []);

        $cartTotals = $this->calculateCartTotals($cartItems);

        return view('cart.index', [
            'cartItems' => $cartItems,
            'cartSubtotal' => $cartTotals['subtotal'],
            'cartItemCount' => $cartTotals['count'] 
        ]);
    }

    public function update (Request $request, $productId): JsonResponse|RedirectResponse 
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) { 
                return response()->json(['success' => false, 'message' => $validator->errors()->first()], 422);
            } else { 
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        $newQuantity = (int)$request->input('quantity');
        $cart = session()->get('cart', []);

        if(isset($cart[$productId])) {
            $product = Product::find($productId);
            if (!$product) { 
                 unset($cart[$productId]);
                 session()->put('cart', $cart);
                 if ($request->expectsJson()) {  }
                 else { return redirect()->route('cart.index')->with('error', 'Sản phẩm không còn tồn tại.'); }
            }

            if ($product->stock_quantity < $newQuantity) {
                 $errMsg = "Số lượng tồn kho của {$product->name} không đủ (chỉ còn {$product->stock_quantity}).";
                 if ($request->expectsJson()) {  }
                 else { return redirect()->back()->with('error', $errMsg); }
            }

            $cart[$productId]['quantity'] = $newQuantity;
            session()->put('cart', $cart);

            if ($request->expectsJson()) { 
                $cartTotals = $this->calculateCartTotals($cart);
                return response()->json([
                    'success' => true,
                    'message' => 'Cập nhật giỏ hàng thành công!',
                    'itemId' => $productId,
                    'newItemSubtotalFormatted' => number_format($newQuantity * $cart[$productId]['price'], 0, ',', '.').'₫',
                    'newQuantity' => $newQuantity,
                    'cartItemCount' => $cartTotals['count'],
                    'cartSubtotalFormatted' => number_format($cartTotals['subtotal'], 0, ',', '.').'₫'
                ]);
            } else { 
                return redirect()->route('cart.index')->with('success', 'Đã cập nhật số lượng sản phẩm!');
            }

        } else {
             $errMsg = 'Sản phẩm không có trong giỏ hàng.';
             if ($request->expectsJson()) { }
             else { return redirect()->route('cart.index')->with('error', $errMsg); }
        }
    }

    public function remove(Request $request, $productId): JsonResponse|RedirectResponse 
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);

             if ($request->expectsJson()) { 
                $cartTotals = $this->calculateCartTotals($cart);
                return response()->json([
                    'success' => true,
                    'message' => 'Đã xóa sản phẩm khỏi giỏ hàng!',
                    'cartItemCount' => $cartTotals['count'],
                    'cartSubtotalFormatted' => number_format($cartTotals['subtotal'], 0, ',', '.').'₫'
                ]);
             } else {
                 return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
             }
        } else {
             $errMsg = 'Sản phẩm không có trong giỏ hàng.';
             if ($request->expectsJson()) { }
             else { return redirect()->route('cart.index')->with('error', $errMsg); }
        }
    }

   
    public function clear(): RedirectResponse 
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Đã xóa toàn bộ giỏ hàng!');
    }

     private function calculateCartTotals(array $cart): array
    {
        $cartItemCount = 0;
        $cartSubtotal = 0;
        foreach ($cart as $id => $details) {
            $cartItemCount += $details['quantity'] ?? 0;
            $cartSubtotal += ($details['quantity'] ?? 0) * ($details['price'] ?? 0);
        }
        return ['count' => $cartItemCount, 'subtotal' => $cartSubtotal];
    }
}
