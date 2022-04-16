<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mensaje', 100);
            $table->string('fecha', 100);
            $table->unsignedInteger('usuarioId');
            $table->foreign('usuarioId')
                ->references('id')
                ->on('users')
                ->unsigned()
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedInteger('partidaId');
            $table->foreign('partidaId')
                ->references('id')
                ->on('partidas')
                ->unsigned()
                ->constrained('partidas')
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
        Schema::dropIfExists('mensajes');
    }
}
