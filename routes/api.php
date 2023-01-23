<?php

use App\Http\Controllers\API\apiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//AUTH
Route::post('register', [apiController::class, 'registerUser']);
Route::post('login', [apiController::class, 'login']);

Route::middleware('auth:api')->group(function () {
	//master
    Route::get('location', [apiController::class, 'getLocation']);
    Route::post('category', [apiController::class, 'getCategory']);
    Route::post('item', [apiController::class, 'getItem']);
	Route::post('bank', [apiController::class, 'getBank']);
	
	//transaction
	Route::post('/order/add-item', [apiController::class, 'addItem']);
	Route::post('/order/delete-item', [apiController::class, 'deleteItem']);
	Route::post('/order/show-temp', [apiController::class, 'showOrderTemp']);
	Route::post('/order/submit', [apiController::class, 'submitOrder']);
	Route::post('/order/show', [apiController::class, 'showOrder']);
	Route::post('/order/show/detail', [apiController::class, 'showDetailOrder']);
	Route::post('/order/payment', [apiController::class, 'paymentOrder']);
});
