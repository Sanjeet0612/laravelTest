<?php

use Illuminate\Support\Facades\Route;

// Admin Section
use App\Http\Controllers\Admin\AdminAuthenticationController;

use App\Http\Controllers\Admin\ProductController;



Route::get('/', function () {
    return view('welcome');
});





// Admin Section
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('admin-login',[AdminAuthenticationController::class,'showAdminLogin'])->name('admin_login');
    Route::post('admin-login',[AdminAuthenticationController::class,'admin_login']);

    Route::middleware('auth:admin')->group(function () {
        Route::get('admin-dashboard',[AdminAuthenticationController::class,'admin_dashboard'])->name('admin_dashboard');
        Route::get('admin-profile',[AdminAuthenticationController::class,'admin_profile'])->name('admin_profile');
        Route::post('update-profile',[AdminAuthenticationController::class,'update_profile'])->name('update_profile');
        Route::post('update-password',[AdminAuthenticationController::class,'update_password'])->name('update_password');
        Route::get('admin-logout',[AdminAuthenticationController::class,'admin_logout'])->name('admin_logout');
        // Setting Section
        Route::match(['get', 'post'], 'admin-setting', [AdminAuthenticationController::class, 'admin_setting'])->name('admin_setting');
       
        // Product Section 
        Route::match(['get', 'post'], 'products', [ProductController::class, 'products'])->name('products');
        Route::match(['get', 'post'], 'add-products', [ProductController::class, 'add_products'])->name('add_products');
        Route::post('getAttributeVal', [ProductController::class, 'getAttributeVal'])->name('getAttributeVal');
        Route::get('product/product_edit/{id}', [ProductController::class, 'product_edit'])->name('product.product_edit');
        Route::post('product/update_product/{id}', [ProductController::class, 'update_product'])->name('product.update_product');
        Route::get('product/product_delete/{id}', [ProductController::class, 'product_delete'])->name('product.product_delete');
        Route::get('product/image/delete/{id}', [ProductController::class, 'product_deleteImage'])->name('product.image.delete');
       
    });

});