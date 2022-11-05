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
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


Auth::routes();

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
 
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



Route::get('/', [PageController::class, 'homepage'])->name('welcome');
Route::resource('shop', ShopController::class)->only(['index', 'show']);
Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::group(['middleware' => ['auth', 'verified']], function () {
	Route::get('/home', [HomeController::class, 'index'])->name('home');
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


