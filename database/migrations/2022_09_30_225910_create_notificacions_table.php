<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_establecimiento')->unsigned();
            $table->integer('id_tipo_actividad')->unsigned();
            $table->integer('id_profesor')->unsigned();
            $table->unsignedBigInteger('user_id');
            $table->string('titulo_actividad');
            $table->string('descripcion');
            $table->dateTime('fecha_inicial');
            $table->dateTime('fecha_final');
            $table->string('filepath')->nullable();
            $table->foreign('id_profesor')->references('id')->on('profesors');
            $table->foreign('id_establecimiento')->references('id_establecimiento')->on('establecimientos');            
            $table->foreign('id_tipo_actividad')->references('id')->on('tipo_notificacions');
            $table->foreign('user_id')->references('id')->on('users');


            $table->boolean('estado')->default(true);
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
        Schema::dropIfExists('notificacions');
    }
}
