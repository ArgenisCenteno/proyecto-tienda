<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Compra;
use App\Models\Pago;
use App\Models\Producto;
use App\Models\Promocion;
use App\Models\Proveedor;
use App\Models\SubCategoria;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ventas = Venta::count();
        $compras = Compra::count();
        $usuarios = User::count();
        $productos = Producto::count();
        $categorias = Categoria::count();
        $subcategorias = SubCategoria::count();
        $proveedores = Proveedor::count();
        $pagos = Pago::where('status', 'pendiente')->count();
        $promociones = Promocion::with('productos')->orderBy('id', 'DESC')->paginate(10); // Paginación de 10 elementos
        $notificaciones = auth()->user()->unreadNotifications;
        $pagoPendientes = Pago::where('status', 'pendiente')->paginate(5);
        
        return view('home', compact('pagoPendientes','promociones','ventas', 'compras', 'notificaciones' ,'proveedores' ,'usuarios', 'productos', 'categorias', 'subcategorias', 'pagos'));
    }
    
  
}
