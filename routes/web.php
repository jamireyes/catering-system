<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use App\Notifications\WelcomeUser;


Auth::routes();

Route::get('/', [PageController::class, 'homepage'])->name('welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('shop', ShopController::class)->only(['index', 'show']);
Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController');
	Route::post('user/{user}/restore', 'App\Http\Controllers\UserController@restore')->name('user.restore');

	Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
	Route::get('checkout/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm');

	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	Route::resource('category', CategoryController::class);
	Route::post('category/{category}/restore', [CategoryController::class, 'restore'])->name('category.restore');
	
	Route::resource('item', ItemController::class);
	Route::post('item/{item}/restore', [ItemController::class, 'restore'])->name('item.restore');
	Route::resource('order', OrderController::class);
	Route::resource('package', PackageController::class);
	Route::post('package/{package}/restore', [PackageController::class, 'restore'])->name('package.restore');
});

Route::get('send', function () {
	$user = App\Models\User::find(22);
	$user->notify(new WelcomeUser($user));
});


