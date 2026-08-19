@extends('plantilla.plantilla')

@section('contenido')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">

                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Agenda Médica</h6>
                    </div>

                    <div class="pull-right" @if (auth()->user()->rol_id == 5) hidden @endif>
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

                <form id="formCrearCita">
                    @csrf

                    <div class="modal-header">
                        <h4 class="modal-title">Nueva Cita Médica</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Identificación del Paciente</label>
                            <input type="text" name="identificacion" class="form-control" required>
                        </div>

                        <input type="hidden" name="doctor_id" id="modal_doctor_id">
                        <input type="hidden" name="start" id="modal_start">
                        <input type="hidden" name="end" id="modal_end">

                        <div class="form-group">
                            <label>Fecha Inicio</label>
                            <input type="text" id="preview_start" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Fecha Fin</label>
                            <input type="text" id="preview_end" class="form-control" readonly>
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



<script>
$(document).ready(function() {
    moment.locale('es');
    $('#calendar').fullCalendar({

        locale: 'es',

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
        select: function(start, end) {

            if (!$('#doctorFilter').val()) {
                alert("Debe seleccionar un doctor antes de agendar.");
                return;
            }

            $('#modal_start').val(start.format());
            $('#modal_end').val(end.format());
            $('#modal_doctor_id').val($('#doctorFilter').val());

            $('#preview_start').val(start.format('YYYY-MM-DD HH:mm'));
            $('#preview_end').val(end.format('YYYY-MM-DD HH:mm'));

            $('#crearCitaModal').modal('show');
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

});


/* ==========================================
   CREAR CITA
========================================== */
$('#formCrearCita').submit(function(e) {

    e.preventDefault();

    $.ajax({
        url: "{{ route('agenda.store') }}",
        type: "POST",
        data: $(this).serialize(),
        success: function() {

            $('#crearCitaModal').modal('hide');
            $('#calendar').fullCalendar('refetchEvents');
            $('#formCrearCita')[0].reset();

            alert("Cita creada correctamente");
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert("Error al crear la cita");
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

