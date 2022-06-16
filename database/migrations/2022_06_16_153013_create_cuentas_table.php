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
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('provedor_id');
            $table->string('banco',100);
            $table->string('sucursal',100);
            $table->string('direccion',500);
            $table->string('cuenta',20);
            $table->string('clave',18);
            $table->string('swifts');
            $table->string('aba');
            $table->string('moneda');
            $table->string('observaciones',100);
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
        Schema::dropIfExists('cuentas');
    }
};
