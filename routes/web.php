<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [LoginController::class, 'show'])->name('login.show');

Route::post('/', [LoginController::class, 'login'])->name('login');

Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::get('/demande', [DemandeController::class, 'create'])->name('home');

Route::post('/demande', [DemandeController::class, 'store'])->name('demande.store');

Route::get('/user/create', [EtudiantController::class, 'create'])->name('user.create');

Route::post('/user', [EtudiantController::class, 'store'])->name('etudiant.store');

Route::get('/admin', [AdminController::class, 'show'])->name('admin.show');

Route::put('/demande', [DemandeController::class, 'update'])->name('demande.update');

Route::post('/demande/destroy', [DemandeController::class, 'destroy'])->name('demande.destroy');

Route::get('/reset-password', [LoginController::class, 'edit'])->name('login.edit');

Route::get('/service', [AdminController::class, 'service_show'])->name('admin.service_show');

Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])->name('login.sendResetLink');
Route::get('/reset-password/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('password.update');

