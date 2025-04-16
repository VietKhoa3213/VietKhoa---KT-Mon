<?php

namespace App\Http\Controllers;

use App\Models\Category; 
use App\Models\Product;  
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
   
    public function show(Category $category): View
    {
    
        $products = Product::where('category_id', $category->id)
                           ->where('status', true)
                           ->with('brand') 
                           ->latest()
                           ->paginate(12); 


        return view('categories.show', compact('category', 'products'));
    }

    public function getProductPreview(Category $category): View
{
    

    try { 
        $products = Product::where('category_id', $category->id)
                           ->where('status', true)
                           ->latest()
                           ->limit(4)
                           ->get();

      

        if (!view()->exists('partials.category_product_dropdown')) {
             Log::error('Partial view not found: partials.category_product_dropdown');
             return view('partials.ajax_error', ['message' => 'Lỗi giao diện xem trước.']);
        }

        return view('partials.category_product_dropdown', compact('category', 'products'));

    } catch (\Exception $e) {
        Log::error("Error in getProductPreview for Category ID {$category->id}: " . $e->getMessage());
         return view('partials.ajax_error', ['message' => 'Không thể tải dữ liệu sản phẩm.']);

    }
}

}
