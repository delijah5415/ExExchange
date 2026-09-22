<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\AccountController;
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
