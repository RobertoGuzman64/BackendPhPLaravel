<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJugadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jugadors', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('partidaId');
            $table->foreign('partidaId')
                ->references('id')
                ->on('partidas')
                ->unsigned()
                ->constrained('partidas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedInteger('usuarioId');
            $table->foreign('usuarioId')
                ->references('id')
                ->on('usuarios')
                ->unsigned()
                ->constrained('usuarios')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('jugadors');
    }
}
