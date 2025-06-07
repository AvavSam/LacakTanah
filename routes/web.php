<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LandController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return redirect()->to('/login');
});

Route::middleware('auth')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::get('/lands-expiring', [LandController::class, 'expiring'])
    ->name('lands.expiring');
  Route::resource('lands', LandController::class);
  Route::resource('users', UserController::class)->except(['show']);
  Route::get('/file/{path}', [FileController::class, 'serveAzureFile'])
    ->where('path', '.*')
    ->name('serve.file');
});

require __DIR__.'/auth.php';
