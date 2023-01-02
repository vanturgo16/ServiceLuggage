<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MappingCategoryController;
use App\Http\Controllers\MappingItemController;
use App\Http\Controllers\UserController;
use App\Models\MappingItem;
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

//Master Location
Route::get('/location', [LocationController::class, 'index'])->name('location.index');
Route::post('/data-location', [LocationController::class, 'index'])->name('location.data');
Route::post('/location/store', [LocationController::class, 'store'])->name('location.store');
Route::put('/location/update', [LocationController::class, 'update'])->name('location.update');
Route::delete('/location/delete', [LocationController::class, 'delete'])->name('location.delete');

//Master Category
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::put('/category/update', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/delete', [CategoryController::class, 'delete'])->name('category.delete');

//Master User Internal
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::put('/user/update', [UserController::class, 'update'])->name('user.update');
Route::put('/user/update/password', [UserController::class, 'updatePassword'])->name('user.update.password');
Route::delete('/user/delete', [UserController::class, 'delete'])->name('user.delete');

//Master User Customer
Route::get('/user-cust', [UserController::class, 'indexCust'])->name('user.indexCust');

//Verified User
Route::get('/verified-user/{id}', [UserController::class, 'verifiedUser'])->name('user.verified');
Route::get('/verified', [UserController::class, 'verifiedUser'])->name('user.verified');

//mapping category to location
Route::post('/category-mapping/store', [MappingCategoryController::class, 'store'])->name('mappingctg.store');
Route::get('/category-mapping/{id_location}', [MappingCategoryController::class, 'create'])->name('mappingctg.create');

//Master Item
Route::get('/item', [ItemController::class, 'index'])->name('item.index');
Route::post('/item/store', [ItemController::class, 'store'])->name('item.store');
Route::put('/item/update', [ItemController::class, 'update'])->name('item.update');
Route::delete('/item/delete', [ItemController::class, 'delete'])->name('item.delete');

//mapping item to location
Route::post('/item-mapping/store', [MappingItemController::class, 'store'])->name('mappingitem.store');
Route::get('/item-mapping/{id_location}', [MappingItemController::class, 'create'])->name('mappingitem.create');

//Master Bank
Route::get('/bank', [BankController::class, 'index'])->name('bank.index');
Route::post('/bank/store', [BankController::class, 'store'])->name('bank.store');
Route::put('/bank/update', [BankController::class, 'update'])->name('bank.update');
Route::delete('/bank/delete', [BankController::class, 'delete'])->name('bank.delete');