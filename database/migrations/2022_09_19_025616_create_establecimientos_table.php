<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablecimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establecimientos', function (Blueprint $table) {
            $table->increments('id_establecimiento');
            $table->string('nombre');
            $table->string('direccion');
            $table->date('telefono')->nullable();
            $table->string('codigo_establecimiento')->nullable();            
            $table->boolean('estado')->default(true);
            $table->integer('id_supervisor')->unsigned();
            $table->foreign('id_supervisor')->references('id_supervisor')->on('supervisors');
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
        Schema::dropIfExists('establecimientos');
    }
}
