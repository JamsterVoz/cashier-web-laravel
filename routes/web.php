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

Route::middleware(['guest'])-> group( function(){
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/loginProcess', [AuthController::class, 'loginProcess'])->name('loginProcess');
});

Route::redirect('/','/login');

// Route::get('/test', [ProductController::class,'test']);


// Route::get('/register', [AuthController::class, 'register'])->name('register');
// Route::post('/registerProcess', [AuthController::class, 'registerProcess'])->name('registerProcess');



Route::middleware(['auth'])-> group( function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/checkout', [SalesController::class, 'create'])->name('checkout');
    Route::get('/sales', [SalesController::class, 'index'])->name('sales');
    Route::patch('/quantity/{id}', [SalesController::class, 'store'])->name('quantity');
    Route::delete('/delete/sales/{id}', [SalesController::class, 'destroy'])->name('deleteSales');

    Route::patch('/transaction/{id}', [DetailSalesController::class, 'create'])->name('transaction');

    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::post('/productCreate', [ProductController::class, 'create'])->name('productCreate');
    Route::get('/productview', [ProductController::class, 'productview'])->name('productview');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('delete');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
