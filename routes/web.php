<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailSalesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;

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

Route::group(['middleware' => 'isGuest'], function(){
    Route::redirect('/','/login');
});


// Route::get('/test', [ProductController::class,'test']);

Route::view('/login', 'login')->name('login')->middleware('isGuest');
Route::post('/loginProcess', [AuthController::class, 'loginProcess'])->name('loginProcess');
// Route::get('/register', [AuthController::class, 'register'])->name('register');
// Route::post('/registerProcess', [AuthController::class, 'registerProcess'])->name('registerProcess');


Route::group(['middleware' => 'isLogin'], function() {

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/checkout', [SalesController::class, 'create'])->name('checkout');
Route::get('/sales', [DetailSalesController::class, 'index'])->name('sales');
Route::patch('/transaction/{id}', [DetailSalesController::class, 'create'])->name('transaction');

Route::get('/productview', [ProductController::class, 'productview'])->name('productview');
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::post('/productCreate', [ProductController::class, 'create'])->name('productCreate');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('update');
Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('delete');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});
