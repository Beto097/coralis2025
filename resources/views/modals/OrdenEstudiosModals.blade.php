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
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form id="ordenEstudioForm" action="@if($consulta->tieneEstudio()) {{ route('estudio.update', $consulta->id) }} @else {{ route('estudio.insert') }} @endif" method="POST" role="form" autocomplete="off">
                                @csrf
                                @if($consulta->tieneEstudio())
                                    @method('PUT')
                                @endif

                                <div id="contenedorEstudio">
                                    <div class="row filaEstudio" id="filaEstudio" style="padding-top: 15px">      
                                        <div class="form-group col-md-3">            
                                            <label for="">Tipo de Estudio</label> 
                                            <div class="tipo-container" style="position: relative;">
                                                <select class="form-control tipoEstudioSelect" name="txtTipoEstudio[]" required>
                                                    <option value="">Seleccione un tipo</option>
                                                    <option value="imagenologia">Imagenología</option>
                                                    <option value="cardiologia">Cardiología</option>
                                                    <option value="neurologia">Neurología</option>
                                                    <option value="endoscopia">Endoscopia</option>
                                                    <option value="biopsia">Biopsia</option>
                                                    <option value="patologia">Patología</option>
                                                    <option value="otro">Otro (escribir)</option> 
                                                </select>
                                                <div class="tipo-custom-display" style="display: none; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: white; border: 1px solid #ccc; border-radius: 4px; padding: 6px 12px; pointer-events: none; z-index: 1;">
                                                </div>
                                            </div>
                                            <input type="text" class="form-control mt-2 tipoOtroInput" placeholder="Especifique el tipo de estudio" style="display:none;">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Estudio</label>
                                            <input type="text" class="form-control" autocomplete="off" placeholder="Ej: Hemograma completo, Radiografía de tórax" name="txtEstudio[]" required maxlength="300">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Informe Clínico</label>
                                            <textarea class="form-control" placeholder="Indique las observaciones clínicas o motivo del estudio" name="txtInformeClinico[]" rows="2" required maxlength="500"></textarea>
                                        </div>
                                        <div class="form-group col-md-1" style="padding-top: 1.5rem; margin-left: -10px">
                                            <button type="button" class="btn btn-danger eliminarFilaEstudio" style="display: none;"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-11" style="margin-left: -10px">
                                        
                                    </div>
                                    <div class="form-group col-md-1 ">
                                        <button type="button" id="sumarFilaEstudio" class="btn btn-primary text-left" onclick="agregarFilaEstudio()"><i id="iconoBotonEstudio" class="fa fa-plus"></i></button>
                                    </div>
                                </div>

                                <div class="modal-footer">      
                                    <input type="hidden" name="consulta_id" value="{{ $consulta->id }}">                               
                                    <button type="submit" title="Guarda Orden de Estudio" id="btnCrearModalEstudio" name="accion" value="guardar" class="btn btn-primary text-left">
                                        @if($consulta->tieneEstudio())
                                            Actualizar Orden
                                        @else
                                            Guardar Orden
                                        @endif
                                    </button>
                                </div>
                            </form>
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
    
    // Agregar event listener a todos los selects de tipo existentes
    document.querySelectorAll('.tipoEstudioSelect').forEach(function(select) {
        select.addEventListener('change', function() {
            handleTipoEstudioChange(this);
        });
    });
    
    // Agregar event listener a todos los inputs de tipo personalizado
    document.querySelectorAll('.tipoOtroInput').forEach(function(input) {
        input.addEventListener('input', function() {
            updateTipoEstudioValue(this);
        });
        input.addEventListener('keyup', function() {
            updateTipoEstudioValue(this);
        });
        input.addEventListener('blur', function() {
            updateTipoEstudioValue(this);
        });
    });
    
    // Para futuras filas que se agreguen dinámicamente
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('tipoEstudioSelect')) {
            handleTipoEstudioChange(e.target);
        }
    });
    
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('tipoOtroInput')) {
            updateTipoEstudioValue(e.target);
        }
    });
    
    document.addEventListener('keyup', function(e) {
        if (e.target.classList.contains('tipoOtroInput')) {
            updateTipoEstudioValue(e.target);
        }
    });
    
    // Asegurar que antes del envío del formulario se actualicen los valores
    const form = document.getElementById('ordenEstudioForm');
    if (form) {
        form.addEventListener('submit', function() {
            document.querySelectorAll('.tipoOtroInput').forEach(function(input) {
                if (input.style.display !== 'none' && input.value.trim() !== '') {
                    updateTipoEstudioValue(input);
                }
            });
        });
    }

    // Función para agregar una nueva fila de estudio (expuesta globalmente)
    function agregarFilaEstudioInternal() {
        const contenedor = document.getElementById('contenedorEstudio');
        const plantilla = contenedor.querySelector('.filaEstudio');
        if (!plantilla) return null;

        const nuevaFila = plantilla.cloneNode(true);

        // Limpiar los valores de la nueva fila
        nuevaFila.querySelectorAll('input, select, textarea').forEach(function(element) {
            if (element.type === 'checkbox' || element.type === 'radio') {
                element.checked = false;
            } else {
                element.value = '';
            }

            if (element.classList && element.classList.contains('tipoOtroInput')) {
                element.style.display = 'none';
                element.required = false;
            }
        });

        // Ocultar display personalizado en la nueva fila
        const customDisplay = nuevaFila.querySelector('.tipo-custom-display');
        if (customDisplay) {
            customDisplay.style.display = 'none';
        }

        // Remover opciones personalizadas del select clonado
        const tipoSelect = nuevaFila.querySelector('.tipoEstudioSelect');
        if (tipoSelect) {
            const customOptions = tipoSelect.querySelectorAll('option[data-custom="true"]');
            customOptions.forEach(option => option.remove());

            // Agregar evento al select clonado
            tipoSelect.addEventListener('change', function() {
                handleTipoEstudioChange(this);
            });
        }

        // Agregar eventos al input tipoOtro clonado
        const tipoOtroInput = nuevaFila.querySelector('.tipoOtroInput');
        if (tipoOtroInput) {
            tipoOtroInput.addEventListener('input', function() { updateTipoEstudioValue(this); });
            tipoOtroInput.addEventListener('keyup', function() { updateTipoEstudioValue(this); });
            tipoOtroInput.addEventListener('blur', function() { updateTipoEstudioValue(this); });
        }

        contenedor.appendChild(nuevaFila);
        actualizarBotonesEliminar();
        return nuevaFila;
    }

    // Exponer función global para el onclick del botón
    window.agregarFilaEstudio = function() { return agregarFilaEstudioInternal(); };
});

