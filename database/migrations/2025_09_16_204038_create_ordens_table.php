<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consulta_id')->nullable(); // Relación con consulta si aplica
            $table->unsignedBigInteger('paciente_id')->nullable(); // Relación con consulta si aplica
            $table->timestamps();

            // Si existe la tabla consultas
            $table->foreign('consulta_id')->references('id')->on('consulta')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden');
    }
}
