<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyProfesorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profesors', function (Blueprint $table) {
            //
            $table->integer('id_establecimiento')->unsigned(); 
            $table->foreign('id_establecimiento')->references('id_establecimiento')->on('establecimientos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profesors', function (Blueprint $table) {
            //
        });
    }
}
