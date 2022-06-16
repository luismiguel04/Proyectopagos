<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('provedor_id');
            $table->integer('cuenta_id');
            $table->date('fecha');
            $table->string('referencia',20);
            $table->string('cliente',100);
            $table->string('concepto',100);
            $table->string('bl',20);
            $table->string('contenedor',20);
            $table->string('factura',15);
            $table->integer('cantidad');
            $table->string('moneda',10);
            $table->string('obeservacion',100);
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
        Schema::dropIfExists('pagos');
    }
};
