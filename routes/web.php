<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\CurrencyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Controllers\FrontEnd\FrontEndController::class, 'home'])->name('home');
Route::get('/terms-and-conditions', [Controllers\FrontEnd\FrontEndController::class, 'termsAndConditions'])->name('termsAndConditions');
Route::get('/privacy', [Controllers\FrontEnd\FrontEndController::class, 'privacy'])->name('privacy');
Route::get('/faqs', [Controllers\FrontEnd\FrontEndController::class, 'faqs'])->name('faqs');
Route::get('/contact-us', [Controllers\FrontEnd\FrontEndController::class, 'contactUs'])->name('contactUs');
Route::post('/ajax/sendEmail', [Controllers\FrontEnd\FrontEndController::class, 'sendEmail']);
Route::get('/blog', [Controllers\FrontEnd\FrontEndController::class, 'blogs'])->name('frontend.blogs');
Route::get('/shop', [Controllers\FrontEnd\ProductController::class, 'index'])->name('frontend.products');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Social login start
Route::get('auth/social', [Controllers\SocialLoginController::class, 'show'])->name('social.login');
Route::get('oauth/{driver}', [Controllers\SocialLoginController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('oauth/{driver}/callback', [Controllers\SocialLoginController::class, 'handleProviderCallback'])->name('social.callback');
// Social login end

// Start: Cart Routes
Route::get('/ajax/add-to-cart/{product_id}', [Controllers\FrontEnd\CartController::class, 'addToCart'])->name('add.to.cart');
Route::get('/cart/add-item/{product_id}', [Controllers\FrontEnd\CartController::class, 'addItemToCart'])->name('cart.add_item');
Route::get('/ajax/get-cart-list', [Controllers\FrontEnd\CartController::class, 'getCartList'])->name('get.cart.list');
Route::get('/cart-view', [Controllers\FrontEnd\CartController::class, 'viewCartList'])->name('cart.view');
Route::get('/cart-remove-item/{id}', [Controllers\FrontEnd\CartController::class, 'removeCartItem'])->name('cart.remove.item');
// End: Cart Routes

// Start: WishList Routes
Route::get('/ajax/add-to-wishlist/{product_id}', [Controllers\FrontEnd\WishListController::class, 'addToWishList'])->name('add.to.wishlist');
Route::get('/favourites', [Controllers\FrontEnd\WishListController::class, 'viewWishList'])->name('wishlist.view');
Route::get('/favourites-clear', [Controllers\FrontEnd\WishListController::class, 'clearWishlist'])->name('wishlist.clear');
// End: WishList Routes

// Start: Product Routes
Route::get('/product-detail/{id}', [Controllers\FrontEnd\ProductController::class, 'showProductDetail'])->name('product.show.detail');
// End: Product Routes

// Apply Coupen
Route::post('/cart/apply-coupen', [Controllers\FrontEnd\ProductController::class, 'applyCoupen'])->name('apply.coupen');

// Start: Order Routes
Route::post('/order-store', [Controllers\OrderController::class, 'store'])->name('order.store');
// End: Order Routes


// Start: Checkout Routes
Route::get('/checkout', [Controllers\FrontEnd\CheckoutController::class, 'viewCheckout'])->name('checkout.view');
Route::get('paypal/checkout/{order}', [Controllers\FrontEnd\CheckoutController::class, 'getExpressCheckout'])->name('paypal.checkout');
Route::get('paypal/checkout-success/{order}', [Controllers\FrontEnd\CheckoutController::class, 'getExpressCheckoutSuccess'])->name('paypal.success');
Route::get('paypal/checkout-cancel', [Controllers\FrontEnd\CheckoutController::class, 'cancelPage'])->name('paypal.cancel');
// End: Checkout Routes

// Order Complete
// Under cons.....................
Route::get('order/complete/{order}', [Controllers\OrderController::class, 'getOrderComplete'])->name('order.complete');

// Language Switcher
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

// Currency converter
Route::post('/currency-load', [CurrencyController::class, 'loadCurrency'])->name('currency.load');
Route::get('currency-converter', [Controllers\SiteFunctionsController::class, 'getExchangeRates'])->name('currency.converter');

// Start: Invoice Routes
Route::get('/test-invoice', [Controllers\InvoiceController::class, 'test'])->name('invoice.test');
Route::get('/order-invoice/{order_number}', [Controllers\InvoiceController::class, 'orderInvoice'])->name('invoice.order');
// End: Invoice Routes