// Función para cargar datos existentes cuando se edita
@if($consulta->tieneEstudio())
document.addEventListener('DOMContentLoaded', function() {
    const estudios = @json($consulta->estudios);
    
    if (estudios && estudios.length > 0) {
        // Limpiar el contenedor primero
        const contenedor = document.getElementById('contenedorEstudio');
        const primeraFila = contenedor.querySelector('.filaEstudio');
        
        // Mantener solo la primera fila y limpiar sus valores
        contenedor.innerHTML = '';
        contenedor.appendChild(primeraFila);
        
        // Limpiar la primera fila
        primeraFila.querySelectorAll('input, select, textarea').forEach(function(element) {
            if (element.type === 'checkbox' || element.type === 'radio') {
                element.checked = false;
            } else {
                element.value = '';
            }
        });
        
        // Cargar los estudios existentes
        estudios.forEach(function(estudio, index) {
            let fila;
            if (index === 0) {
                fila = primeraFila;
            } else {
                fila = agregarFilaEstudio();
            }
            
            // Establecer los valores
            const tipoSelect = fila.querySelector('.tipoEstudioSelect');
            const estudioInput = fila.querySelector('input[name="txtEstudio[]"]');
            const informeTextarea = fila.querySelector('textarea[name="txtInformeClinico[]"]');
            
            if (tipoSelect) tipoSelect.value = estudio.tipo;
            if (estudioInput) estudioInput.value = estudio.estudio;
            if (informeTextarea) informeTextarea.value = estudio.informe_clinico;
            
            // Manejar el caso de "otro" si es necesario
            if (tipoSelect && tipoSelect.value === 'otro') {
                const otroInput = fila.querySelector('.tipoOtroInput');
                if (otroInput) {
                    otroInput.style.display = 'block';
                    otroInput.required = true;
                    otroInput.value = estudio.tipo_estudio;
                }
            }
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