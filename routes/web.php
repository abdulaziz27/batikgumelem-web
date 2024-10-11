<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/details/{slug}', [FrontendController::class, 'details'])->name('details');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{category?}', [ProductController::class, 'index'])->name('products');
Route::get('/history', [FrontendController::class, 'history'])->name('history');
Route::get('/promotion', [FrontendController::class, 'promotion'])->name('promotion');
Route::get('/privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('/terms-condition', [FrontendController::class, 'termsCondition'])->name('termsCondition');
Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');

Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('admin')) {
        return redirect('/admin');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard/transactions', [DashboardController::class, 'transactionIndex'])->name('dashboard.transaction.index');
    Route::get('/dashboard/transactions/{id}', [DashboardController::class, 'transactionShow'])->name('dashboard.transaction.show');
    Route::get('/dashboard/tracking', [DashboardController::class, 'trackingIndex'])->name('dashboard.tracking.index');
    Route::get('/dashboard/tracking/{id}', [DashboardController::class, 'trackingShow'])->name('dashboard.tracking.show');
    Route::get('/dashboard/history', [DashboardController::class, 'history'])->name('dashboard.history');

    Route::post('/test-checkout', function (Request $request) {
        return response()->json(['message' => 'Checkout test successful']);
    })->middleware('auth')->name('test-checkout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
    Route::post('/cart/{id}', [FrontendController::class, 'cartAdd'])->name('cart-add');
    Route::delete('/cart/{id}', [FrontendController::class, 'cartDelete'])->name('cart-delete');
    Route::get('/checkout/success', [FrontendController::class, 'success'])->name('checkout-success');
    Route::post('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
    Route::post('/midtrans/notification', [MidtransController::class, 'notificationHandler']);

    Route::get('/invoice/{id}', [InvoiceController::class, 'generateInvoice'])->name('generate.invoice');
});

require __DIR__.'/auth.php';
