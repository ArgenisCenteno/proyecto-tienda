<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\SubCategoria;
use App\Models\Tasa;
use Illuminate\Http\Request;
use Session;
use Alert;
class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function products(Request $request)
    {
        $categorias = SubCategoria::all();
        $query = Producto::query();

        // Apply filters
        if ($request->filled('subcategoria')) {
            // Make sure you are using the correct key here
            $query->where('sub_categoria_id', $request->subcategoria);
        }

        if ($request->filled('rango_precio')) {
            // Correctly retrieve the price range
            // dd($request->filled('rango_precio'));
            $priceRange = explode('-', $request->rango_precio); // Ensure this key matches your request
            $query->whereBetween('precio_venta', [$priceRange[0], $priceRange[1]]);
        }

        $productos = $query->paginate(12);

        return view('productos')->with('categorias', $categorias)->with('productos', $productos);
    }

    public function detalles($id)
    {  
        $response = file_get_contents("https://ve.dolarapi.com/v1/dolares/oficial");
       
        // dd();
         if($response){
             $dato = json_decode($response);
             $dollar = $dato->promedio;
         }else{
             $dollar = 47.60;
         }
        $producto = Producto::find($id);
       // $dollar = Tasa::where('name', 'Dollar')->first();


        return view('detalles')->with('producto', $producto)->with('dollar', $dollar);
    }

    public function agregarCarrito(Request $request, $id)
    {
        // Retrieve the product based on ID
        $producto = Producto::find($id);
    
        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado');
        }
    
        // Get the selected size from the request
        $tallaSeleccionada = $request->talla;
    
        // Verificar si el producto tiene tallas y si la talla seleccionada está disponible
        if ($producto->tallas && $producto->tallas->count() > 0) {
            $tallaDisponible = $producto->tallas->where('talla', $tallaSeleccionada)->first();
    
            if (!$tallaDisponible || $tallaDisponible->cantidad <= 0) {
                Alert::error('¡Error!', 'La talla seleccionada no está disponible o está agotada')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

                return redirect()->back()->with('error', 'La talla seleccionada no está disponible o está agotada');
            }
        } else {
            Alert::error('¡Error!', 'No hay tallas disponibles')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

            return redirect()->back()->with('error', 'Este producto no tiene tallas disponibles');
        }
    
        // Verificar si hay alguna promoción activa para el producto
        $precioConDescuento = $producto->precio_venta; // Precio base
        foreach ($producto->promocion as $promocion) {
            if ($promocion->fecha_inicio <= now() && $promocion->fecha_fin >= now()) {
                // Aplicar el descuento si la promoción está activa
                $precioConDescuento = $producto->precio_venta - ($producto->precio_venta * $promocion->descuento / 100);
                break; // Usar la primera promoción activa que encuentre
            }
        }
    
        // Crear el item del carrito
        $cartItem = [
            'id' => $producto->id,
            'nombre' => $producto->nombre,

            'cantidad' => 1,
            'talla' => $tallaSeleccionada,
            'precio' => $precioConDescuento, // Usar el precio con descuento si aplica
            'imagen' => asset($producto->imagenes[0]->url) // Usar la primera imagen
        ];
    
        // Obtener el carrito existente de la sesión
        $cart = Session::get('cart', []);
    
        // Verificar si el producto ya está en el carrito
        if (count($cart) > 0) {
            foreach ($cart as $key => $item) {
                if ($item['nombre'] === $producto->nombre && $item['talla'] === $tallaSeleccionada) {
                    // Si el producto ya está en el carrito, aumentar la cantidad
                    $cart[$key]['cantidad'] += 1;
                    session()->put('cart', $cart);
                    Alert::success('¡Éxito!', 'Se aumentó la cantidad del producto ya existente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
                    return redirect()->back();
                }
            }
        }
    
        // Si el producto no está en el carrito, agregarlo
        $cart[] = $cartItem;
    
        // Guardar el carrito de nuevo en la sesión
        Session::put('cart', $cart);
        Alert::success('¡Éxito!', 'Producto agregado al carrito')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        return redirect()->back();
    }
    

   public function actualizarCarrito(Request $request)
{
    $carrito = session()->get('cart');

    // Check if the cart exists
    if ($carrito) {
        // Find the product by name (you can use the product ID or other unique identifiers)
        foreach ($carrito as $key => $item) {
            if ($item['nombre'] === $request->product) {
                // Retrieve stock information from your database (example using Product model)
                $product = Producto::where('nombre', $request->product)->first(); // or use 'id' if you have it
                
                if (!$product) {
                    return response()->json(['success' => false, 'message' => 'Producto no encontrado.']);
                }

                // Check if there is enough stock
                if ($request->cantidad > $product->cantidad) {
                   // dd($request->cantidad, $product->cantidad);
                    return response()->json(['success' => false, 'message' => 'No hay suficiente stock disponible.']);
                }

                // Update the cart with the new quantity
                $carrito[$key]['cantidad'] = $request->cantidad;

                // Update the cart session
                session()->put('cart', $carrito);

                return response()->json(['success' => true, 'message' => 'Carrito actualizado.']);
            }
        }
    }

    return response()->json(['success' => false, 'message' => 'Item no encontrado en carrito']);
}


    public function checkout(Request $request)
    {
        $carrito = session()->get('cart');
        $response = file_get_contents("https://ve.dolarapi.com/v1/dolares/oficial");
       
        // dd();
         if($response){
             $dato = json_decode($response);
             $dollar = $dato->promedio;
         }else{
             $dollar = 47.60;
         }
        if(!$carrito){
            Alert::error('¡Error!', 'Carrito vacío')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
            return redirect()->back();
        }

        $total = 0;
        $impuesto = 0;
        $montoTotal = 0;

        if (count($carrito) > 0) {
            foreach ($carrito as $c) {
                $total += $c['precio'] * $c['cantidad'];

                $consulta = Producto::find($c['id']);
                //dd($consulta);
                if($consulta->aplica_iva === 1) {
                    $impuesto += $c['precio'] * $c['cantidad'] * 0.16;
                }
                
            }
        }

        $montoTotal = $impuesto + $total;
   

        return view('pagar', compact('carrito', 'dollar', 'total', 'montoTotal', 'impuesto'));
    }


    public function productosPorCategoria($categoriaId)
    {
        // Encuentra la categoría
        $categoria = Categoria::findOrFail($categoriaId);

        // Obtiene todos los productos de las subcategorías relacionadas
        $productos = Producto::whereHas('subcategoria', function ($query) use ($categoria) {
            $query->where('categoria_id', $categoria->id);
        })->get();

        return view('categorias', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $cart = Session::get('cart', []);
        $response = file_get_contents("https://ve.dolarapi.com/v1/dolares/oficial");
       
        // dd();
         if($response){
             $dato = json_decode($response);
             $dollar = $dato->promedio;
         }else{
             $dollar = 47.60;;
         }

        $total = 0;

        if (count($cart) > 0) {
            foreach ($cart as $c) {
                $total += $c['precio'] * $c['cantidad'];
            }
        }

        return view('carrito', compact('cart', 'total', 'dollar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
