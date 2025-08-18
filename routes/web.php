<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotifikasiController;

;

Route::get('/', [AuthController::class, 'index'])->name('user.home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.user.login');
Route::get('/loginn', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.user.register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');

//forget password
Route::get('/password/forget', [AuthController::class, 'showForgetPasswordForm'])->name('password.request');
Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
//reset password
Route::get('/password/reset/{token?}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'reset'])->name('password.update');

//profile
Route::get('/profile', [AuthController::class, 'profile'])->name('user.profile');
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('user.profile.update');


Route::get('/listroom', [AuthController::class, 'listRoom'])->name('user.listroom');
Route::get('/room/{id}', [AuthController::class, 'detailRoom'])->name('user.detailroom');

Route::middleware(['auth'])->group(function() {
    Route::get('/booking', [AuthController::class, 'bookingroom'])->name('user.booking');
    Route::post('/booking/store', [AuthController::class, 'storeBooking'])->name('user.booking.store');
    // Route::post('/booking/proses',[AuthController::class, 'prosesBooking'])->name('user.booking.proses');
    Route::get('/booking/konfirmasi/{bookingId}', [AuthController::class, 'konfirmasiBooking'])->name('user.bookingconfirmation');
    // Route::post('/booking/konfirmasi/store', [AuthController::class, 'storeKonfirmasiBooking'])->name('user.bookingconfirmation.store');
    Route::get('/history-booking', [AuthController::class, 'historyBooking'])->name('user.history-booking');


});

// Payment route
Route::get('/payment', [PaymentController::class, 'createTransaction']);
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

// Admin routes
Route::get('/admin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('login.admin');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

// Room management
Route::get('/admin/kamar', [AdminController::class, 'indexKamar'])->name('kamar');
Route::post('/admin/kamar/store', [AdminController::class, 'storeKamar'])->name('kamar.store');
Route::get('/admin/kamar/update/{id}', [AdminController::class, 'editKamar'])->name('kamar.update');
Route::put('/admin/kamar/update/{id}', [AdminController::class, 'updateKamar'])->name('kamar.update.post');
Route::delete('/admin/kamar/destroy/{id}', [AdminController::class, 'destroyKamar'])->name('kamar.destroy');


// Notification management
Route::get('/admin/notifikasi', [AdminController::class, 'indexNotifikasi'])->name('notifikasi');
Route::post('/admin/notifikasi/store', [AdminController::class, 'storeNotifikasi'])->name('notifikasi.store');
Route::post('/admin/notifikasi/update/{id}', [AdminController::class, 'updateNotifikasi'])->name('notifikasi.update');
Route::post('/admin/notifikasi/destroy/{id}', [AdminController::class, 'destroyNotifikasi'])->name('notifikasi.destroy');
Route::post('/admin/notifikasi/kirim-email/{id}', [NotifikasiController::class, 'kirimEmail'])->name('admin.notifikasi.kirimEmail');


// Booking management
Route::get('/admin/pemesanan', [AdminController::class, 'indexPemesanan'])->name('pemesanan');
Route::post('/admin/pemesanan/store', [AdminController::class, 'storePemesanan'])->name('pemesanan.store');
Route::put('/admin/pemesanan/update/{id}', [AdminController::class, 'updatePemesanan'])->name('pemesanan.update');
Route::delete('/admin/pemesanan/destroy/{id}', [AdminController::class, 'destroyPemesanan'])->name('pemesanan.destroy');

// Tenant management
Route::get('/admin/penghuni', [AdminController::class, 'indexPenghuni'])->name('penghuni');
Route::post('/admin/penghuni/store', [AdminController::class, 'storePenghuni'])->name('penghuni.store');
Route::get('/admin/penghuni/edit/{id}', [AdminController::class, 'editPenghuni'])->name('penghuni.edit');
Route::post('/admin/penghuni/update/{id}', [AdminController::class, 'updatePenghuni'])->name('penghuni.update');

Route::delete('/admin/penghuni/destroy/{id}', [AdminController::class, 'destroyPenghuni'])->name('penghuni.destroy');
