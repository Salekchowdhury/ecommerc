<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index']);

    // category route

    Route::controller(Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('admin.category.index');
        Route::get('/category/create', 'create')->name('admin.category.create');
        Route::post('/category', 'store')->name('admin.category.store');
        Route::get('/category/{category}/edit','edit');
        Route::put('/category/{category}','update');
    });
    Route::controller(Admin\ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('admin.products');
        Route::get('/products/create', 'create')->name('admin.product.create');
        Route::post('/products', 'store')->name('admin.product.store');
        Route::get('/products/{product_id}/edit', 'edit');
        Route::put('/product/update/{product_id}', 'update');
        Route::get('/product-image/{image_id}/delete', 'deleteImage');
        Route::get('/product/{product_id}/delete', 'destroyProduct');

    });

   Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class);

   Route::controller(Admin\ColorController::class)->group(function () {
    Route::get('/colors', 'index');
    Route::get('/colors/create', 'create');
    Route::post('/colors/store', 'store');
    Route::get('/colors/{color_id}/edit', 'edit');
    Route::put('/colors/{color_id}/update', 'update');
    Route::get('/colors/{color_id}/delete', 'delete');

});
});
