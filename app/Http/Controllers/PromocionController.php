<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Promocion;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    /**
     * Mostrar el formulario para crear una nueva promoción.
     */
    public function create()
    {
        $productos = Producto::all(); // Obtener todos los productos disponibles
        return view('productos.promociones', compact('productos')); // Enviar productos a la vista
    }

    /**
     * Guardar una nueva promoción en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar la información de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descuento' => 'required|numeric|min:0|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'productos' => 'required|array',
        ]);

        // Crear la promoción
        $promocion = Promocion::create([
            'nombre' => $request->nombre,
            'descuento' => $request->descuento,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);

        // Asociar los productos seleccionados a la promoción
        $promocion->productos()->attach($request->productos);

        return redirect()->route('promociones.historia')->with('success', 'Promoción creada exitosamente.');
    }

    public function index()
    {
        $promociones = Promocion::with('productos')->orderBy('id', 'DESC')->paginate(10); // Paginación de 10 elementos
        return view('productos.historia', compact('promociones'));
    }

    /**
     * Mostrar los detalles de una promoción específica.
     */
    public function show($id)
    {
        $promocion = Promocion::with('productos')->findOrFail($id);
        return view('productos.detalles', compact('promocion'));
    }
}
