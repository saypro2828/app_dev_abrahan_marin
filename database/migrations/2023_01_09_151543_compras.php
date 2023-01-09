<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Compras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id('id_compra');
            $table->string('cod_compra');
            $table->string('cod_producto');
            $table->string('des_producto');
            $table->string('cant_producto');
            $table->string('precio_producto');
            $table->string('cod_usuario');
            $table->string('estatus');
            $table->string('iva_producto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
