<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="addNewOrdenEstudioModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <form id="ordenEstudioForm" action="@if($consulta->tieneEstudio()) {{ route('orden.update', $consulta->ordenEstudio()->id) }} @else {{ route('orden.insert') }} @endif" method="POST" role="form" autocomplete="off">
                        @csrf
                        @if($consulta->tieneEstudio())
                            @method('PUT')
                        @endif
            {{-- HEADER --}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">
                    @if($consulta->tieneEstudio())
                        Editar Orden de estudios
                    @else
                        Crear Orden de estudios
                    @endif
                </h5>
                <div class=text-right>
                    <button type="submit"  class="btn btn-primary">
                        @if($consulta->tieneEstudio())
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
                        <label for="searchEstudios">Buscar estudios:</label><br>
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
                    </div><br>
                    <hr>
                    
                    {{-- Checkboxes --}}
                    <div id="estudiosContainer">
                        <x-cuadro-examenes :consulta="$consulta" :tipo-examen="2" />
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

<script>
// Variables globales para manejar event listeners
let searchHandler = null;
let agregarHandler = null;
let isProcessing = false; // Flag para evitar múltiples clicks

// Función para inicializar el buscador de estudios (JavaScript vanilla)
function initEstudioSearch() {
    console.log('Inicializando búsqueda de estudios...');
    
    const searchInput = document.getElementById('searchEstudios');
    const agregarBtn = document.getElementById('agregarEstudioBtn');
    const noResultsMsg = document.getElementById('noResultsMessageEstudios');
    const estudiosContainer = document.getElementById('estudiosContainer');
    
    if (!searchInput || !agregarBtn || !estudiosContainer) {
        console.log('Elementos no encontrados, reintentando...');
        setTimeout(initEstudioSearch, 500);
        return;
    }
    
    // Limpiar eventos previos COMPLETAMENTE
    if (searchHandler) {
        searchInput.removeEventListener('input', searchHandler);
        searchInput.removeEventListener('keyup', searchHandler);
    }
    if (agregarHandler) {
        agregarBtn.removeEventListener('click', agregarHandler);
    }
    
    // Definir handlers como funciones nombradas para poder removerlas
    searchHandler = function() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        console.log('Búsqueda:', searchTerm);
        
        if (searchTerm.length >= 2) {
            let hasVisibleResults = false;
            let hasExactMatch = false;
            const checkboxes = estudiosContainer.querySelectorAll('.form-check-inline');
            
            checkboxes.forEach(function(checkbox) {
                const strongElement = checkbox.querySelector('strong');
                if (strongElement) {
                    const estudioName = strongElement.textContent.toLowerCase();
                    
                    // Verificar coincidencia exacta
                    if (estudioName === searchTerm) {
                        hasExactMatch = true;
                    }
                    
                    // Mostrar elementos que contengan el término (para filtrado visual)
                    if (estudioName.indexOf(searchTerm) !== -1) {
                        checkbox.style.display = 'block';
                        hasVisibleResults = true;
                    } else {
                        checkbox.style.display = 'none';
                    }
                }
            });
            
            // Mostrar botón agregar solo si NO hay coincidencia exacta
            if (!hasExactMatch) {
                agregarBtn.style.display = 'block';
                if (noResultsMsg) {
                    if (hasVisibleResults) {
                        noResultsMsg.style.display = 'none';
                    } else {
                        noResultsMsg.style.display = 'block';
                    }
                }
                console.log('Mostrando botón agregar - no hay coincidencia exacta');
            } else {
                agregarBtn.style.display = 'none';
                if (noResultsMsg) noResultsMsg.style.display = 'none';
                console.log('Ocultando botón agregar - existe coincidencia exacta');
            }
        } else {
            // Mostrar todos los elementos
            const checkboxes = estudiosContainer.querySelectorAll('.form-check-inline');
            checkboxes.forEach(function(checkbox) {
                checkbox.style.display = 'block';
            });
            agregarBtn.style.display = 'none';
            if (noResultsMsg) noResultsMsg.style.display = 'none';
        }
    };
    
    agregarHandler = function() {
        if (isProcessing) {
            console.log('Ya se está procesando una solicitud...');
            return;
        }
        
        const nombreEstudio = searchInput.value.trim();
        
        if (nombreEstudio.length < 2) {
            alert('Por favor escriba al menos 2 caracteres para el nombre del estudio.');
            return;
        }
        
        if (confirm('¿Desea agregar el estudio "' + nombreEstudio + '"?')) {
            agregarNuevoEstudio(nombreEstudio);
        }
    };
    
    // Agregar eventos
    searchInput.addEventListener('input', searchHandler);
    searchInput.addEventListener('keyup', searchHandler);
    agregarBtn.addEventListener('click', agregarHandler);
    
    console.log('Eventos agregados correctamente');
}

