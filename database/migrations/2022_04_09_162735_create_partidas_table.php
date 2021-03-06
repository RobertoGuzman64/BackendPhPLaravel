<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100);
            $table->unsignedInteger('juegoId');
            $table->foreign('juegoId')
                ->references('id')
                ->on('juegos')
                ->unsigned()
                ->constrained('juegos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedInteger('propietarioId');
            $table->foreign('propietarioId')
                ->references('id')
                ->on('users')
                ->unsigned()
                ->constrained('users')
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
        Schema::dropIfExists('partidas');
    }
}
