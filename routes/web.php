<?php
<<<<<<< HEAD

=======
use Illuminate\Support\Facades\Route;
>>>>>>> 1553df9ff9197e2ee5364a3b590da2338cb45ecc
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\AccountController;
<<<<<<< HEAD
use Illuminate\Support\Facades\Route;

// Public Static Pages
Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/agreement',[HomeController::class,'agreement'])->name('agreement');
Route::get('/contacts',[HomeController::class,'contacts'])->name('contacts');

    // Exchange Flow
    Route::prefix('exchange')->name('exchange.')->group(function () {
        Route::get('/', [ExhangeController::class, 'index'])->name('index');

    // Throttled to 10 requests/min to protect external price APIs
    Route::post('/quote', [ExhangeController::class, 'order'])
        ->middleware(['supabase.auth', 'throttle:10,1'])
        ->name('order');

    // Requires authentication to place orders
    Route::post('/order', [ExchangeController::class, 'order'])
        ->middleware('throttle:10,1')
        ->name('order');
});

// Authentication & Password Management
Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:10,1')
    ->name('login');

    Route::post('/register', [AuthController::class, 'register'])
    ->middleware('throttle:10,1')
    ->name('register');

    Route::get('/forgot-password'.[AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])
        ->middleware('throttle:5,1')
        ->name('password.email');

    // Added token parameter and rate limiting to prevent brute-forcing
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
        ->middleware('throttle:5,1')
        ->name('password.update');
});

// Authenticated Routes
Routes::middleware('supabase.auth')->function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
});
=======
Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/exchange',[HomeController::class,'exchange'])->name('exchange');
Route::post('/exchange/quote',[ExchangeController::class,'quote'])->middleware(['supabase.auth','throttle:30,1'])->name('exchange.quote');
Route::post('/exchange/order',[ExchangeController::class,'store'])->middleware('supabase.auth')->name('exchange.order');
Route::get('/faq',[HomeController::class,'faq'])->name('faq');
Route::get('/agreement',[HomeController::class,'agreement'])->name('agreement');
Route::get('/contacts',[HomeController::class,'contacts'])->name('contacts');
Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login'])->middleware('throttle:10,1')->name('login.store');
Route::get('/register',[AuthController::class,'showRegister'])->name('register');
Route::post('/register',[AuthController::class,'register'])->middleware('throttle:10,1')->name('register.store');
Route::post('/logout',[AuthController::class,'logout'])->middleware('supabase.auth')->name('logout');
Route::get('/account',[AccountController::class,'index'])->middleware('supabase.auth')->name('account');
>>>>>>> 1553df9ff9197e2ee5364a3b590da2338cb45ecc
