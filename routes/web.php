<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserDashboardController;
use App\Livewire\AdminDashboard;
use App\Livewire\CourseManager;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::post('login', [AuthController::class, 'login'])->name('login.submit');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('login/{provider}', [AuthController::class, 'redirectToProvider'])->name('social.login');
Route::get('login/{provider}/callback', [AuthController::class, 'handleProviderCallback']);

Route::get('register', function () {
    return view('auth.register');
})->name('register');

Route::post('register', [AuthController::class, 'register'])->name('register.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/users', \App\Livewire\UserManager::class)->name('users.manage');
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
  
    Route::get('/choose-subscription', [PaymentController::class, 'showSubscriptionOptions'])->name('subscription.choose');
    Route::post('/subscription/checkout', [PaymentController::class, 'checkout'])->name('subscription.checkout');
});

Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::get('/subscription/success', [PaymentController::class, 'success'])->name('subscription.success');
Route::get('/subscription/cancel', [PaymentController::class, 'cancel'])->name('subscription.cancel');