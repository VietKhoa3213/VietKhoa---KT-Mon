<?php

namespace App\Http\Controllers;

use App\Models\Brand;   
use App\Models\Product;  
use Illuminate\Http\Request;
use Illuminate\View\View; 

class BrandController extends Controller
{

    public function show(Brand $brand): View
    {
        $productsQuery = Product::where('brand_id', $brand->id) 
                                 ->where('status', true);         


        $products = $productsQuery->with('category') 
                                  ->latest('created_at') 
                                  ->paginate(12); 

        return view('brands.show', compact('brand', 'products'));
    }
}
