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
    });
});

Route::get('/', 'LandingController@index')->name('index');
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
