<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoContraEntregas1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('pedidoContraEntregas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idCliente')->constrained('clientes');
            $table->string('direccion');
            $table->float('subtotal',8,2);
            $table->float('costoEnvio',8,2);
            $table->float('total',8,2);
            $table->float('pagarCon',8,2);
            $table->float('cambio',8,2);
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('pedido_contra_entregas');
    }
}
