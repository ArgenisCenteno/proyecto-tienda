<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;

    protected $table = 'promociones';
    protected $fillable = [
        'nombre', 
        'descuento', 
        'fecha_inicio', 
        'fecha_fin',
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'promocion_producto', 'promocion_id', 'producto_id')
                    ->withTimestamps(); // Añadir timestamps si los necesitas
    }
}
