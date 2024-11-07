<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoTalla extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'talla',
        'cantidad'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
