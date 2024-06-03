<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\CustomerRegisterController;
use App\Http\Controllers\Auth\CustomerLoginController;
use App\Http\Controllers\Frontend\WishlistproductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route register customer
Route::get('/customer/register', [CustomerRegisterController::class, 'showRegistrationForm'])->name('customer.register');
Route::post('/customer/register', [CustomerRegisterController::class, 'register'])->name('customer.register.post');

// Route login customer
Route::get('/customer/login', [CustomerLoginController::class, 'showLoginForm'])->name('customer.login');
Route::post('/customer/login', [CustomerLoginController::class, 'login'])->name('customer.login.post');
Route::get('/customer/logout', [CustomerLoginController::class, 'logout'])->name('customer.logout');

Route::post('/register', 'RegisterController@register')->name('register');



// Route untuk Admin
Route::group(['middleware' => 'auth'], function () {
    // Route Admin Panel
    Route::resource('dashboard', \App\Http\Controllers\Admin\DashboardController::class);
    Route::resource('product-category', \App\Http\Controllers\Admin\ProductCategoryController::class);
    Route::resource('product', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('product-review', \App\Http\Controllers\Admin\ProductReviewController::class);
    Route::resource('wishlist', \App\Http\Controllers\Admin\WishlistController::class);
    Route::resource('discount', \App\Http\Controllers\Admin\DiscountController::class);
    Route::resource('order', \App\Http\Controllers\Admin\OrderController::class);
    Route::resource('delivery', \App\Http\Controllers\Admin\DeliveryController::class);
    Route::resource('order', \App\Http\Controllers\Admin\OrderController::class)->only('index', 'edit');
    // Route::middleware('check.role')->group(function () {
        Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('customer', \App\Http\Controllers\Admin\CustomerController::class);
    // });
});

// Route Hak Akses 
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('category', \App\Http\Controllers\Frontend\CategoryController::class);
Route::resource('contact', \App\Http\Controllers\Frontend\ContactController::class);
Route::resource('single-product', \App\Http\Controllers\Frontend\SingleproductController::class);
Route::get('/single-product/{id}', 'Frontend\SingleproductController@show')->name('single-product');

// Route Frontend untuk Customer 
Route::group(['middleware' => 'auth:users'], function () {
    Route::get('/cart', [\App\Http\Controllers\frontend\CartController::class, 'cart'])->name('frontend.cart');
    Route::post('/add-to-cart', [\App\Http\Controllers\frontend\CartController::class, 'addCart'])->name('addCart');
    Route::post('/update-cart', [\App\Http\Controllers\frontend\CartController::class, 'updateCart'])->name('updateCart');
    Route::post('/delete-cart', [\App\Http\Controllers\frontend\CartController::class, 'deleteCart'])->name('deleteCart');
   
// Route discount
    Route::post('/apply-discount', [\App\Http\Controllers\frontend\CartController::class, 'applyDiscount'])->name('applyDiscount');
    Route::post('/remove-discount', [\App\Http\Controllers\frontend\CartController::class, 'removeDiscount'])->name('removeDiscount');

// Route checkout
    Route::get('/checkout', [\App\Http\Controllers\frontend\CartController::class, 'checkout'])->name('checkout');
    Route::post('/save-customer', [\App\Http\Controllers\frontend\CartController::class, 'saveCustomer'])->name('saveCustomer');
    Route::post('/process-checkout', [\App\Http\Controllers\frontend\CartController::class, 'processCheckout'])->name('processCheckout');
    Route::get('/success', [\App\Http\Controllers\frontend\CartController::class, 'success'])->name('success');
    Route::resource('tracking', \App\Http\Controllers\Frontend\TrackingController::class);    
    Route::resource('home-page', \App\Http\Controllers\Frontend\LandingpageController::class);

    // Route wishlist
    Route::get('wishlist', [\App\Http\Controllers\Frontend\WishlistproductController::class, 'index'])->name('wishlist');
    Route::post('/add-wishlist', [\App\Http\Controllers\Frontend\WishlistproductController::class, 'addWishlist'])->name('addWishlist');
    Route::delete('/remove-wishlist', [\App\Http\Controllers\Frontend\WishlistproductController::class, 'deleteWishlist'])->name('removeWishlist');
    Route::delete('/remove-all-wishlist', [\App\Http\Controllers\Frontend\WishlistproductController::class, 'removeAllWishlist'])->name('removeAllWishlist');
});


Route::resource('/', \App\Http\Controllers\Frontend\LandingpageController::class);

?>


