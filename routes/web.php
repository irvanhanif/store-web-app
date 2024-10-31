<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
Route::get('/category/{id}', [App\Http\Controllers\CategoryController::class, 'detail'])->name('categories-detail');
Route::get('/detail/{id}', [App\Http\Controllers\DetailController::class, 'index'])->name('detail');
Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'delete'])->name('cart-delete');

Route::get('/success', [App\Http\Controllers\CartController::class, 'success'])->name('success');

Route::get('/register/success', [App\Http\Controllers\Auth\RegisterController::class, 'success'])
    ->name('register-success');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout');
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::post('/cart/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart-add');
    
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/dashboard/transactions', [App\Http\Controllers\DashboardTransactionController::class, 'index'])
        ->name('dashboard-transactions');
    Route::get('/dashboard/transaction/{id}', [App\Http\Controllers\DashboardTransactionController::class, 'detail'])
        ->name('dashboard-transaction-detail');
    Route::post('/dashboard/transaction/{id}', [App\Http\Controllers\DashboardTransactionController::class, 'update'])
        ->name('dashboard-transaction-update');
    
    Route::get('/dashboard/products', [App\Http\Controllers\DashboardProductController::class, 'index'])
        ->name('dashboard-products');
    Route::get('/dashboard/products/add', [App\Http\Controllers\DashboardProductController::class, 'create'])
        ->name('dashboard-product-create');
    Route::post('/dashboard/product', [App\Http\Controllers\DashboardProductController::class, 'store'])
        ->name('dashboard-product-store');
    Route::get('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductController::class, 'detail'])
        ->name('dashboard-product-detail');
    Route::post('/dashboard/product/{id}', [App\Http\Controllers\DashboardProductController::class, 'update'])
        ->name('dashboard-product-update');
        
    Route::post('/dashboard/product-gallery/', [App\Http\Controllers\DashboardProductController::class, 'uploadGallery'])
        ->name('dashboard-product-gallery-upload');
    Route::post('/dashboard/product-gallery/delete/{id}', [App\Http\Controllers\DashboardProductController::class, 'deleteGallery'])
        ->name('dashboard-product-gallery-delete');
    
    Route::get('/dashboard/settings', [App\Http\Controllers\DashboardSettingController::class, 'store'])
        ->name('dashboard-settings-store');
    Route::get('/dashboard/accounts', [App\Http\Controllers\DashboardSettingController::class, 'account'])
        ->name('dashboard-settings-account');
    Route::post('/dashboard/account/{redirect}', [App\Http\Controllers\DashboardSettingController::class, 'update'])
        ->name('dashboard-settings-redirect');
});

Route::prefix('admin')
    ->middleware(['admin', 'auth'])
    ->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin-dashboard');
    Route::resource('/category', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('/user', App\Http\Controllers\Admin\UserController::class);
    Route::resource('/product', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('/gallery', App\Http\Controllers\Admin\ProductGalleryController::class);
    Route::resource('/transaction', App\Http\Controllers\Admin\TransactionController::class);
});