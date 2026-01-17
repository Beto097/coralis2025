<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="addNewOrdenModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <form id="ordenForm" action="@if($consulta->tieneOrden()) {{ route('orden.update', $consulta->orden()->id) }} @else {{ route('orden.insert') }} @endif" method="POST" role="form" autocomplete="off">
                        @csrf
                        @if($consulta->tieneOrden())
                            @method('PUT')
                        @endif
            {{-- HEADER --}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">
                    @if($consulta->tieneOrden())
                        Editar Orden de laboratorio
                    @else
                        Crear Orden de laboratorio
                    @endif
                </h5>
                <div class=text-right>
                    <button type="submit"  class="btn btn-primary">
                        @if($consulta->tieneOrden())
                            Actualizar Orden
                        @else
                            Crear Orden
                        @endif
                    </button>
                </div>
            </div>

            {{-- BODY --}}
            <div class="modal-body">
                <div class="form-wrap">
                    {{-- Buscador --}}
                    <div class="form-group mb-3">
                        <label for="searchExamenes">Buscar exámenes:</label><br>
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" 
                                       id="searchExamenes" 
                                       class="form-control" 
                                       placeholder="Escriba al menos 2 caracteres para buscar..." 
                                       autocomplete="off">
                            </div>
                            <div class="col-md-4">
                                <button type="button" 
                                        id="agregarExamenBtn" 
                                        class="btn btn-success btn-sm"
                                        style="display: none; width: 100%;">
                                    <i class="fa fa-plus"></i> Agregar Examen
                                </button>
                            </div>
                        </div>
                        <div id="noResultsMessage" style="display: none;" class="text-muted mt-2">
                            <small>No se encontraron exámenes. Use el botón "Agregar Examen" para crear uno nuevo.</small>
                        </div>
                    </div><br>
                    <hr>
                    
                    {{-- Checkboxes --}}
                    <div id="examenesContainer">
                        <x-cuadro-examenes :consulta="$consulta" :tipo-examen="1" />
                    </div>
                    <input type="hidden" name="consulta_id" value="{{ $consulta->id }}">
                </div>
            </div>

            {{-- FOOTER --}}
            <div class="modal-footer d-flex justify-content-center">
                
            </div>

                {{-- FOOTER (separado y abajo en su propia fila) --}}
                <div class="modal-footer d-flex justify-content-center">
                    
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
<script>
// Inicializar funciones cuando el DOM esté listo
$(document).ready(function() {
    // Inicializar búsqueda de exámenes
    initExamenSearch();
});

// Función para manejar el buscador de exámenes
function initExamenSearch() {
    $('#searchExamenes').on('input', function() {
        var searchTerm = $(this).val().toLowerCase().trim();
        
        if (searchTerm.length >= 2) {
            var hasVisibleResults = false;
            var hasExactMatch = false;
            
            // Filtrar los checkboxes y verificar coincidencias
            $('#examenesContainer .form-check-inline').each(function() {
                var examenName = $(this).find('strong').text().toLowerCase();
                
                // Verificar coincidencia exacta
                if (examenName === searchTerm) {
                    hasExactMatch = true;
                }
                
                // Mostrar elementos que contengan el término (para filtrado visual)
                if (examenName.indexOf(searchTerm) !== -1) {
                    $(this).show();
                    hasVisibleResults = true;
                } else {
                    $(this).hide();
                }
            });
            
            // Mostrar botón agregar solo si NO hay coincidencia exacta
            if (!hasExactMatch) {
                $('#agregarExamenBtn').show();
                if (hasVisibleResults) {
                    $('#noResultsMessage').hide();
                } else {
                    $('#noResultsMessage').show();
                }
                console.log('Mostrando botón agregar - no hay coincidencia exacta para: ' + searchTerm);
            } else {
                $('#agregarExamenBtn').hide();
                $('#noResultsMessage').hide();
                console.log('Ocultando botón agregar - existe coincidencia exacta para: ' + searchTerm);
            }
        } else {
            // Si hay menos de 2 caracteres o está vacío, mostrar todos y ocultar botón y mensaje
            $('#examenesContainer .form-check-inline').show();
            $('#agregarExamenBtn').hide();
            $('#noResultsMessage').hide();
        }
    });
    
    // Manejar el click del botón agregar examen
    $('#agregarExamenBtn').off('click').on('click', function() {
        var nombreExamen = $('#searchExamenes').val().trim();
        
        if (nombreExamen.length < 2) {
            alert('Por favor escriba al menos 2 caracteres para el nombre del examen.');
            return;
        }
        
        // Confirmar con el usuario
        if (confirm('¿Está seguro que desea agregar el examen "' + nombreExamen + '"?')) {
            agregarNuevoExamen(nombreExamen, 1); // tipo_examen = 1 para laboratorios
        }
    });
    
    // Limpiar búsqueda cuando se cierre el modal
    $('#addNewOrdenModal').on('hidden.bs.modal', function() {
        $('#searchExamenes').val('');
        $('#examenesContainer .form-check-inline').show();
        $('#agregarExamenBtn').hide();
        $('#noResultsMessage').hide();
    });
}

// Función para agregar un nuevo examen
function agregarNuevoExamen(nombreExamen, tipoExamen) {
    tipoExamen = tipoExamen || 1; // Default tipo_examen = 1 si no se especifica
    
    $.ajax({
        url: "{{ route('examen.agregar') }}",
        method: 'POST',
        data: {
            _token: "{{ csrf_token() }}",
            nombre_examen: nombreExamen,
            tipo_examen: tipoExamen
        },
        beforeSend: function() {
            if (tipoExamen === 1) {
                $('#agregarExamenBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Agregando...');
            } else {
                $('#agregarEstudioBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Agregando...');
            }
        },
        success: function(response) {
            if (response.success) {
                // Limpiar campo de búsqueda
                if (tipoExamen === 1) {
                    $('#searchExamenes').val('');
                    $('#agregarExamenBtn').hide();
                    $('#noResultsMessage').hide();
                    refrescarExamenes(1);
                } else {
                    $('#searchEstudios').val('');
                    $('#agregarEstudioBtn').hide();
                    $('#noResultsMessageEstudios').hide();
                    if (typeof refrescarEstudios === 'function') {
                        refrescarEstudios();
                    }
                }
                
                console.log('Examen/Estudio agregado correctamente: ' + nombreExamen);
            } else {
                var tipoTexto = tipoExamen === 1 ? 'examen' : 'estudio';
                alert('Error al agregar el ' + tipoTexto + '.');
            }
        },
        error: function(xhr) {
            var tipoTexto = tipoExamen === 1 ? 'examen' : 'estudio';
            alert('Error al agregar el ' + tipoTexto + '. Por favor intente nuevamente.');
            console.error(xhr.responseText);
        },
        complete: function() {
            if (tipoExamen === 1) {
                $('#agregarExamenBtn').prop('disabled', false).html('<i class="fa fa-plus"></i> Agregar Examen');
            } else {
                $('#agregarEstudioBtn').prop('disabled', false).html('<i class="fa fa-plus"></i> Agregar Estudio');
            }
        }
    });
}

// Función para refrescar la lista de exámenes (solo laboratorios)
function refrescarExamenes(tipoExamen) {
    tipoExamen = tipoExamen || 1; // Default tipo_examen = 1
    
    $.ajax({
        url: "{{ route('examen.lista') }}",
        method: 'GET',
        data: {
            consulta_id: $('input[name="consulta_id"]').val(),
            tipo_examen: tipoExamen
        },
        success: function(response) {
            console.log('Refrescando exámenes tipo', tipoExamen);
            
            $('#examenesContainer').html(response);
            // Resetear estado del buscador
            $('#searchExamenes').val('');
            $('#agregarExamenBtn').hide();
            $('#noResultsMessage').hide();
            
            // Asegurar visibilidad
            setTimeout(function() {
                $('#examenesContainer .form-check-inline').show();
                initExamenSearch();
            }, 100);
        },
        error: function(xhr) {
            console.error('Error al refrescar exámenes:', xhr.responseText);
            alert('Error al refrescar la lista de exámenes. Código: ' + xhr.status);
        }
    });
}
</script>
@endsection