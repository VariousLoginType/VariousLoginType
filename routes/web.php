<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialAuthController;

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

Route::get('/', [ProductController::class, 'index']);
Route::post('/checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::get('/success', [ProductController::class, 'success'])->name('checkout.success');
Route::get('/cancel', [ProductController::class, 'cancel'])->name('checkout.cancel');
// Route::post('/webhook', [ProductController::class, 'webhook'])->name('checkout.webhook');

Route::post('paypal', [PaypalController::class, 'paypal'])->name('paypal');
Route::get('success', [PaypalController::class, 'success'])->name('success');
Route::get('cancel', [PaypalController::class, 'cancel'])->name('cancel');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/logout', [SocialAuthController::class, 'logout'])->name('logout');
});

// Route::get('auth/google', [SocialAuthController::class, 'redirect']);
// Route::get('auth/google/callback', [SocialAuthController::class, 'callbackSocial']);

Route::get('auth/{driver}', [SocialAuthController::class, 'redirect']);
Route::get('auth/{driver}/callback', [SocialAuthController::class, 'callbackSocial']);

require __DIR__.'/auth.php';
