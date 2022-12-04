<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/location', [LocationController::class, 'index'])->name('location.index');
Route::post('/data-location', [LocationController::class, 'index'])->name('location.data');
Route::post('/location/store', [LocationController::class, 'store'])->name('location.store');
Route::put('/location/update', [LocationController::class, 'update'])->name('location.update');
Route::delete('/location/delete', [LocationController::class, 'delete'])->name('location.delete');
