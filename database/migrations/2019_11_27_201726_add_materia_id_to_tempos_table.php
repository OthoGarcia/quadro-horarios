<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMateriaIdToTemposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tempos', function (Blueprint $table) {
            $table->unsignedInteger("materia_id");
            $table->foreign('materia_id')->references('id')->on('materias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tempos', function (Blueprint $table) {
            $table->dropForeign('tempos_materia_id_foreign');
            $table->dropColumn("materia_id");
        });
    }
}
