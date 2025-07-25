<div class="form-group col-md-12 col-sm-12 col-xs-12">                                        
    <div class="input-group mb-3">
        <label for="">Seleccione el documento a imprimir</label>                                                                           
        <div class="col-sm-12">
            <select class="form-control" name="selectDocumento" id="selectDocumento" onchange="console.log('Select changed to:', this.value); toggleButtons(this); if(this.value === 'receta') mostrarBotones();">
                
                @if ($consulta->tieneCertificado())
                    <option value="certificado">Certificado</option>
                @endif
                @if ($consulta->tieneConstancia())
                    <option value="constancia">Constancia</option>
                @endif
                @if ($consulta->tieneReferencia())
                    <option value="referencia">Referencia</option>
                @endif
                @if ($consulta->tieneReceta())
                    <option value="receta">Receta</option>
                @endif
                
            </select>
        </div>
    </div>
        
    
</div>
<div class="modal-footer">  
    <input type="hidden" name="txtId" id="txtId" class="form-control form-control-sm" value="{{$consulta->id}}">                                      
    <button type="button" id="btnImprimirViejo" class="btn btn-warning text-left" style="display: @if($consulta->tieneReceta() && !$consulta->tieneCertificado() && !$consulta->tieneConstancia() && !$consulta->tieneReferencia()) inline-block @else none @endif;" onclick="imprimirRecetaOld()">Imprimir Viejo</button>
    <button type="button" id="btnCrearModal2" class="btn btn-primary text-left" onclick="imprimirDocumento()">Imprimir</button>
    <button type="button" id="btnGuardarReceta" class="btn btn-success text-left" style="display: @if($consulta->tieneReceta() && !$consulta->tieneCertificado() && !$consulta->tieneConstancia() && !$consulta->tieneReferencia()) inline-block @else none @endif;" onclick="guardarReceta()">Guardar</button>
    
</div>

<script>
function toggleButtons(selectElement) {
    console.log('toggleButtons called with:', selectElement);
    console.log('Select value:', selectElement ? selectElement.value : 'no element');
    
    // Búsqueda más directa de los botones
    const btnGuardar = document.getElementById('btnGuardarReceta');
    const btnImprimirViejo = document.getElementById('btnImprimirViejo');
    
    console.log('Botón Guardar encontrado:', btnGuardar);
    console.log('Botón Imprimir Viejo encontrado:', btnImprimirViejo);
    
    if (btnGuardar && btnImprimirViejo) {
        if (selectElement && selectElement.value === 'receta') {
            btnGuardar.style.display = 'inline-block';
            btnImprimirViejo.style.display = 'inline-block';
            console.log('✅ Mostrando botones para receta');
        } else {
            btnGuardar.style.display = 'none';
            btnImprimirViejo.style.display = 'none';
            console.log('❌ Ocultando botones');
        }
    } else {
        console.log('❌ No se encontraron todos los botones');
    }
}

// Función simple para mostrar botones (para prueba manual)
function mostrarBotones() {
    const btnGuardar = document.getElementById('btnGuardarReceta');
    const btnImprimirViejo = document.getElementById('btnImprimirViejo');
    
    if (btnGuardar) btnGuardar.style.display = 'inline-block';
    if (btnImprimirViejo) btnImprimirViejo.style.display = 'inline-block';
    
    console.log('Botones mostrados manualmente');
}

function guardarReceta() {
    const selectDocumento = document.getElementById('selectDocumento');
    const consultaId = document.getElementById('txtId').value;
    
    if (!selectDocumento || !consultaId) {
        alert('Error: No se pudo encontrar los datos necesarios.');
        return;
    }
    
    // Verificar que se haya seleccionado receta
    if (selectDocumento.value !== 'receta') {
        alert('Esta función solo está disponible para recetas.');
        return;
    }
    
    console.log('Abriendo PDF simple en nueva ventana...');
    
    // Abrir directamente la URL del PDF simple
    const url = '/receta/print/' + consultaId;
    window.open(url, '_blank');
}

function imprimirDocumento() {
    const selectDocumento = document.getElementById('selectDocumento');
    const consultaId = document.getElementById('txtId').value;
    
    if (!selectDocumento || !consultaId) {
        alert('Error: No se pudo encontrar los datos necesarios.');
        return;
    }
    
    // Verificar que se haya seleccionado algo
    if (!selectDocumento.value) {
        alert('Debe seleccionar un documento para imprimir.');
        return;
    }
    
    console.log('Abriendo PDF en nueva ventana...');
    
    // Determinar la URL según el tipo de documento seleccionado
    let url;
    switch(selectDocumento.value) {
        case 'receta':
            url = '/receta/printCompleto/' + consultaId;
            break;
        case 'certificado':
            url = '/certificado/print/' + consultaId;
            break;
        case 'constancia':
            url = '/constancia/print/' + consultaId;
            break;
        case 'referencia':
            url = '/referencia/print/' + consultaId;
            break;
        default:
            alert('Tipo de documento no válido.');
            return;
    }
    
    // Abrir en nueva ventana
    window.open(url, '_blank');
}

function imprimirRecetaOld() {
    const consultaId = document.getElementById('txtId').value;
    
    if (!consultaId) {
        alert('Error: No se pudo encontrar el ID de la consulta.');
        return;
    }
    
    // Crear la URL directamente para el PDF viejo
    const url = '/receta/printOld/' + consultaId;
    
    // Abrir en nueva ventana
    window.open(url, '_blank');
}

// Debugging - ejecutar cuando carga la página
$(document).ready(function() {
    console.log('Document ready ejecutado');
    
    // Función para verificar y mostrar botones si "receta" está seleccionada
    function checkAndShowButtons() {
        const selectElement = document.getElementById('selectDocumento');
        if (selectElement) {
            console.log('Verificando valor actual del select:', selectElement.value);
            if (selectElement.value === 'receta') {
                console.log('Receta está seleccionada por defecto, mostrando botones...');
                mostrarBotones();
            }
            toggleButtons(selectElement);
        }
    }
    
    // Para el modal estático de la tabla
    $('#imprimirModal').on('shown.bs.modal', function () {
        console.log('Modal estático abierto');
        setTimeout(checkAndShowButtons, 200);
    });
    
    // Para modales dinámicos del header  
    $('[id^="imprimirModal"]').on('shown.bs.modal', function () {
        console.log('Modal dinámico abierto:', $(this).attr('id'));
        setTimeout(checkAndShowButtons, 200);
    });
    
    // Ejecutar también cuando se detecta que el DOM está listo
    setTimeout(function() {
        console.log('=== DEBUGGING INFO ===');
        console.log('Select element:', document.getElementById('selectDocumento'));
        console.log('Btn Guardar:', document.getElementById('btnGuardarReceta'));
        console.log('Btn Imprimir Viejo:', document.getElementById('btnImprimirViejo'));
        console.log('Modal element:', document.getElementById('imprimirModal'));
        
        checkAndShowButtons();
    }, 1000);
});
</script>