// Función para agregar nuevo estudio
function agregarNuevoEstudio(nombreEstudio) {
    if (isProcessing) {
        console.log('Ya se está procesando una solicitud de agregar...');
        return;
    }
    
    isProcessing = true;
    const agregarBtn = document.getElementById('agregarEstudioBtn');
    const searchInput = document.getElementById('searchEstudios');
    const noResultsMsg = document.getElementById('noResultsMessageEstudios');
    
    // Crear XMLHttpRequest
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ route("examen.agregar") }}', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
    
    // Deshabilitar botón
    agregarBtn.disabled = true;
    agregarBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Agregando...';
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            // Rehabilitar botón
            agregarBtn.disabled = false;
            agregarBtn.innerHTML = '<i class="fa fa-plus"></i> Agregar Estudio';
            isProcessing = false;
            
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        console.log('Estudio agregado correctamente: ' + nombreEstudio);
                        
                        // Limpiar campo de búsqueda
                        searchInput.value = '';
                        agregarBtn.style.display = 'none';
                        if (noResultsMsg) noResultsMsg.style.display = 'none';
                        
                        // Refrescar la lista de estudios dentro del modal SIN reinicializar eventos
                        refrescarEstudiosSinReinit();
                    } else {
                        alert('Error al agregar el estudio: ' + (response.message || 'Error desconocido'));
                    }
                } catch (e) {
                    alert('Error al procesar la respuesta.');
                    console.error('Error parsing response:', e);
                }
            } else {
                alert('Error al agregar el estudio.');
                console.error('HTTP Error:', xhr.status, xhr.responseText);
            }
        }
    };
    
    // Enviar datos
    const data = 'nombre_examen=' + encodeURIComponent(nombreEstudio) + '&tipo_examen=2&_token=' + encodeURIComponent('{{ csrf_token() }}');
    xhr.send(data);
}

// Nueva función para refrescar SIN reinicializar eventos
function refrescarEstudiosSinReinit() {
    const estudiosContainer = document.getElementById('estudiosContainer');
    const consultaInput = document.querySelector('input[name="consulta_id"]');
    
    if (!estudiosContainer || !consultaInput) {
        console.error('Elementos no encontrados para refrescar');
        return;
    }
    
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '{{ route("examen.lista") }}?consulta_id=' + consultaInput.value + '&tipo_examen=2', true);
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            estudiosContainer.innerHTML = xhr.responseText;
            console.log('Lista de estudios actualizada sin reinicializar eventos');
        }
    };
    
    xhr.send();
}

// Función para refrescar estudios (mantener para compatibilidad)
function refrescarEstudios() {
    refrescarEstudiosSinReinit();
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM cargado, inicializando...');
    setTimeout(initEstudioSearch, 500);
});

// También inicializar cuando se abra el modal (si Bootstrap está disponible)
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('addNewOrdenEstudioModal');
    if (modal) {
        modal.addEventListener('shown.bs.modal', function() {
            console.log('Modal abierto, inicializando búsqueda...');
            setTimeout(initEstudioSearch, 100);
        });
        
        modal.addEventListener('hidden.bs.modal', function() {
            const searchInput = document.getElementById('searchEstudios');
            const agregarBtn = document.getElementById('agregarEstudioBtn');
            const noResultsMsg = document.getElementById('noResultsMessageEstudios');
            const checkboxes = document.querySelectorAll('#estudiosContainer .form-check-inline');
            
            if (searchInput) searchInput.value = '';
            if (agregarBtn) agregarBtn.style.display = 'none';
            if (noResultsMsg) noResultsMsg.style.display = 'none';
            
            checkboxes.forEach(function(checkbox) {
                checkbox.style.display = 'block';
            });
            
            // Reset processing flag
            isProcessing = false;
        });
    }
});
</script>