<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddComposicaoIdToQuadroHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quadro_horarios', function (Blueprint $table) {
            $table->unsignedBigInteger('composicao_id')->nullable();
            $table->foreign('composicao_id')->references('id')->on('composicoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quadro_horarios', function (Blueprint $table) {
            $table->dropForeign('quadro_horarios_composicao_id_foreign');
        });
    }
}
