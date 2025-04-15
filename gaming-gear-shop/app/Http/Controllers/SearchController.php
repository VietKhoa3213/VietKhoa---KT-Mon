<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request; 
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session; 

class SearchController extends Controller
{
    public function index(Request $request): View 
    {
     
        $request->validate(['query' => 'required|string|max:100|min:1'],[
            'query.required' => 'Vui lòng nhập từ khóa tìm kiếm.',
            'query.min' => 'Từ khóa tìm kiếm quá ngắn.',
            'query.max' => 'Từ khóa tìm kiếm quá dài.',
        ]);
        $query = $request->input('query');

        $productsQuery = Product::where('status', true) 
                             ->where(function ($q) use ($query) {
                                 $q->where('name', 'LIKE', "%{$query}%")
                                   ->orWhere('description', 'LIKE', "%{$query}%")
                                   ->orWhereHas('brand', function($bq) use ($query){
                                        $bq->where('name', 'LIKE', "%{$query}%");
                                   })
                                   ->orWhereHas('category', function($cq) use ($query){
                                        $cq->where('name', 'LIKE', "%{$query}%");
                                   });
                             })
                             ->with(['category', 'brand']); 

        $products = $productsQuery->latest()->paginate(16)->withQueryString();

         $wishlistedIds = [];
         if (Auth::check()) {
             $wishlistedIds = Auth::user()->wishlistedProducts()->pluck('products.id')->toArray();
         }

        return view('search.results', compact('products', 'query', 'wishlistedIds'));
    }
}