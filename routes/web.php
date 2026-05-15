<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

// Products
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/{product:slug}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/api/featured', [ProductController::class, 'featured'])->name('products.featured');
});

// Shopping Cart
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/{productId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/{productId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/', [CartController::class, 'clear'])->name('cart.clear');
});

// Checkout (Guest)
Route::prefix('checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/cities/{provinceId}', [CheckoutController::class, 'getCities'])->name('checkout.cities');
});

// Payment
Route::prefix('payment')->group(function () {
    Route::get('/order/{order}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/callback', [PaymentController::class, 'callback'])->name('payment.callback');
    Route::post('/webhook/stripe', [PaymentController::class, 'stripeWebhook'])->name('payment.stripe-webhook');
});

// Language switch
Route::get('/lang/{lang}', function ($lang) {
    if (in_array($lang, ['id', 'en'])) {
        session(['locale' => $lang]);
        app()->setLocale($lang);
    }
    return back();
})->name('language.switch');
