<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddLlegoEstadoToAgendaTable extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE agenda MODIFY estado ENUM('agendada','confirmada','llego','cancelada','completada') NOT NULL DEFAULT 'agendada'");
    }

    public function down()
    {
        DB::statement("UPDATE agenda SET estado = 'confirmada' WHERE estado = 'llego'");
        DB::statement("ALTER TABLE agenda MODIFY estado ENUM('agendada','confirmada','cancelada','completada') NOT NULL DEFAULT 'agendada'");
    }
}
