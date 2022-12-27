<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserController;
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
Route::get('/', [AuthController::class, 'login'])->name('login');


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/location', [LocationController::class, 'index'])->name('location.index');
Route::post('/data-location', [LocationController::class, 'index'])->name('location.data');
Route::post('/location/store', [LocationController::class, 'store'])->name('location.store');
Route::put('/location/update', [LocationController::class, 'update'])->name('location.update');
Route::delete('/location/delete', [LocationController::class, 'delete'])->name('location.delete');

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::put('/category/update', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/delete', [CategoryController::class, 'delete'])->name('category.delete');

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::put('/user/update', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/delete', [UserController::class, 'delete'])->name('user.delete');