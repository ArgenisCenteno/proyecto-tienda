<?php

namespace App\Providers;

use App\Models\Tasa;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Categoria;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $categorias = Categoria::all(); // Obtiene todas las categorías
            $dollar = Tasa::where('name', 'Dollar')->first();
            $view->with('categorias', $categorias)->with('dollar', $dollar); // Las pasa a la vista
        });

      
    }
}
