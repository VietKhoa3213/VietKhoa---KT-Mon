<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
    
    public function index(): View
    {
        $user = Auth::user();
        $wishlistedProducts = $user->wishlistedProducts()
                                   ->with(['category', 'brand']) 
                                   ->latest('wishlists.created_at') 
                                   ->paginate(10); 

        return view('wishlist.index', compact('wishlistedProducts'));
    }

   
    public function add(Request $request, Product $product): RedirectResponse
    {
        $user = Auth::user(); 

        
        Log::info("Wishlist Add Attempt: User={$user->id}, Product={$product->id}");

        if (!$product || !$product->status) {
            Log::warning("Wishlist Add Failed: Product invalid/inactive (ID:{$product->id})");
            return redirect()->back()->with('error', 'Sản phẩm không hợp lệ.');
        }

        try {
            $user->wishlistedProducts()->attach($product->id);
            Log::info("Wishlist Add Success: User={$user->id}, Product={$product->id}");
            return redirect()->back()->with('success', 'Đã thêm "' . $product->name . '" vào yêu thích!');

        } catch (\Exception $e) {
            Log::error("Wishlist Add Exception: User={$user->id}, Product={$product->id}. Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Lỗi khi thêm vào yêu thích.');
        }
    }
    
    public function remove(Request $request, Product $product): RedirectResponse
    {
        $user = Auth::user();

        try {
            $deleted = $user->wishlistedProducts()->detach($product->id);

            if ($deleted) { 
                return redirect()->back()->with('success', 'Đã xóa "' . $product->name . '" khỏi danh sách yêu thích.');
            } else {
                 return redirect()->back()->with('info', 'Sản phẩm không có trong danh sách yêu thích.');
            }
        } catch (\Exception $e) {
            Log::error("Error removing product {$product->id} from wishlist for user {$user->id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa khỏi yêu thích.');
        }
    }
}
