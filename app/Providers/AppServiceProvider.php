<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Exemplo: todo parâmetro {id} deve ser numérico
        Route::pattern('id', '[0-9]+');

        // Exemplo: todo parâmetro {slug} deve ser letras, números, hífen
        Route::pattern('token', '[\da-fA-F]{8}-[\da-fA-F]{4}-[\da-fA-F]{4}-[\da-fA-F]{4}-[\da-fA-F]{12}+');
    }
}
