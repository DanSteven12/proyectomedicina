<?php

namespace App\Providers;

use App\Models\Doctor;
use App\Models\Especialidad;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Route::bind('doctore', fn($value) => Doctor::findOrFail($value));
        Route::bind('especialidade', fn($value) => Especialidad::findOrFail($value));
    }
}
