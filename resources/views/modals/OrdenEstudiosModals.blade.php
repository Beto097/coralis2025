<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="addNewOrdenEstudioModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl" style="max-width: 90%; width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">
                    @if($consulta->tieneEstudio())
                        Editar Orden de estudios
                    @else
                        Crear Orden de estudios
                    @endif
                </h5>
            </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Función para manejar el cambio en el select de tipo de estudio
    function handleTipoEstudioChange(selectElement) {
        const container = selectElement.closest('.tipo-container') || selectElement.parentElement;
        const filaEstudio = selectElement.closest('.filaEstudio');
        const tipoOtroInput = filaEstudio.querySelector('.tipoOtroInput');
        const customDisplay = container.querySelector('.tipo-custom-display');
        
        if (selectElement.value === 'otro') {
            // Mostrar el campo "Otro"
            tipoOtroInput.style.display = 'block';
            tipoOtroInput.required = true;
        } else {
            // Ocultar el campo "Otro" y el display personalizado
            tipoOtroInput.style.display = 'none';
            tipoOtroInput.value = ''; // Limpiar el campo
            tipoOtroInput.required = false;
            
            if (customDisplay) {
                customDisplay.style.display = 'none';
            }
        }
    }
    
    // Función para actualizar el valor del select con el texto personalizado
    function updateTipoEstudioValue(input) {
        const filaEstudio = input.closest('.filaEstudio');
        const tipoSelect = filaEstudio.querySelector('.tipoEstudioSelect');
        const container = tipoSelect.closest('.tipo-container') || tipoSelect.parentElement;
        const customDisplay = container.querySelector('.tipo-custom-display');
        
        // Solo proceder si el select está en modo "otro"
        if (tipoSelect.value === 'otro' || tipoSelect.querySelector('option[data-custom="true"]:checked')) {
            if (input.value.trim() !== '') {
                // Crear o actualizar una opción hidden con el valor personalizado
                let customOption = tipoSelect.querySelector('option[data-custom="true"]');
                if (!customOption) {
                    customOption = document.createElement('option');
                    customOption.setAttribute('data-custom', 'true');
                    tipoSelect.appendChild(customOption);
                }
                
                // Asignar el valor personalizado y seleccionarlo
                customOption.value = input.value.trim();
                customOption.textContent = input.value.trim();
                customOption.selected = true;
                
                // Deseleccionar la opción "otro"
                const otroOption = tipoSelect.querySelector('option[value="otro"]');
                if (otroOption) {
                    otroOption.selected = false;
                }
                
                // Mostrar el texto personalizado sobre el select
                if (customDisplay) {
                    customDisplay.textContent = input.value.trim();
                    customDisplay.style.display = 'block';
                }
            } else {
                // Si el campo está vacío, volver a seleccionar "otro"
                const otroOption = tipoSelect.querySelector('option[value="otro"]');
                if (otroOption) {
                    otroOption.selected = true;
                }
                
                // Ocultar el display personalizado
                if (customDisplay) {
                    customDisplay.style.display = 'none';
                }
                
                // Remover la opción personalizada si existe
                const customOption = tipoSelect.querySelector('option[data-custom="true"]');
                if (customOption) {
                    customOption.remove();
                }
            }
        }
    }
    
    // Inicializar estados al cargar la página
    document.querySelectorAll('.filaEstudio').forEach(function(fila) {
        const tipoSelect = fila.querySelector('.tipoEstudioSelect');
        const tipoOtroInput = fila.querySelector('.tipoOtroInput');
        
        if (tipoSelect && tipoOtroInput) {
            // Si el input tiene valor y está visible, actualizar el select
            if (tipoOtroInput.style.display === 'block' && tipoOtroInput.value.trim() !== '') {
                updateTipoEstudioValue(tipoOtroInput);
            }
        }
    });
    
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
@endif
 
// Función para actualizar la visibilidad de los botones eliminar
function actualizarBotonesEliminar() {
    const filas = document.querySelectorAll('.filaEstudio');
    filas.forEach(function(fila, index) {
        const btnEliminar = fila.querySelector('.eliminarFilaEstudio');
        if (btnEliminar) {
            btnEliminar.style.display = filas.length > 1 ? 'block' : 'none';
        }
    });
}

// Event listener para botones eliminar
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('eliminarFilaEstudio') || e.target.closest('.eliminarFilaEstudio')) {
        const fila = e.target.closest('.filaEstudio');
        if (fila && document.querySelectorAll('.filaEstudio').length > 1) {
            fila.remove();
            actualizarBotonesEliminar();
        }
    }
});

// Inicializar botones al cargar
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(actualizarBotonesEliminar, 100);
});
</script>

<style>
/* Mejorar la visualización de selects con texto largo */
.tipoEstudioSelect {
    width: 100% !important;
    min-width: 120px;
    overflow: visible;
}

.tipoEstudioSelect option {
    white-space: nowrap;
    overflow: visible;
    text-overflow: clip;
    padding: 5px;
}

/* Ajustar el ancho específicamente del campo tipo */
.form-group:has(.tipoEstudioSelect) {
    min-width: 180px;
}

/* Estilos para las filas de estudios */
.filaEstudio {
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
    margin-bottom: 15px;
}

.filaEstudio:last-child {
    border-bottom: none;
}

/* Mejorar el área de texto */
.form-group textarea {
    resize: vertical;
    min-height: 60px;
}

/* Botón eliminar */
.eliminarFilaEstudio {
    margin-top: 8px;
}
</style>