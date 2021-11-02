<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CountryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\CoupenController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\OrderController;


/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register backend routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {

    Route::prefix('user')->group(function () {

    });

    // Dashboard routes
    Route::post('/mark-notification', [DashboardController::class, 'markNotification'])->name('mark.notification');

    // Activity Logs
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity.logs');
    Route::get('/activity-logs-delete/{id}', [ActivityLogController::class, 'delete'])->name('activity.logs.delete');

    // Country routes
    Route::get('/countries', [CountryController::class, 'index'])->name('countries');
    Route::get('/country-edit/{id}', [CountryController::class, 'edit'])->name('country.edit');
    Route::post('/country-update', [CountryController::class, 'update'])->name('country.update');
    Route::get('/country-delete/{id}', [CountryController::class, 'delete'])->name('country.delete');

    // Category routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/category-create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category-store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category-edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category-update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category-delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    // Sub Category routes
    Route::get('/subcategories', [SubCategoryController::class, 'index'])->name('subcategories');
    Route::get('/subcategory-create', [SubCategoryController::class, 'create'])->name('subcategory.create');
    Route::post('/subcategory-store', [SubCategoryController::class, 'store'])->name('subcategory.store');
    Route::get('/subcategory-edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::post('/subcategory-update', [SubCategoryController::class, 'update'])->name('subcategory.update');
    Route::get('/subcategory-delete/{id}', [SubCategoryController::class, 'delete'])->name('subcategory.delete');

    // Blog routes
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
    Route::get('/blog-create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog-store', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog-edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/blog-update', [BlogController::class, 'update'])->name('blog.update');
    Route::get('/blog-delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');
    Route::post('/slug-check', [BlogController::class, 'checkSlugInDb'])->name('slug.check');

    // Product routes
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/products-create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product-slug-check', [ProductController::class, 'checkSlugInDb'])->name('product-slug.check');
    Route::post('/code-check', [ProductController::class, 'checkCodeInDb'])->name('code.check');
    Route::post('/product-store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product-edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product-update', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product-delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    // Coupen Routes
    Route::get('/coupens', [CoupenController::class, 'index'])->name('coupens');
    Route::get('/coupen-create', [CoupenController::class, 'create'])->name('coupen.create');
    Route::post('/coupen-store', [CoupenController::class, 'store'])->name('coupen.store');
    Route::get('/coupen-edit/{id}', [CoupenController::class, 'edit'])->name('coupen.edit');
    Route::post('/coupen-update', [CoupenController::class, 'update'])->name('coupen.update');
    Route::get('/coupen-delete/{id}', [CoupenController::class, 'delete'])->name('coupen.delete');

    // Currency routes
    Route::get('/currencies', [CurrencyController::class, 'index'])->name('currencies');
    Route::get('/currency-create', [CurrencyController::class, 'create'])->name('currency.create');
    Route::post('/currency-store', [CurrencyController::class, 'store'])->name('currency.store');
    Route::get('/currency-edit/{id}', [CurrencyController::class, 'edit'])->name('currency.edit');
    Route::post('/currency-update', [CurrencyController::class, 'update'])->name('currency.update');
    Route::get('/currency-delete/{id}', [CurrencyController::class, 'delete'])->name('currency.delete');

    // Friday mode routes
    //Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::get('/friday-mode-update', [SettingController::class, 'index'])->name('friday-mode.update');

    // Setting routes
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::get('/settings-update', [SettingController::class, 'index'])->name('settings.update');

    // Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/settings-update', [OrderController::class, 'index'])->name('settings.update');

});
