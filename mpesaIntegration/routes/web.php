<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MpesaController;

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
});

Route::get('/products',[MpesaController::class,'products']);



Route::get('/', function () {
    return view('welcome');
});

Route::get('/pay', function () {
    return view('pay');
});
Route::get('/confirm', function () {
    return view('confirm');
});
Route::post('/confirm', 'App\Http\Controllers\MpesaController@confirm')->name('confirm');





















//Stk Routing
// Route::get('/stk/push/simulation',[MpesaController::class,'stkSimulation']);
// Route::post('sts/access/token',[MpesaController::class,'generateAccessToken']);
// Route::post('sts/password/generate',[MpesaController::class,'generatePassword']);
// Route::post('sts/payment/confirmation',[MpesaController::class,'mpesaConfirmation']);
// Route::post('sts/validation',[MpesaController::class,'mpesaValidation']);
// Route::post('sts/register/urls',[MpesaController::class,'mpesaRegisterUrls']);
//



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');










