<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Promocion;
use Illuminate\Http\Request;
use Alert;
use Yajra\DataTables\DataTables;

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
    
        // Verificar si alguno de los productos ya está asociado a una promoción activa
        $productosOcupados = Promocion::where(function ($query) use ($request) {
            $query->where('fecha_inicio', '<=', $request->fecha_fin)
                  ->where('fecha_fin', '>=', $request->fecha_inicio);
        })->whereHas('productos', function ($query) use ($request) {
            $query->whereIn('productos.id', $request->productos); // Especifica la tabla 'productos'
        })->with('productos')->get();
        
    
        $productosConflictivos = $productosOcupados->flatMap(function ($promocion) {
            return $promocion->productos->pluck('nombre');
        })->unique();
    
        if ($productosConflictivos->isNotEmpty()) {
            $productosEnPromocion = $productosConflictivos->join(', ', ' y '); // Formato: "Producto1, Producto2 y Producto3"
    
            Alert::error(
                '¡Error!',
                "Los siguientes productos ya están en una promoción vigente: $productosEnPromocion"
            )->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
    
            return redirect()->back()->withInput();
        }
    
        // Crear la promoción
        $promocion = Promocion::create([
            'nombre' => $request->nombre,
            'descuento' => $request->descuento,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);
    
        // Asociar los productos seleccionados a la promoción
        $promocion->productos()->attach($request->productos);
    
        Alert::success('¡Éxito!', 'Promoción creada exitosamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
    
        return redirect()->route('promociones.historia')->with('success', 'Promoción creada exitosamente.');
    }
    


    public function index(Request $request)
    { 
        if ($request->ajax()) {
         $promociones = Promocion::with('productos')->orderBy('id', 'DESC')->get(); // Cargar la relación subCategoria

            return DataTables::of($promociones)
                ->addColumn('actions', 'productos.actions_promo')
                ->rawColumns(['status', 'actions'])
                ->make(true);
        } else {
            return view('productos.historia');
        }
        return view('productos.historia');
    }

    /**
     * Mostrar los detalles de una promoción específica.
     */
    public function show($id)
    {
        $promocion = Promocion::with('productos')->findOrFail($id);
        return view('productos.detalles', compact('promocion'));
    }
    public function destroy(string $id)
    {
        $proveedor = Promocion::where('id', $id)->first();
       

        if(!$proveedor){
            Alert::error('¡Error!', 'No existe esta promoción')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
            return redirect(route('promociones.historia'));
        }

        $proveedor->delete();
        Alert::success('¡Éxito!', 'Promoción eliminada exitosamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        return redirect()->route('promociones.historia');
    }
    public function eliminarMultiplesRegistros(Request $request)
    {
        // Verifica que el array "selected_taxes" esté presente en la solicitud
        if ($request->has('selected_taxes') && is_array($request->selected_taxes)) {
            $selectedTaxes = $request->selected_taxes;

            // Elimina los registros usando Eloquent
            Promocion::whereIn('id', $selectedTaxes)->delete();

            Alert::success('¡Éxito!', 'Promociones eliminadas exitosamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
            return redirect()->route('promociones.historia');
        }

        Alert::success('¡Error!', 'Datos invalidos')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        return redirect()->route('promociones.historia');
    }
}
