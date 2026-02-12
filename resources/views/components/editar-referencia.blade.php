@php
    $referencia = \App\Models\referencia::where('consulta_id', $resultado->id)->first();
    $datos = $referencia ? $referencia->datos : [];
@endphp

<div class="row" style="padding-top: 15px">      
    <div class="form-group col-md-6">
        <label for="">Servicio Medico al que Refiere: <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="refiereAEdit" placeholder="Ejemplo: CSS" value="{{ $datos['RefiereA'] ?? '' }}" name="RefiereA" required>
    </div>
    <div class="form-group col-md-6">
        <label for="">Tipo de Referencia:</label>
        <select class="form-control" name="tipoR" id="tipoREdit">
            <option value="1" {{ ($datos['tipoR'] ?? '1') == '1' ? 'selected' : '' }}>Consulta Externa</option>
            <option value="2" {{ ($datos['tipoR'] ?? '1') == '2' ? 'selected' : '' }}>Urgencia</option>          
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="">Motivo de Referencia:</label>
        <select class="form-control" name="motivoR" id="motivoREdit">
            <option value="1" {{ ($datos['motivoR'] ?? '1') == '1' ? 'selected' : '' }}>Servicio No Ofertado o No disponible</option>
            <option value="2" {{ ($datos['motivoR'] ?? '1') == '2' ? 'selected' : '' }}>Ausencia de Profesional</option>          
            <option value="3" {{ ($datos['motivoR'] ?? '1') == '3' ? 'selected' : '' }}>Falta de Equipo</option> 
            <option value="4" {{ ($datos['motivoR'] ?? '1') == '4' ? 'selected' : '' }}>Falta de Insumo</option> 
            <option value="5" {{ ($datos['motivoR'] ?? '1') == '5' ? 'selected' : '' }}>Caso de Actividades</option>
            <option value="6" {{ ($datos['motivoR'] ?? '1') == '6' ? 'selected' : '' }}>Otro, Cual</option> 
        </select>
    </div>
    <!-- Input oculto al inicio -->
    <div class="form-group col-md-6" id="otroMotivoDivEdit" style="display: {{ ($datos['motivoR'] ?? '1') == '6' ? 'block' : 'none' }};">
        <label for="">Otro Motivo: <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="otroMotivoEdit" name="otroMotivo" placeholder="Especifique el motivo" value="{{ $datos['otroMotivo'] ?? '' }}">
    </div>
    <div class="form-group col-md-12">
        <label for="">Anamnesia: <span class="text-danger">*</span></label>
        <textarea class="form-control" name="txtAmammensia" id="txtAnamnesiaEdit" rows="3" maxlength="865" required>{{ $datos['txtAmammensia'] ?? '' }}</textarea>
        <div id="charCountAnamnesiaEdit" class="text-muted small">0 / 865 caracteres</div>        
    </div>
    
    <!-- Signos Vitales -->
    <div class="form-group col-md-12">
        <label for="">Signos Vitales:</label>
        <div class="row">
            <div class="col-md-2">
                <label for="" class="small">P.A.:</label>
                <input type="text" class="form-control form-control-sm" name="presionArterial" id="presionArterialEdit" placeholder="120/80" value="{{ $datos['presionArterial'] ?? '' }}">
            </div>
            <div class="col-md-2">
                <label for="" class="small">F.C.:</label>
                <input type="text" class="form-control form-control-sm" name="frecuenciaCardiaca" id="frecuenciaCardiacaEdit" placeholder="70" value="{{ $datos['frecuenciaCardiaca'] ?? '' }}">
            </div>
            <div class="col-md-2">
                <label for="" class="small">F.R.:</label>
                <input type="text" class="form-control form-control-sm" name="frecuenciaRespiratoria" id="frecuenciaRespiratoriaEdit" placeholder="16" value="{{ $datos['frecuenciaRespiratoria'] ?? '' }}">
            </div>
            <div class="col-md-1">
                <label for="" class="small">F.C.F.:</label>
                <input type="text" class="form-control form-control-sm" name="frecuenciaCardiacaFetal" id="frecuenciaCardiacaFetalEdit" placeholder="120" value="{{ $datos['frecuenciaCardiacaFetal'] ?? '' }}">
            </div>
            <div class="col-md-1">
                <label for="" class="small">PESO:</label>
                <input type="text" class="form-control form-control-sm" name="peso" id="pesoEdit" placeholder="70" value="{{ $datos['peso'] ?? '' }}">
            </div>
            <div class="col-md-2">
                <label for="" class="small">TEMP:</label>
                <input type="text" class="form-control form-control-sm" name="temperatura" id="temperaturaEdit" placeholder="36.5" value="{{ $datos['temperatura'] ?? '' }}">
            </div>
            <div class="col-md-2">
                <label for="" class="small">TALLA:</label>
                <input type="text" class="form-control form-control-sm" name="talla" id="tallaEdit" placeholder="170" value="{{ $datos['talla'] ?? '' }}">
            </div>
        </div>
    </div>
    <div class="form-group col-md-12">
        <label for="">Examen Fisico: <span class="text-danger">*</span></label>
        <textarea class="form-control" name="txtExamenFisico" id="txtExamenFisicoEdit" rows="3" maxlength="750" required>{{ $datos['txtExamenFisico'] ?? '' }}</textarea>
        <div id="charCountExamenEdit" class="text-muted small">0 / 750 caracteres</div>        
    </div>
    <!--<div class="form-group col-md-12">
        <label for="">Resultado de Examenes:</label>
        <textarea class="form-control" name="txtResultados" id="txtResultadosEdit" rows="3">{{ $datos['txtResultados'] ?? '' }}</textarea>        
    </div>-->
    <div class="form-group col-md-12">
        <label for="">Diagnostico: <span class="text-danger">*</span></label>
        <textarea class="form-control" name="txtDiagnostico" id="txtDiagnosticoEdit" rows="3" maxlength="230" required>{{ $datos['txtDiagnostico'] ?? '' }}</textarea>
        <div id="charCountDiagnosticoEdit" class="text-muted small">0 / 230 caracteres</div>        
    </div>
    <div class="form-group col-md-12">
        <label for="">Tratamiento y Complicaciones: <span class="text-danger">*</span></label>
        <textarea class="form-control" name="txtTratamiento" id="txtTratamientoEdit" rows="3" maxlength="160" required>{{ $datos['txtTratamiento'] ?? '' }}</textarea>
        <div id="charCountTratamientoEdit" class="text-muted small">0 / 160 caracteres</div>        
    </div>

    <script>
        // Función para mostrar/ocultar el campo "Otro motivo"
        function initMotivoReferencia() {
            const motivoSelect = document.getElementById('motivoREdit');
            const otroDiv = document.getElementById('otroMotivoDivEdit');
            
            if (motivoSelect && otroDiv) {
                motivoSelect.addEventListener('change', function() {
                    if (this.value === '6') {
                        otroDiv.style.display = 'block';
                    } else {
                        otroDiv.style.display = 'none';
                    }
                });
            }
        }

        // Función para validar el formulario
        function validarFormularioEditar() {
            const refiereA = document.getElementById('refiereAEdit').value.trim();
            const anamnesia = document.getElementById('txtAnamnesiaEdit').value.trim();
            const examenFisico = document.getElementById('txtExamenFisicoEdit').value.trim();
            const diagnostico = document.getElementById('txtDiagnosticoEdit').value.trim();
            const tratamiento = document.getElementById('txtTratamientoEdit').value.trim();
            const motivoR = document.getElementById('motivoREdit').value;
            
            let errores = [];
            
            if (!refiereA) {
                errores.push('Servicio Médico al que Refiere');
            }
            
            if (!anamnesia) {
                errores.push('Anamnesia');
            }
            
            if (!examenFisico) {
                errores.push('Examen Físico');
            }
            
            if (!diagnostico) {
                errores.push('Diagnóstico');
            }
            
            if (!tratamiento) {
                errores.push('Tratamiento y Complicaciones');
            }
            
            if (motivoR === '6') {
                const otroMotivo = document.getElementById('otroMotivoEdit').value.trim();
                if (!otroMotivo) {
                    errores.push('Otro Motivo (especificación)');
                }
            }
            
            if (errores.length > 0) {
                alert('Los siguientes campos son obligatorios:\n\n• ' + errores.join('\n• '));
                return false;
            }
            
            return true;
        }

        // Función para crear contador de caracteres
        function setupCharacterCounter(textareaId, counterId, maxLength) {
            const textarea = document.getElementById(textareaId);
            const counter = document.getElementById(counterId);
            
            if (!textarea || !counter) {
                console.log('No se encontró:', textareaId, counterId);
                return;
            }
            
            function updateCounter() {
                const currentLength = textarea.value.length;
                counter.textContent = `${currentLength} / ${maxLength} caracteres`;
                
                if (currentLength >= maxLength) {
                    counter.style.color = 'red';
                    counter.textContent = `${currentLength} / ${maxLength} caracteres - Límite alcanzado`;
                } else if (currentLength >= maxLength * 0.9) {
                    counter.style.color = 'orange';
                } else {
                    counter.style.color = '#6c757d';
                }
            }
            
            // Agregar eventos
            textarea.addEventListener('input', updateCounter);
            textarea.addEventListener('keyup', updateCounter);
            textarea.addEventListener('paste', function() {
                setTimeout(updateCounter, 10);
            });
            
            // Inicializar contador
            updateCounter();
        }

        // Función para inicializar todos los contadores
        function initCharacterCounters() {
            setupCharacterCounter('txtAnamnesiaEdit', 'charCountAnamnesiaEdit', 865);
            setupCharacterCounter('txtExamenFisicoEdit', 'charCountExamenEdit', 750);
            setupCharacterCounter('txtDiagnosticoEdit', 'charCountDiagnosticoEdit', 230);
            setupCharacterCounter('txtTratamientoEdit', 'charCountTratamientoEdit', 160);
        }

        // Función para inicializar validación del botón
        function initValidation() {
            const btnEditar = document.getElementById('btnEditarModal');
            if (btnEditar) {
                btnEditar.addEventListener('click', function(e) {
                    if (!validarFormularioEditar()) {
                        e.preventDefault();
                        return false;
                    }
                });
            }
        }

        // Función principal de inicialización
        function initEditarReferenciaForm() {
            initMotivoReferencia();
            initCharacterCounters();
            initValidation();
        }

        // Inicializar cuando el DOM esté listo
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initEditarReferenciaForm);
        } else {
            initEditarReferenciaForm();
        }

        // También inicializar después de un pequeño delay (para modales)
        setTimeout(initEditarReferenciaForm, 300);
    </script>
</div>

<div class="modal-footer">  
    <input type="hidden" name="txtId" id="txtId" class="form-control form-control-sm" value="{{$resultado->id}}">                                      
    <button type="submit" id="btnEditarModal"  class="btn btn-primary text-left">Actualizar</button>
</div>