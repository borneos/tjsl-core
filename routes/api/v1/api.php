<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api\V1'], function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', 'CategoryController@get_categories');
    });
    Route::prefix('blogs')->group(function () {
        Route::get('/', 'BlogController@get_blog_list');
    });
    Route::prefix('blog-categories')->group(function () {
        Route::get('/', 'BlogCategoryController@get_blog_categories');
    });
    Route::prefix('merchants')->group(function () {
        Route::get('/', 'MerchantController@get_merchants');
    });
});
