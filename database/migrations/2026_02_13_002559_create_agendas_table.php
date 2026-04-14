<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();

            $table->integer('medico_id')->unsigned();
            $table->integer('paciente_id')->unsigned();


            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');

            $table->enum('estado', [
                'agendada',
                'confirmada',
                'cancelada',
                'completada'
            ])->default('agendada');

            $table->timestamps();

            $table->unique(['medico_id', 'fecha_inicio']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agenda');
    }
}
