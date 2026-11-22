@extends('plantilla.plantilla')

@section('contenido')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">

                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Agenda Médica</h6>
                    </div>
                    <div style="float: right;">
                        <button type="button" id="btnCrearAgenda" class="btn btn-success font-weight-bold mb-2 me-2" title="Crear agenda">
                            Crear agenda
                        </button>
                    </div>

                    <div class="pull-right" style="margin-right: 10px;" @if (auth()->user()->rol_id == 5) hidden @endif>
                        <select id="doctorFilter" class="form-control">
                            @if (auth()->user()->rol_id != 5)
                                <option value="">Todos los doctores</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">
                                        {{ $doctor->primer_nombre_usuario }} {{ $doctor->apellido_usuario }}
                                    </option>
                                @endforeach
                            @else
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" selected>
                                        {{ $doctor->primer_nombre_usuario }} {{ $doctor->apellido_usuario }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="clearfix"></div>
                </div>

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div id="calendar"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Crear Cita -->
    <div class="modal fade" id="crearCitaModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form id="formCrearCita" autocomplete="off">
                    @csrf

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Nueva Cita Médica</h4>
                    </div>

                    <div class="modal-body">

                        <div class="form-group" style="position: relative;">
                            <label>Paciente</label>
                            <input type="text" id="buscarPaciente" class="form-control"
                                placeholder="Buscar por identificación o nombre (mínimo 2 caracteres)">
                            <input type="hidden" name="identificacion" id="modal_identificacion">
                            <div id="resultadosPaciente" class="list-group"
                                style="position: absolute; z-index: 1060; left: 0; right: 0; max-height: 200px; overflow-y: auto; display: none; margin-bottom: 0;">
                            </div>
                            <p id="pacienteSeleccionado" class="help-block"></p>
                        </div>

                        <div class="form-group">
                            <label>Médico</label>
                            <select name="doctor_id" id="modal_doctor_id" class="form-control" required>
                                <option value="">Seleccione un médico</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">
                                        {{ $doctor->primer_nombre_usuario }} {{ $doctor->apellido_usuario }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="start" id="modal_start">
                        <input type="hidden" name="end" id="modal_end">

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <input type="date" id="modal_fecha" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Hora inicio</label>
                                    <input type="time" id="modal_hora_inicio" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Hora fin</label>
                                    <input type="time" id="modal_hora_fin" class="form-control" required>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar Cita</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <div class="modal fade" id="editarCitaModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form id="formEditarCita">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="edit_id">

                    <div class="modal-header">
                        <h4 class="modal-title">Editar Cita</h4>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Médico</label>
                            <select id="edit_medico_id" class="form-control">
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">
                                        {{ $doctor->primer_nombre_usuario }} {{ $doctor->apellido_usuario }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Estado</label>
                            <select id="edit_estado" class="form-control">
                                <option value="agendada">Agendada</option>
                                <option value="confirmada">Confirmada</option>
                                <option value="llego">Paciente llegó</option>
                                <option value="cancelada">Cancelada</option>
                                <option value="completada">Completada</option>
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" id="btnEliminarCita" class="btn btn-danger">
                            Eliminar
                        </button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection


@section('javaScript')

<script src="{{ asset('vendors/bower_components/fullcalendar/dist/lang/es.js') }}"></script>

<script>
var pacientePrefill = @json(isset($paciente) && $paciente ? ['identificacion' => $paciente->identificacion_paciente, 'nombre' => $paciente->nombre_paciente.' '.$paciente->apellido_paciente] : null);

function seleccionarPaciente(identificacion, nombre) {
    $('#modal_identificacion').val(identificacion);
    $('#buscarPaciente').val('');
    $('#resultadosPaciente').hide().empty();
    $('#pacienteSeleccionado').html('<strong>' + $('<div>').text(nombre + ' (' + identificacion + ')').html() + '</strong>');
}

function abrirModalCrear(fecha, horaInicio, horaFin) {
    $('#formCrearCita')[0].reset();
    $('#modal_identificacion').val('');
    $('#pacienteSeleccionado').empty();
    $('#resultadosPaciente').hide().empty();

    $('#modal_doctor_id').val($('#doctorFilter').val() || '');
    $('#modal_fecha').val(fecha);
    $('#modal_hora_inicio').val(horaInicio);
    $('#modal_hora_fin').val(horaFin);

    if (pacientePrefill) {
        seleccionarPaciente(pacientePrefill.identificacion, pacientePrefill.nombre);
    }

    $('#crearCitaModal').modal('show');
}

$(document).ready(function() {
    // fullcalendar-data.js ya inicializa #calendar con datos de demostración
    $('#calendar').fullCalendar('destroy');

    $('#calendar').fullCalendar({

        lang: 'es',

        monthNames: [
        'Enero','Febrero','Marzo','Abril','Mayo','Junio',
        'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
        ],
        monthNamesShort: [
        'Ene','Feb','Mar','Abr','May','Jun',
        'Jul','Ago','Sep','Oct','Nov','Dic'
        ],
        dayNames: [
        'Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'
        ],
        dayNamesShort: [
        'Dom','Lun','Mar','Mié','Jue','Vie','Sáb'
        ],

        height: 650,

        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },

        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día'
        },

        allDayText: 'Todo el día',

        defaultView: 'agendaWeek',
        allDaySlot: false,

        selectable: true,
        editable: true,
        eventDurationEditable: true,
        eventLimit: true,

        /* ==========================================
           TRAER EVENTOS
        ========================================== */
        events: function(start, end, timezone, callback) {

            $.ajax({
                url: "{{ route('agenda.events') }}",
                type: "GET",
                dataType: "json",
                data: {
                    start: start.format(),
                    end: end.format(),
                    doctor_id: $('#doctorFilter').val()
                },
                success: function(response) {

                    let events = response.map(function(item) {
                        return {
                            id: item.id,
                            title: item.title,
                            start: item.start,
                            end: item.end,
                            color: item.color,
                            medico_id: item.medico_id,
                            estado: item.estado
                        };
                    });

                    callback(events);
                }
            });
        },

        /* ==========================================
           SELECCIONAR PARA CREAR
        ========================================== */
        select: function(start, end, jsEvent, view) {

            // En vista mensual, el clic en un día abre el detalle de ese día
            if (view.name === 'month') {
                $('#calendar').fullCalendar('unselect');
                $('#calendar').fullCalendar('changeView', 'agendaDay', start.format('YYYY-MM-DD'));
                return;
            }

            abrirModalCrear(
                start.format('YYYY-MM-DD'),
                start.format('HH:mm'),
                end.format('HH:mm')
            );
        },

        /* ==========================================
           CLICK PARA EDITAR
        ========================================== */
        eventClick: function(event) {
            abrirModalEditar(event);
        },

        /* ==========================================
           MOVER EVENTO
        ========================================== */
        eventDrop: function(event, delta, revertFunc) {
            actualizarHorario(event, revertFunc);
        },

        /* ==========================================
           REDIMENSIONAR EVENTO
        ========================================== */
        eventResize: function(event, delta, revertFunc) {
            actualizarHorario(event, revertFunc);
        }

    });

    $('#doctorFilter').change(function() {
        $('#calendar').fullCalendar('refetchEvents');
    });

    $('#btnCrearAgenda').click(function() {
        var fecha = $('#calendar').fullCalendar('getDate').format('YYYY-MM-DD');
        abrirModalCrear(fecha, '08:00', '08:30');
    });

    var temporizadorBusqueda;
    $('#buscarPaciente').on('input', function() {
        var q = $.trim($(this).val());
        clearTimeout(temporizadorBusqueda);

        if (q.length < 2) {
            $('#resultadosPaciente').hide().empty();
            return;
        }

        temporizadorBusqueda = setTimeout(function() {
            $.getJSON("{{ route('agenda.pacientes') }}", { q: q }, function(pacientes) {
                var lista = $('#resultadosPaciente').empty();

                if (!pacientes.length) {
                    lista.append('<span class="list-group-item">Sin resultados</span>');
                }

                pacientes.forEach(function(p) {
                    var nombre = p.nombre_paciente + ' ' + p.apellido_paciente;
                    $('<a href="javascript:void(0);" class="list-group-item"></a>')
                        .text(p.identificacion_paciente + ' - ' + nombre)
                        .on('click', function() {
                            seleccionarPaciente(p.identificacion_paciente, nombre);
                        })
                        .appendTo(lista);
                });

                lista.show();
            });
        }, 300);
    });

});


/* ==========================================
   CREAR CITA
========================================== */
$('#formCrearCita').submit(function(e) {

    e.preventDefault();

    if (!$('#modal_identificacion').val()) {
        alert("Debe buscar y seleccionar un paciente.");
        return;
    }

    var fecha = $('#modal_fecha').val();
    $('#modal_start').val(fecha + ' ' + $('#modal_hora_inicio').val() + ':00');
    $('#modal_end').val(fecha + ' ' + $('#modal_hora_fin').val() + ':00');

    $.ajax({
        url: "{{ route('agenda.store') }}",
        type: "POST",
        dataType: "json",
        data: $(this).serialize(),
        success: function() {

            $('#crearCitaModal').modal('hide');
            $('#calendar').fullCalendar('refetchEvents');

            alert("Cita creada correctamente");
        },
        error: function(xhr) {
            var json = xhr.responseJSON || {};
            var errores = json.errors ? Object.values(json.errors).join('\n') : null;
            alert(errores || json.message || "Error al crear la cita");
        }
    });

});


/* ==========================================
   ABRIR MODAL EDITAR
========================================== */
function abrirModalEditar(event) {

    $('#edit_id').val(event.id);
    $('#edit_medico_id').val(event.medico_id);
    $('#edit_estado').val(event.estado);

    $('#editarCitaModal').modal('show');
}


/* ==========================================
   ACTUALIZAR ESTADO Y MÉDICO
========================================== */
$('#formEditarCita').submit(function(e) {

    e.preventDefault();

    let id = $('#edit_id').val();

    $.ajax({
        url: "/agenda/update/" + id,
        type: "PUT",
        data: {
            _token: "{{ csrf_token() }}",
            medico_id: $('#edit_medico_id').val(),
            estado: $('#edit_estado').val()
        },
        success: function() {

            $('#editarCitaModal').modal('hide');
            $('#calendar').fullCalendar('refetchEvents');

            alert("Cita actualizada correctamente");
        },
        error: function() {
            alert("Error al actualizar la cita");
        }
    });

});


/* ==========================================
   ELIMINAR CITA
========================================== */
$('#btnEliminarCita').click(function() {

    let id = $('#edit_id').val();

    if (!confirm("¿Está seguro que desea eliminar esta cita?")) {
        return;
    }

    $.ajax({
        url: "/agenda/delete/" + id,
        type: "DELETE",
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function() {

            $('#editarCitaModal').modal('hide');
            $('#calendar').fullCalendar('refetchEvents');

            alert("Cita eliminada correctamente");
        },
        error: function() {
            alert("No se pudo eliminar la cita");
        }
    });

});


/* ==========================================
   ACTUALIZAR HORARIO (DRAG & RESIZE)
========================================== */
function actualizarHorario(event, revertFunc) {

    $.ajax({
        url: "/agenda/update-horario/" + event.id,
        type: "PUT",
        data: {
            _token: "{{ csrf_token() }}",
            fecha_inicio: event.start.format(),
            fecha_fin: event.end ? event.end.format() : event.start.format()
        },
        error: function() {
            alert("No se pudo actualizar el horario");
            revertFunc();
        }
    });

}
</script>

@endsection

