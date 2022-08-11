<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Landing;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/logout', function () {
    auth()->logout();
    return redirect()->route('login');
});



Auth::routes();

Route::get('/', 'LandingController@index')->name('index');
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
