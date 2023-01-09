<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelacionFacturaCompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relacion_factura_compra', function (Blueprint $table) {
            $table->id('id_relacion_factura_compra');
            $table->string('cod_compra');
            $table->string('cod_factura');
            $table->string('cod_producto');
            $table->string('cant_producto');
            $table->string('des_producto');
            $table->string('precio_producto');
            $table->string('monto_iva');
            $table->string('total_compra');
            $table->string('total_monto');
            $table->string('cod_usuario');
            $table->string('estatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depositos');
    }
}
