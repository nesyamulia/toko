<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\RedirectInactiveUser;
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


// Route untuk Admin
// Route::group(['middleware' => 'auth'], function () {
    // Route Admin Panel
    Route::resource('dashboard', \App\Http\Controllers\Admin\DashboardController::class);
    Route::resource('product-category', \App\Http\Controllers\Admin\ProductCategoryController::class);
    Route::resource('product', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('product-review', \App\Http\Controllers\Admin\ProductReviewController::class);
    Route::resource('wishlist', \App\Http\Controllers\Admin\WishlistController::class);
    Route::resource('discount-category', \App\Http\Controllers\Admin\DiscountCategoryController::class);
    Route::resource('discount', \App\Http\Controllers\Admin\DiscountController::class);
    Route::resource('order', \App\Http\Controllers\Admin\OrderController::class);
    Route::resource('order-detail', \App\Http\Controllers\Admin\OrderDetailController::class);
    Route::resource('delivery', \App\Http\Controllers\Admin\DeliveryController::class);
    Route::resource('payment', \App\Http\Controllers\Admin\PaymentController::class);
    // Route::middleware('check.role')->group(function () {
        Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('customer', \App\Http\Controllers\Admin\CustomerController::class);
    // });
// });

// Route Hak Akses 
// Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route Frontend untuk Customer 
// Route::group(['middleware' => 'auth:customers'], function () {
    Route::resource('cart', \App\Http\Controllers\Frontend\CartController::class);
    Route::resource('checkout', \App\Http\Controllers\Frontend\CheckoutController::class);
    Route::resource('category', \App\Http\Controllers\Frontend\CategoryController::class);
    Route::resource('contact', \App\Http\Controllers\Frontend\ContactController::class);
    Route::resource('single-product', \App\Http\Controllers\Frontend\SingleproductController::class);
    Route::resource('tracking', \App\Http\Controllers\Frontend\TrackingController::class);    
    Route::resource('home-page', \App\Http\Controllers\Frontend\LandingpageController::class);
    Route::resource('wishlist-product', \App\Http\Controllers\Frontend\WishlistproductController::class);
// });


Route::resource('/', \App\Http\Controllers\Frontend\LandingpageController::class);

?>
