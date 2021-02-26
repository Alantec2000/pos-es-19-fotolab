<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fl_servicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('fotografo_id');
            $table->string('titulo');
            $table->string('descricao');
            $table->dateTime('data_inicio');
            $table->dateTime('data_fim');
            $table->string('status', 30);
            $table->boolean('avaliado');
            $table->timestamps();
        });

        Schema::table('fl_servicos', function (Blueprint $table) {
            $table->foreign('cliente_id')->references('id')->on('fl_usuarios');
            $table->foreign('fotografo_id')->references('id')->on('fl_usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
