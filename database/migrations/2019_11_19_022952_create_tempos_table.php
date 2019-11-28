<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('hora_inicio');
            $table->time('hora_final');
            $table->string('dia_da_semana');
            $table->unsignedInteger("quadro_horario_id");
            $table->unsignedInteger("professor_id");
            $table->boolean('intervalo')->default(false);
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
        Schema::dropIfExists('tempos');
    }
}
