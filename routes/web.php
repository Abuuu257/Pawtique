<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ReviewController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::post('/product/{id}/favorite', [PageController::class, 'toggleFavorite'])->name('product.favorite');
Route::get('/product/{id}', [PageController::class, 'productDetail'])->name('product.detail');
Route::get('/subscriptions', [PageController::class, 'subscriptions'])->name('subscriptions');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

Route::get('/cart', [PageController::class, 'cart'])->name('cart');
Route::post('/cart/add', [PageController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [PageController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove/{id}', [PageController::class, 'removeFromCart'])->name('cart.remove');

// Stripe Checkout
Route::post('/checkout', [StripeController::class, 'checkout'])->name('checkout');
Route::post('/subscribe', [StripeController::class, 'subscribe'])->name('subscribe');
Route::get('/checkout/success', [StripeController::class, 'success'])->name('stripe.success');
Route::get('/checkout/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [PageController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/products', [PageController::class, 'adminProducts'])->name('admin.products');
    Route::get('/admin/products/create', [PageController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/admin/products', [PageController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [PageController::class, 'editProduct'])->name('admin.products.edit');
    Route::post('/admin/products/{id}', [PageController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [PageController::class, 'deleteProduct'])->name('admin.products.delete');
    
    // Inquiry Management
    Route::post('/admin/messages/{id}/status', [PageController::class, 'updateMessageStatus'])->name('admin.messages.status');
    Route::delete('/admin/messages/{id}', [PageController::class, 'deleteMessage'])->name('admin.messages.delete');
    
    // Member Club Management
    Route::get('/admin/members', [PageController::class, 'adminMembers'])->name('admin.members');
    Route::delete('/admin/members/{id}', [PageController::class, 'deleteMember'])->name('admin.members.delete');

    // Order Management
    Route::get('/admin/orders', [PageController::class, 'adminOrders'])->name('admin.orders');
    Route::delete('/admin/orders/{id}', [PageController::class, 'deleteOrder'])->name('admin.orders.delete');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('home');
    })->name('dashboard');

    Route::get('/profile', [PageController::class, 'profile'])->name('profile.custom');
});
