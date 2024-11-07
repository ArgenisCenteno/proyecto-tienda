<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Producto extends Model
{
    use HasFactory;

    use Sluggable;

    protected $fillable = [
        'nombre',
        'descripcion',
        'slug',
        'precio_compra',
        'precio_venta',
        'aplica_iva',
        'lote',
        'fecha_vencimiento',
        'cantidad',
        'sub_categoria_id',
        'disponible',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nombre'
            ]
        ];
    }

    /**
     * Relación con la subcategoría.
     */
    public function subCategoria()
    {
        return $this->belongsTo(SubCategoria::class, 'sub_categoria_id');
    }

    public function imagenes()
    {
        return $this->hasMany(ImagenProducto::class, 'producto_id');
    }

    public function promocion()
    {
        return $this->belongsToMany(Promocion::class, 'promocion_producto', 'producto_id', 'promocion_id')
                    ->withTimestamps(); // Añadir timestamps si los necesitas
    }

    public function tallas()
    {
        return $this->hasMany(ProductoTalla::class);
    }
}
