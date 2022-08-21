<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/logout', function () {
    auth()->logout();
    return redirect()->route('login');
});

Auth::routes();

Route::namespace('Admin')->middleware('auth')->group(function () {
    Route::prefix('category')->group(function () {
        Route::get('/', 'CategoryController@index')->name('admin.category.index');
        Route::get('/add', 'CategoryController@add')->name('admin.category.add');
        Route::post('/add', 'CategoryController@store')->name('admin.category.store');
        Route::get('/edit/{category:slug}', 'CategoryController@edit')->name('admin.category.edit');
        Route::put('/edit/{category:slug}', 'CategoryController@update')->name('admin.category.update');
        Route::delete('/{category:id}', 'CategoryController@delete')->name('admin.category.delete');
    });
    Route::prefix('merchant')->group(function () {
        Route::get('/', 'MerchantController@index')->name('admin.merchant.index');
    });
    Route::prefix('blog-category')->group(function () {
        Route::get('/', 'BlogCategoryController@index')->name('admin.blog-category.index');
        Route::get('/add', 'BlogCategoryController@add')->name('admin.blog-category.add');
        Route::post('/add', 'BlogCategoryController@store')->name('admin.blog-category.store');
        Route::get('/edit/{category:slug}', 'BlogCategoryController@edit')->name('admin.blog-category.edit');
        Route::put('/edit/{category:slug}', 'BlogCategoryController@update')->name('admin.blog-category.update');
        Route::delete('/{category:id}', 'BlogCategoryController@delete')->name('admin.blog-category.delete');
    });
    Route::prefix('blog')->group(function () {
        Route::get('/', 'BlogController@index')->name('admin.blog.index');
        Route::get('/status/{id}/{status}', 'BlogController@blog_status')->name('admin.blog.status');
        Route::get('/add', 'BlogController@add')->name('admin.blog.add');
        Route::post('/add', 'BlogController@store')->name('admin.blog.store');
        Route::get('/edit/{blog:slug}', 'BlogController@edit')->name('admin.blog.edit');
        Route::put('/edit/{blog:slug}', 'BlogController@update')->name('admin.blog.update');
        Route::delete('/{blog:id}', 'BlogController@delete')->name('admin.blog.delete');
    });
    Route::prefix('product')->group(function () {
        Route::get('/', 'ProductController@index')->name('admin.product.index');
        Route::get('/status/{id}/{status}', 'ProductController@product_status')->name('admin.product.status');
        Route::get('/add', 'ProductController@add')->name('admin.product.add');
        Route::post('/add', 'ProductController@store')->name('admin.product.store');
    });
});

Route::get('/', 'LandingController@index')->name('index');
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
