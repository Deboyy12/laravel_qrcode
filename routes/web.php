<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRCodeController;

Route::get('/', function () {
    return view('landingpage.landingpage');
});

// Dashboard Admin
Route::get('/admin', function () {
    return view('admin.dashboard', ['showSidebar' => true]); // Sidebar hanya di dashboard
})->middleware(['auth', 'verified'])->name('dashboard');

// Menjaga pengguna terautentikasi untuk akses profile
Route::middleware('auth')->group(function () {
    // Halaman profile pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routing untuk QR Code
    // Menampilkan form untuk QR Code
    Route::get('/qrcode', [QRCodeController::class, 'showForm'])->name('qrcode.form');

    // Mengenerate QR Code
    Route::post('/generate-qrcode', [QRCodeController::class, 'generate'])->name('qrcode.generate');

    // Download QR Code
    Route::get('/qrcode/download/{fileName}', [QRCodeController::class, 'download'])->name('qrcode.download');
});

// Include routing untuk autentikasi (login, register, dll.)
require __DIR__.'/auth.php';
