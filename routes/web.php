<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('login'));

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['rol.admin'])->group(function () {
        Route::resource('usuarios', UsuarioController::class)->except(['show']);
        Route::resource('especialidades', EspecialidadController::class)->except(['show']);
        Route::resource('doctores', DoctorController::class)->except(['show']);
    });

    Route::middleware(['rol.admin_recepcionista'])->group(function () {
        Route::resource('pacientes', PacienteController::class);
    });

    Route::middleware(['rol.citas'])->group(function () {
        Route::resource('citas', CitaController::class);
    });

    Route::middleware(['rol.admin_doctor'])->group(function () {
        Route::resource('consultas', ConsultaController::class);
    });
});

require __DIR__ . '/auth.php';
