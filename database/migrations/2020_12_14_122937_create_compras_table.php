<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
           // $table->id('id_compra');
            $table->foreignId('idProveedor')->constrained('proveedors');
            $table->string('estado');
            $table->date('fecha_compra');
            $table->integer('IVA')->nullable();
            $table->foreignId('idEmpleado')->constrained('empleados');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
