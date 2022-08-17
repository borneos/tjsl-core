<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api\V1'], function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', 'CategoryController@get_categories');
    });
    Route::prefix('blog-categories')->group(function () {
        Route::get('/', 'BlogCategoryController@get_blog_categories');
    });
});
