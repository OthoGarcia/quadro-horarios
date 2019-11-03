<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuadroHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quadro_horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('quantidade_tempos')->nullable();
            $table->integer('tempo_intervalo')->nullable();
            $table->integer('turma_id')->unsigned();
            $table->foreign('turma_id')->references('id')->on('turmas');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quadro_horarios');
    }
}
