<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacacion', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idVacacion');

            $table->unsignedInteger('id');
            $table->foreign('id')->references('id')->on('users');

            $table->date('fechaInicio');
            $table->date('fechaFin');

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
        Schema::dropIfExists('vacacion');
    }
}
