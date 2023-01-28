<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MasterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/clearcache', function ()
{
    Artisan::call('route:clear');
    Artisan::call('cache:clear');  
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    dd("All cache cleared successfully..!");
});

Route::post('/register',[UserController::class,'register'])->name('register');
Route::post('/login',[UserController::class,'login'])->name('login');

Route::middleware('auth:api')->group(function () {

    Route::post('/logout',[UserController::class,'logout'])->name('logout');
    # Products

    Route::post('/list-product',[MasterController::class,'list_product'])->name('list-product');
    Route::post('/save-product',[MasterController::class,'save_product'])->name('save-product');
    Route::post('/get-product',[MasterController::class,'get_product'])->name('get-product');
    Route::post('/delete-product',[MasterController::class,'delete_product'])->name('delete-product');

    #Frontend

    Route::post('/get-product-list',[MasterController::class,'getproductlist'])->name('get-product-list');
    Route::post('/add-product',[MasterController::class,'addproduct'])->name('add-product');
    Route::post('/place-order',[MasterController::class,'placeorder'])->name('place-order');
    Route::post('/get-card-list',[MasterController::class,'getcardlist'])->name('get-card-list');

    Route::post('/list-customers',[MasterController::class,'customerlist'])->name('list-customers');
    Route::post('/list-orders',[MasterController::class,'orderlist'])->name('list-orders');
});
