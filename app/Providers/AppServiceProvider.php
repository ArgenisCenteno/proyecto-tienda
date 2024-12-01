<?php

namespace App\Providers;

use App\Models\Producto;
use App\Models\Promocion;
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
            $today = now(); // Get the current date and time

    // Retrieve only active promotions based on today's date
    $promociones = Promocion::where('fecha_inicio', '<=', $today)
                            ->where('fecha_fin', '>=', $today)
                            ->with('productos')
                            ->get();
            $dollar = Tasa::where('name', 'Dollar')->first();
            $view->with('categorias', $categorias)->with('dollar', $dollar)->with('promociones', $promociones); // Las pasa a la vista
        });

        View::composer('welcome', function ($view) {
            $categorias = Categoria::all(); // Obtiene todas las categorías
            $today = now(); // Get the current date and time

            $productos = Producto::with('imagenes')->take(4)->get();
         //  dd($productos);
    // Retrieve only active promotions based on today's date
    $promociones = Promocion::where('fecha_inicio', '<=', $today)
                            ->where('fecha_fin', '>=', $today)
                            ->with('productos')
                            ->get();
            $dollar = Tasa::where('name', 'Dollar')->first();
            $view->with('categorias', $categorias)->with('dollar', $dollar)->with('promociones', $promociones)->with('productos', $productos); // Las pasa a la vista
        });
    }
}
