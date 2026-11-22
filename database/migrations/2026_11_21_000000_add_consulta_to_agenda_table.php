<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConsultaToAgendaTable extends Migration
{
    public function up()
    {
        Schema::table('agenda', function (Blueprint $table) {
            $table->unsignedBigInteger('consulta_id')->nullable()->after('estado');
            $table->unsignedBigInteger('usuario_id')->nullable()->after('consulta_id');
        });
    }

    public function down()
    {
        Schema::table('agenda', function (Blueprint $table) {
            $table->dropColumn(['consulta_id', 'usuario_id']);
        });
    }
}
