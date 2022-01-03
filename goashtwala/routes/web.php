<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\IndexController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\back\HomeadminController;
use App\Http\Controllers\back\CategoryController;
use App\Http\Controllers\back\ListController;
use App\Http\Controllers\back\CustomerController;
use App\Http\Controllers\back\OrderController;

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
Route::get('/clear-data-admin', function() {

Artisan::call('cache:clear');
Artisan::call('config:cache');
Artisan::call('route:clear');
return "Cleared!";
});
Route::group(['middleware' => ['throttle:60,1'],
              'namespace' => 'front'], function(){

    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/about', [IndexController::class, 'about'])->name('about');
    Route::get('/contact', [IndexController::class, 'contact'])->name('contact');
    Route::get('/menu', [IndexController::class, 'menu'])->name('menu');
    Route::get('/get-price', [CartController::class, 'getprice'])->name('get-price');
    Route::post('/cart/count', [CartController::class, 'count']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::get('/view-cart', [CartController::class, 'cart']);
    Route::delete('/cart/meat-delete/{id}',[CartController::class, 'cartmeatdelete']);
    Route::post('/cart/food-update-plus/{id}',[CartController::class, 'cartmeatupdateplus']);
    Route::post('/cart/food-update-minus/{id}',[CartController::class, 'cartmeatupdateminus']);
   
});
Route::group([
	'middleware' => 'throttle:60,1',
    'prefix' => 'user-area',
    'as' => 'user.',
    'namespace' => 'Front',
    'middleware' => ['can:isUser', 'preventbackbutton', 'auth']
], function () {
    Route::get('/account', [HomeController::class, 'index'])->name('home');
    Route::get('/order-history', [HomeController::class, 'orderhistory'])->name('order-history');
    Route::match(['get','post'],'/personal-detail', [HomeController::class, 'personaldetail'])->name('personal-detail');
    Route::match(['get','post'],'/change-password', [HomeController::class, 'changepassword'])->name('change-password');
});
Route::group([
	'middleware' => 'throttle:60,1',
    'namespace' => 'Front',
    'middleware' => ['can:isUser', 'preventbackbutton', 'auth', 'checkoutguaid']
], function () {
	Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
	Route::post('/checkout', [CheckoutController::class, 'orderplace'])->name('checkout.orderplace');
});

Route::group([
	'middleware' => 'throttle:60,1',
    'prefix' => 'admin-area',
    'as' => 'admin.',
    'namespace' => 'back',
    'middleware' => ['can:isAdmin',  'preventbackbutton', 'auth']
], function () {

    Route::get('/account', [HomeadminController::class, 'index']);
    Route::match(['get','post'],'/personal-detail', [HomeadminController::class, 'personaldetail'])->name('personal-detail');
    Route::match(['get','post'],'/change-password', [HomeadminController::class, 'changepassword'])->name('change-password');

    //categories route
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::match(['get','post'],'/add-category', [CategoryController::class, 'addupdatecategory']);
    Route::match(['get','post'],'/update-category/{id}', [CategoryController::class, 'addupdatecategory']);
    Route::get('/category-all-delete/{id}', [CategoryController::class,'multipledelete']);

    //customer route
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::get('/customer-all-delete/{id}', [CustomerController::class,'multipledelete']);

    //categories route
    Route::get('/lists', [ListController::class, 'index']);
    Route::match(['get','post'],'/add-list', [ListController::class, 'addupdatelist']);
    Route::match(['get','post'],'/update-list/{id}', [ListController::class, 'addupdatelist']);
    Route::get('/list-all-delete/{id}', [ListController::class,'multipledelete']);
    Route::post('/update-top-list', [ListController::class,'updatetoplist']);

    //categories route
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/order-all-delete/{id}', [OrderController::class,'multipledelete']);
    Route::get('/view-order-detail/{id}',  [OrderController::class,'orderdetail']);
    Route::post('/order-status',  [OrderController::class,'orderstatuschange']);


});

Auth::routes();


