<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Mail;
use App\Services\TwilioService;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\InterestController;


Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/search', [UserController::class, 'search'])->name('search');
Route::get('/matches', [UserController::class, 'matches'])->name('match');
Route::get('/matchesAjax', [UserController::class, 'getMatches']);
Route::post('/matches/filter', [UserController::class, 'filterMatches'])->name('matches.filter');
Route::post('/searchbyid', [UserController::class, 'searchById'])->name('search.id');
Route::post('/basicSearch', [UserController::class, 'basicSearch'])->name('search.basic');
Route::post('/advanceSearch', [UserController::class, 'advanceSearch'])->name('search.advanceSearch');





Route::get('/membership', [UserController::class, 'membership'])->name('membership');
Route::get('/success-stories', [UserController::class, 'successStories'])->name('success_storiess');
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::get('/privacy', [UserController::class, 'privacy'])->name('privacy');
Route::get('/terms', [UserController::class, 'terms'])->name('terms');
Route::get('/help', [UserController::class, 'help'])->name('help');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'register'])->name('register');

// Forgot password form
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Send reset link email
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset password form (link from email)
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Reset password submit
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/dashboard/shortlist', [UserController::class, 'shortlist'])->name('dashboard.shortlist')->middleware('auth');
Route::get('/dashboard/edit/profile', [UserController::class, 'edit_profile'])->name('dashboard.edit.profile')->middleware('auth');



Route::post('/register', [UserController::class, 'ajaxRegister']);
Route::post('/send-otp', [UserController::class, 'sendOtp'])->name('send.otp');
Route::post('/send-otp-mobile', [UserController::class, 'sendMobileOtp'])->name('send.otp.mobile');

Route::post('/verify-otp', [UserController::class, 'verifyOtp'])->name('verify.otp')->middleware('web');

Route::get('/otp', [UserController::class, 'otp_form'])->name('user.otp');
Route::get('/otp/mobile', [UserController::class, 'otp_form_mobile'])->name('user.otp.mobile-view');



Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/'); // logout ke baad homepage ya login page
})->name('logout');

Route::post('/create-order', [PaymentController::class, 'createOrder']);
Route::post('/payment-success', [PaymentController::class, 'paymentSuccess']);
Route::apiResource('subscription-plans', SubscriptionPlanController::class);
Route::post('/contact-submit', [UserController::class, 'submit'])->name('contact.submit');
Route::post('/send-interest', [InterestController::class, 'sendInterest'])->middleware('auth');
Route::post('/shortlist', [InterestController::class, 'addToShortlist'])->middleware('auth');

