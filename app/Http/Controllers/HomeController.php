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
use Auth;
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
      
        $compras = Compra::count();
       
        $productos = Producto::count();
        $categorias = Categoria::count();
        $subcategorias = SubCategoria::count();
        $proveedores = Proveedor::count();
    
        $promociones = Promocion::with('productos')->orderBy('id', 'DESC')->paginate(10); // Paginación de 10 elementos
        $notificaciones = auth()->user()->unreadNotifications;
        if(Auth::user()->hasRole('cliente')){
            $pagos = Pago::where('status', 'pendiente')->where('creado_id', Auth::user()->id)->count();
            $pagoPendientes = Pago::where('status', 'pendiente')->where('creado_id', Auth::user()->id)->paginate(5);
            $usuarios = 1;
            $ventas = Venta::where('user_id', Auth::user()->id)->count();
        }else{
            $pagos = Pago::where('status', 'pendiente')->count();
            $pagoPendientes = Pago::where('status', 'pendiente')->paginate(5);
            $usuarios = User::count();
            $ventas = Venta::count();
        }      
        return view('home', compact('pagoPendientes','promociones','ventas', 'compras', 'notificaciones' ,'proveedores' ,'usuarios', 'productos', 'categorias', 'subcategorias', 'pagos'));
     
    }
    
  
}
