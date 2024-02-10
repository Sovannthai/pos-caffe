<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExspendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UnitController;
use App\Models\Exspend;
use App\Models\Transactionsaleline;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Helper\TableCellStyle;

Route::get('/', function () {
    return redirect('/admin');
});

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::resource('products', ProductController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('exspend', ExspendController::class);
    Route::resource('orders', OrderController::class);
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    // Route::get('/pos/get-product',[PosController::class, 'getproduct'])->name('pos.get-product');
    // Route::post('/pos',[PosController::class,'checkout'])->name('pos.checkout');
    // Route::post('/checkout', [PosController::class, 'checkout'])->name('checkout');
    Route::post('checkout', [PosController::class, 'checkout'])->name('checkout');
    Route::resource('/transaction', TransactionController::class);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/change-qty', [CartController::class, 'changeQty']);
    Route::delete('/cart/delete', [CartController::class, 'delete']);
    Route::delete('/cart/empty', [CartController::class, 'empty']);

    Route::get('/table', [TableController::class, 'index'])->name('table.index');
    Route::post('/table', [TableController::class, 'store'])->name('table.store');
    Route::put('/table/update/{id}', [TableController::class, 'update'])->name('table.update');
    Route::get('/table/delete/{id}', [TableController::class, 'destroy'])->name('table.destroy');

    // Route::resource('/transactionsaleline',Transactionsaleline::class);
});
