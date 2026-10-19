<?php

namespace Tests\Feature;

use App\Models\Agenda;
use App\Models\consulta;
use App\Models\medico;
use App\Models\paciente;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AgendaStoresConsultaTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropIfExists('agenda');
        Schema::dropIfExists('consulta');
        Schema::dropIfExists('paciente');
        Schema::dropIfExists('usuario');

        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('primer_nombre_usuario')->nullable();
            $table->string('apellido_usuario')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->integer('rol_id')->default(5);
            $table->timestamps();
        });

        Schema::create('paciente', function (Blueprint $table) {
            $table->id();
            $table->string('identificacion_paciente');
            $table->string('nombre_paciente');
            $table->string('apellido_paciente');
            $table->string('telefono_paciente')->nullable();
            $table->date('fecha_nacimiento_paciente')->nullable();
            $table->timestamps();
        });

        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medico_id');
            $table->unsignedBigInteger('paciente_id');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->string('estado')->default('agendada');
            $table->timestamps();
        });

        Schema::create('consulta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('medico_id')->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('sucursal_id')->nullable();
            $table->string('estado_consulta')->default('Pendiente');
            $table->string('motivo_consulta')->nullable();
            $table->timestamps();
        });
    }

    public function test_creates_consulta_when_agenda_is_confirmed(): void
    {
        $paciente = new paciente();
        $paciente->identificacion_paciente = '12345678';
        $paciente->nombre_paciente = 'Ana';
        $paciente->apellido_paciente = 'García';
        $paciente->fecha_nacimiento_paciente = '1995-01-10';
        $paciente->save();

        $medico = new medico();
        $medico->rol_id = 5;
        $medico->primer_nombre_usuario = 'Carlos';
        $medico->apellido_usuario = 'Pérez';
        $medico->email = 'medico@test.com';
        $medico->password = bcrypt('secret');
        $medico->save();

        $response = $this->post(route('agenda.store'), [
            'identificacion' => $paciente->identificacion_paciente,
            'doctor_id' => $medico->id,
            'start' => '2026-08-20 09:00:00',
            'end' => '2026-08-20 09:30:00',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('agenda', [
            'paciente_id' => $paciente->id,
            'medico_id' => $medico->id,
            'estado' => 'agendada',
        ]);
        $this->assertDatabaseHas('consulta', [
            'paciente_id' => $paciente->id,
            'medico_id' => $medico->id,
            'estado_consulta' => 'Pendiente',
        ]);
    }
}
