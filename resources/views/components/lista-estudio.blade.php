{{-- Buscador para estudios --}}
<div class="form-group mb-3">
    <label for="searchEstudios">Buscar estudios:</label>
    <div class="row">
        <div class="col-md-8">
            <input type="text" 
                   id="searchEstudios" 
                   class="form-control" 
                   placeholder="Escriba al menos 2 caracteres para buscar..." 
                   autocomplete="off">
        </div>
        <div class="col-md-4">
            <button type="button" 
                    id="agregarEstudioBtn" 
                    class="btn btn-success btn-sm"
                    style="display: none; width: 100%;">
                <i class="fa fa-plus"></i> Agregar Estudio
            </button>
        </div>
    </div>
    <div id="noResultsMessageEstudios" style="display: none;" class="text-muted mt-2">
        <small>No se encontraron estudios. Use el botón "Agregar Estudio" para crear uno nuevo.</small>
    </div>
</div>

{{-- Lista de estudios (checkboxes) --}}
<div id="estudiosContainer">
    <div class="col-row">
        @foreach($examenes as $examen)
            <div class="form-check-inline col-md-4 mb-2">
                <label class="form-check-label">
                    <input type="checkbox" 
                           class="form-check-input examen-check" 
                           value="{{$examen->id}}" 
                           name="examenes_id[]"
                           @if(in_array($examen->id, $examenesSeleccionados)) checked @endif>
                    <strong>{{$examen->nombre_examen}}</strong>
                </label>
            </div>
        @endforeach
    </div>
</div>

<script>
// Función para manejar el buscador de estudios
function initEstudiosSearch() {
    $('#searchEstudios').on('input', function() {
        var searchTerm = $(this).val().toLowerCase();
        
        if (searchTerm.length >= 2) {
            var hasResults = false;
            $('#estudiosContainer .form-check-inline').each(function() {
                var estudioName = $(this).find('strong').text().toLowerCase();
                
                if (estudioName.indexOf(searchTerm) !== -1) {
                    $(this).show();
                    hasResults = true;
                } else {
                    $(this).hide();
                }
            });
            
            if (!hasResults && searchTerm.length >= 2) {
                $('#agregarEstudioBtn').show();
                $('#noResultsMessageEstudios').show();
            } else {
                $('#agregarEstudioBtn').hide();
                $('#noResultsMessageEstudios').hide();
            }
        } else {
            $('#estudiosContainer .form-check-inline').show();
            $('#agregarEstudioBtn').hide();
            $('#noResultsMessageEstudios').hide();
        }
    });
    
    // Manejar el click del botón agregar estudio
    $('#agregarEstudioBtn').off('click').on('click', function() {
        var nombreEstudio = $('#searchEstudios').val().trim();
        
        if (nombreEstudio.length < 2) {
            alert('Por favor escriba al menos 2 caracteres para el nombre del estudio.');
            return;
        }
        
        if (confirm('¿Está seguro que desea agregar el estudio "' + nombreEstudio + '"?')) {
            agregarNuevoEstudio(nombreEstudio, 2);
        }
    });
}

// Función para agregar un nuevo estudio
function agregarNuevoEstudio(nombreEstudio, tipoExamen) {
    tipoExamen = tipoExamen || 2;
    
    $.ajax({
        url: "{{ route('examen.agregar') }}",
        method: 'POST',
        data: {
            _token: "{{ csrf_token() }}",
            nombre_examen: nombreEstudio,
            tipo_examen: tipoExamen
        },
        beforeSend: function() {
            $('#agregarEstudioBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Agregando...');
        },
        success: function(response) {
            if (response.success) {
                $('#searchEstudios').val('');
                $('#agregarEstudioBtn').hide();
                $('#noResultsMessageEstudios').hide();
                refrescarEstudios();
            }
        },
        error: function(xhr) {
            alert('Error al agregar el estudio. Por favor intente nuevamente.');
            console.error(xhr.responseText);
        },
        complete: function() {
            $('#agregarEstudioBtn').prop('disabled', false).html('<i class="fa fa-plus"></i> Agregar Estudio');
        }
    });
}

// Función para refrescar estudios específicamente
function refrescarEstudios() {
    $.ajax({
        url: "{{ route('examen.lista') }}",
        method: 'GET',
        data: {
            consulta_id: $('input[name="consulta_id"]').val(),
            tipo_examen: 2
        },
        success: function(response) {
            $('#estudiosContainer').html(response);
            setTimeout(function() {
                $('#estudiosContainer .form-check-inline').show();
                initEstudiosSearch();
            }, 100);
        },
        error: function(xhr) {
            console.error('Error al refrescar estudios:', xhr.responseText);
        }
    });
}

// Inicializar cuando se carga el componente
$(document).ready(function() {
    if ($('#addNewOrdenEstudioModal').is(':visible')) {
        initEstudiosSearch();
    }
});

// Inicializar cuando se abre el modal de estudios
$('#addNewOrdenEstudioModal').on('shown.bs.modal', function() {
    initEstudiosSearch();
});
</script>