<?php

use Illuminate\Support\Facades\Route;

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
})->name('welcome');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');;

Route::get('/store', function () {
    return view('store');
})->name('store');

Route::resource('checkout', 'App\Http\Controllers\CheckoutController')->only(['index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController');
	Route::post('user/{user}/restore', 'App\Http\Controllers\UserController@restore')->name('user.restore');

	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	// Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);

	Route::resource('category', 'App\Http\Controllers\CategoryController')->only(['index', 'store', 'update', 'destroy']);
	Route::post('category/{category}/restore', 'App\Http\Controllers\CategoryController@restore')->name('category.restore');
	
	Route::resource('inventory', 'App\Http\Controllers\ItemController');
	Route::resource('order', 'App\Http\Controllers\OrderController');
	Route::resource('package', 'App\Http\Controllers\PackageController');
});

// Route::get('package', ['as' => 'package.index', 'uses' => 'App\Http\Controllers\PackageController@index']);


