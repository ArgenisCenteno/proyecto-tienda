<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTallaToDetalleVentaTable extends Migration
{
    public function up()
    {
        Schema::table('detalle_ventas', function (Blueprint $table) {
            $table->unsignedBigInteger('talla_id')->nullable()->after('producto_id');
            // You may want to create a foreign key if talla relates to another table like 'tallas'
            $table->foreign('talla_id')->references('id')->on('tallas')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('detalle_ventas', function (Blueprint $table) {
            $table->dropForeign(['talla_id']);
            $table->dropColumn('talla_id');
        });
    }
}
