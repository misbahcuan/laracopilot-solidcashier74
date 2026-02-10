<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TradingController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () { return view('welcome'); })->name('home');

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Trading Routes
Route::get('/trading', [TradingController::class, 'index'])->name('trading.index');
Route::post('/trading/execute', [TradingController::class, 'execute'])->name('trading.execute');
Route::get('/trading/history', [TradingController::class, 'history'])->name('trading.history');

// Portfolio Routes
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/performance', [PortfolioController::class, 'performance'])->name('portfolio.performance');

// Deposit Routes
Route::get('/deposit', [DepositController::class, 'index'])->name('deposit.index');
Route::post('/deposit', [DepositController::class, 'store'])->name('deposit.store');
Route::get('/deposit/history', [DepositController::class, 'history'])->name('deposit.history');

// Withdrawal Routes
Route::get('/withdrawal', [WithdrawalController::class, 'index'])->name('withdrawal.index');
Route::post('/withdrawal', [WithdrawalController::class, 'store'])->name('withdrawal.store');
Route::get('/withdrawal/history', [WithdrawalController::class, 'history'])->name('withdrawal.history');

// Referral Routes
Route::get('/referral', [ReferralController::class, 'index'])->name('referral.index');
Route::post('/referral/generate', [ReferralController::class, 'generate'])->name('referral.generate');

// Profile Routes
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');