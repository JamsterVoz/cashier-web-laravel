<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/productview', [ProductController::class, 'productview'])->name('productview');

Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::post('/productCreate', [ProductController::class, 'create'])->name('productCreate');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('update');
Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('delete');

