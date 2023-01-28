<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Stormbreaker;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
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

Route::get('/clearcache', function ()
{
    Artisan::call('route:clear');
    Artisan::call('cache:clear'); 
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    dd("All cache cleared successfully..!");
});

Route::get('/', function () {
    // Session::flush();
    if(Session::get('isloged'))
    {
        if(Session::get('logedtype')=="customer")
        {
            return view('customer.dashboard');
        }
        else
        {
            return view('product.list');
        }
    } 
    else
    {
       return view('layout.login'); 
    }
    
});

Route::get('/googlelogin',[UserController::class,'redirectToGoogle'])->name('googlelogin');
Route::get('/googlecallback',[UserController::class,'handleGoogleCallback'])->name('googlecallback');


Route::middleware([Stormbreaker::class])->group(function()
{
    // Route::get('/dashboard', function () { return view('layout.dashboard'); });
    Route::get('/products', function () { return view('product.list'); });
    Route::get('/form-product/{ref}', function () { return view('product.form'); });

    Route::get('/customers', function () { return view('admin.customer'); });
    Route::get('/orders', function () { return view('admin.order'); });

    Route::get('/customer-dashboard', function () { return view('customer.dashboard'); });
    Route::get('/my-orders', function () { return view('customer.order'); });
    Route::get('/payment',[CustomerController::class,'payment'])->name('payment');
    Route::get('/paymentpage', function () { return view('customer.payment'); });
    Route::post('/paymentresponse',[CustomerController::class,'paymentresponse'])->name('paymentresponse');
});
 