<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {

        
        $products = Product::where('status', true)
                           ->with(['category', 'brand']) 
                           ->latest() 
                           ->paginate(16); 

        $wishlistedIds = [];
                           if (auth()->check()) {
                               $wishlistedIds = auth()->user()->wishlistedProducts()->pluck('products.id')->toArray();
                           }

        return view('products.index', compact('products', 'wishlistedIds'));
    }
    
    public function show(Product $product): View
    {
        if (!$product->status) { abort(404); }
    
        $product->load(['category', 'brand', 'reviews.user']);
    
        $relatedProducts = Product::where('status', true)
            ->where('id', '!=', $product->id)
            ->where(function($query) use ($product) {
                $query->where('brand_id', $product->brand_id)
                      ->orWhere('category_id', $product->category_id);
            })
            ->inRandomOrder()
            ->limit(4)
            ->get();
    
        return view('products.show', compact('product', 'relatedProducts'));
    }
}
