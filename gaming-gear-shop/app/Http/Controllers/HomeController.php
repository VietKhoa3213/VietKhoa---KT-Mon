<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use Illuminate\Http\Request; 
use Illuminate\View\View; 
use App\Models\Category;   
use App\Models\News;
use App\Models\Slide;
use App\Models\Brand;

class HomeController extends Controller 
{
   
    public function index(): View 
    {

        $latestProducts = Product::with(['category', 'brand']) 
                               ->where('status', true)        
                               ->orderBy('created_at', 'desc') 
                               // ->latest()
                               ->take(6)                      
                               ->get();                        

        $featuredProducts = Product::with(['category', 'brand'])
                                 ->where('status', true)
                                 ->where('is_featured', true)   
                                 ->latest()
                                 ->take(6)
                                 ->get();

        $categories = Category::orderBy('name', 'asc') 
                                 
                                ->get();

        $recentNews = News::where('status', true) 
                                ->latest() 
                                ->limit(3)  
                                ->get();

        $slides = Slide::where('status', true)
                                ->orderBy('sort_order', 'asc')
                                ->limit(5) 
                                ->get();
        $discountedProducts = Product::with(['category', 'brand'])
                                ->where('status', true)         // Đang bán
                                ->whereNotNull('discount_price') // Có giá khuyến mãi
                                ->where('discount_price', '>', 0) // Giá > 0
                                ->whereColumn('discount_price', '<', 'price') // Giá KM < Giá gốc
                                ->orderBy('updated_at', 'desc') // Ưu tiên SP mới cập nhật KM
                                ->limit(6) // Lấy 8 sản phẩm KM
                                ->get();
        $brandsForMenu = Brand::orderBy('name', 'asc')
                                // ->where('status', true) // If brands have status
                                // ->where('is_featured', true) // If you want only featured brands
                                ->limit(12) // Limit if needed
                                ->get();


        
            return view('store.home', [ 
                'latestProducts'   => $latestProducts,
                'featuredProducts' => $featuredProducts,
                'discountedProducts' => $discountedProducts,
                'categories'       => $categories, 
                'recentNews'       => $recentNews,
                'slides'           => $slides,
                'brandsForMenu'    => $brandsForMenu,
            ]);

       
    }
}