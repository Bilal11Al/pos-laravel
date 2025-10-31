<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BelajarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KalkulatorController;
use Illuminate\Auth\Events\Logout;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
Route::get('/', [LoginController::class, 'index']);
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('action-login', [LoginController::class, 'actionLogin'])->name('action-login');
Route::get('logout',[LoginController::class, 'Logout'])->name('logout');

Route::middleware('auth')->group(function (){
    Route::resource('dashboard', DashboardController::class);
});

Route::get('belajar', [BelajarController::class, 'index']);

Route::get('tambah', [BelajarController::class, 'tambah'])->name('belajar.tambah');
Route::post('storeTambah', [BelajarController::class, 'storeTambah'])->name('storeTambah');
Route::get('kurang', [BelajarController::class, 'kurang'])->name('kurang');
Route::post('storeKurang', [BelajarController::class, 'storeKurang'])->name('storeKurang');
Route::get('kalkulator', [KalkulatorController::class, 'create']);
Route::post('kalkulator.crete', [KalkulatorController::class, 'store'])->name('calculator,store');

