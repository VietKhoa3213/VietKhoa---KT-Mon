<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use App\Models\Category;
use Illuminate\Support\Facades\Log;  
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Arr; 
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    
   public function boot(): void
    {
        View::composer(['layout.master', 'partials.header', 'layout_admin.header', 'layout.master',            
        'partials.header',          
        'store.home',               
        'products.index',           
        'products.show',            
        'categories.show',          
        'brands.show',              
        'partials.product_card' ], function ($view) {
        $sharedData['wishlistedIds'] = [];
        $sharedData['wishlistCount'] = 0; 
        if (Auth::check()) {
            $userId = Auth::id();
            try {
                $ids = \App\Models\Wishlist::where('user_id', $userId)->pluck('product_id')->toArray();
                $count = count($ids); 

                Log::info("ViewComposer SHARE: User={$userId}, WishlistIDs=" . json_encode($ids) . ", CalculatedCount={$count}");

                $sharedData['wishlistedIds'] = $ids;
                $sharedData['wishlistCount'] = $count; 
            } catch (\Exception $e) {
                Log::error("ViewComposer - Error fetching wishlist data for user {$userId}: " . $e->getMessage());
                $sharedData['wishlistedIds'] = [];
                $sharedData['wishlistCount'] = 0;
            }
        }

            $view->with($sharedData);
            try {
                $categoriesForMenu = Category::orderBy('name', 'asc')->get();
                $view->with('categoriesForMenu', $categoriesForMenu);
            } catch (\Exception $e) {
                Log::error("ViewComposer - Error fetching categories: " . $e->getMessage());
                $view->with('categoriesForMenu', collect());
            }

            try {
                $brandsForMenu = Brand::orderBy('name', 'asc')->get();
                $view->with('brandsForMenu', $brandsForMenu);
            } catch (\Exception $e) {
                Log::error("ViewComposer - Error fetching brands: " . $e->getMessage());
                $view->with('brandsForMenu', collect());
            }
            // try {
            //     $brandsForMenu = Brand::orderBy('name', 'asc')->get();
            //     $sharedData['allBrandsForMenu'] = Brand::orderBy('name', 'asc')->get();
            // } catch (\Exception $e) {
            //      Log::error("ViewComposer - Error fetching brands: " . $e->getMessage());
            //      $sharedData['allBrandsForMenu'] = collect(); 
            // }


            try {
                $cartItems = Session::get('cart', []); 
                $cartItemCount = 0; 
                $cartSubtotal = 0;  

                if (is_array($cartItems)) {
                    foreach ($cartItems as $id => $details) {
                        $itemQuantity = $details['quantity'] ?? 0;
                        $itemPrice = $details['price'] ?? 0;

                        $cartItemCount += $itemQuantity;
                        $cartSubtotal += ($itemQuantity * $itemPrice);
                    }
                } else {
                     $cartItems = [];
                     Log::warning('Session cart data is not an array in ViewComposer.');
                }

                $view->with('cartItems', $cartItems);           
                $view->with('cartItemCount', $cartItemCount);   
                $view->with('cartSubtotal', $cartSubtotal);     

            } catch (\Exception $e) {
                 Log::error("ViewComposer - Error processing cart data: " . $e->getMessage());
                 $view->with('cartItems', []);
                 $view->with('cartItemCount', 0);
                 $view->with('cartSubtotal', 0);
            }

            

        }); 
    }
}
