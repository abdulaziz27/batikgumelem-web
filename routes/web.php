<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

// Home & Static Pages
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/history', [HomeController::class, 'history'])->name('history');
Route::get('/promotion', [HomeController::class, 'promotion'])->name('promotion');
Route::get('/terms-condition', [HomeController::class, 'termsCondition'])->name('termsCondition');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

// Products
Route::get('/products/{category?}', [ProductController::class, 'index'])->name('products');
Route::get('/details/{slug}', [ProductController::class, 'show'])->name('details');

// Blogs
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');

Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('admin')) {
        return redirect('/admin');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authentication Required Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard/transactions', [DashboardController::class, 'transactionIndex'])->name('dashboard.transaction.index');
    Route::get('/dashboard/transactions/{id}', [DashboardController::class, 'transactionShow'])->name('dashboard.transaction.show');
    Route::get('/dashboard/tracking', [DashboardController::class, 'trackingIndex'])->name('dashboard.tracking.index');
    Route::get('/dashboard/tracking/{id}', [DashboardController::class, 'trackingShow'])->name('dashboard.tracking.show');
    Route::get('/dashboard/history', [DashboardController::class, 'history'])->name('dashboard.history');

    // Product Reviews
    Route::get('/review/create/{productId}', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/review/{productId}', [ReviewController::class, 'store'])->name('review.store');
    Route::put('/review/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/review/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{productId}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/toggle/{productId}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/remove/{wishlistId}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/move-to-cart/{wishlistId}', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');

    // Language Switcher Route
    Route::get('/language/{locale}', [LanguageController::class, 'switchLang'])
        ->name('language.switch')
        ->whereIn('locale', ['en', 'id']);

    // Language Test Route
    Route::get('/language-test', function () {
        return view('language-test');
    })->middleware('web')->name('language.test');


    Route::post('/test-checkout', function (Request $request) {
        return response()->json(['message' => 'Checkout test successful']);
    })->middleware('auth')->name('test-checkout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart-add/{id}', [CartController::class, 'add'])->name('cart-add');
    Route::delete('/cart-delete/{id}', [CartController::class, 'delete'])->name('cart-delete');

    // Checkout
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout-success');

    // Route::post('/midtrans/notification', [MidtransController::class, 'notificationHandler']);

    Route::get('/invoice/{id}', [InvoiceController::class, 'generateInvoice'])->name('generate.invoice');
});

// Payments
Route::post('/midtrans/notification', [MidtransController::class, 'notificationHandler'])->name('midtrans.notification');

// Language Switcher
Route::get('/language/{locale}', [LanguageController::class, 'switchLang'])->name('language.switch');


require __DIR__ . '/auth.php';
