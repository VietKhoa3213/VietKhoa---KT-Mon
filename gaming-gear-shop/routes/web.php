<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CategoryController as FrontendCategoryController;
use App\Http\Controllers\ProductController as FrontendProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BrandController as FrontendBrandController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\ContactController; 
use App\Http\Controllers\ProfileController;
use App\Models\Order;
use App\Http\Controllers\OrderController as UserOrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'create'])->name('register');
    Route::post('register', [AuthController::class, 'store']); 

    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate']); 
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('admin')
     ->middleware(['auth', 'isAdmin'])
     ->name('admin.')
     ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('categories', CategoryController::class); 
        Route::resource('brands', BrandController::class); 
        Route::resource('products', ProductController::class); 
        Route::resource('users', UserController::class);
        Route::resource('news', NewsController::class);
        Route::resource('slides', SlideController::class);
        Route::get('orders/{status?}', [OrderController::class, 'index'])
             ->whereIn('status', array_keys(App\Models\Order::getAllStatuses())) 
             ->name('orders.index');
        Route::get('orders/show/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::patch('orders/update-status/{order}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
     });

     Route::get('/categories/{category}', [FrontendCategoryController::class, 'show'])->name('categories.show');
     Route::get('/category-product-preview/{category}', [FrontendCategoryController::class, 'getProductPreview'])
     ->name('category.product.preview');
     Route::get('/products/{product}', [FrontendProductController::class, 'show'])->name('products.show');
     Route::get('/shop', [FrontendProductController::class, 'index'])->name('products.index'); 


     Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{product}', [CartController::class, 'add'])->name('add'); 
        Route::patch('/update/{productId}', [CartController::class, 'update'])->name('update'); 
        Route::delete('/remove/{productId}', [CartController::class, 'remove'])->name('remove'); 
        Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
    });


    Route::get('/brands/{brand}', [FrontendBrandController::class, 'show'])->name('brands.show');

    Route::middleware(['cart.notempty'])->group(function () {
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
    });
    
    Route::get('/checkout/thank-you/{order}', [CheckoutController::class, 'thankYou'])->name('checkout.thankyou');

    
    Route::middleware(['auth']) 
    ->prefix('wishlist')
    ->name('wishlist.')
    ->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->name('index');
    Route::post('/add/{product}', [WishlistController::class, 'add'])->name('add'); 
    Route::delete('/remove/{product}', [WishlistController::class, 'remove'])->name('remove'); 
    });

    Route::get('/search', [SearchController::class, 'index'])->name('search'); 

    Route::get('/contact', [PageController::class, 'showContactForm'])->name('contact.create');
    Route::post('/contact', [PageController::class, 'storeContactForm'])->name('contact.store');


    Route::prefix('contacts')->name('contacts.')->group(function() {
        Route::get('/', [ContactController::class, 'index'])->name('index'); 
        Route::get('/{contact}/reply', [ContactController::class, 'replyForm'])->name('reply'); 
        Route::post('/{contact}/reply', [ContactController::class, 'sendReply'])->name('sendReply'); 
         Route::delete('/{contact}', [ContactController::class, 'destroy'])->name('destroy'); 
    });

    Route::middleware(['auth'])
    ->prefix('profile')
    ->name('profile.')
    ->group(function () {

       Route::get('/', [ProfileController::class, 'show'])->name('show');
       Route::patch('/', [ProfileController::class, 'update'])->name('update');

       Route::get('/orders', [ProfileController::class, 'orders'])->name('orders');
       Route::get('/orders/{order}', function (Order $order) {
        if (auth()->id() != $order->user_id) {
            abort(403, 'Unauthorized action.'); 
        }

        return "Đây là trang chi tiết cho Đơn hàng #" . $order->id . " (Sẽ làm sau)";
    })->name('orders.show');
   });

   Route::middleware(['auth'])->group(function () {
    Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');
});

Route::get('forgot-password', [AuthController::class, 'showLinkRequestForm'])->middleware('guest')->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])->middleware('guest')->name('password.email');
Route::get('reset-password/{token}', [AuthController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
Route::post('reset-password', [AuthController::class, 'storeNewPassword'])->middleware('guest')->name('password.store'); 


Route::post('/reviews/{product}', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');


Route::prefix('reviews')->name('reviews.')->group(function() {
    Route::get('/', [AdminReviewController::class, 'index'])->name('index');         
    Route::patch('/{review}/approve', [AdminReviewController::class, 'approve'])->name('approve');    
    Route::delete('/{review}', [AdminReviewController::class, 'destroy'])->name('destroy');   
    Route::patch('/{review}/reject',[ AdminReviewController::class, 'reject'])->name('reject');

});
