
<div class="row" style="padding-top: 15px">      
    <div class="form-group col-md-6">
        <label for="">Servicio Medico al que Refiere: <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="refiereACrear" placeholder="Ejemplo: CSS"  value="{{old('RefiereA')}}" name="RefiereA" required>
    </div>
    <div class="form-group col-md-6">
        <label for="">Tipo de Referencia:</label>
        <select class="form-control" name="tipoR" id="tipoRCrear">
            <option value="1" selected>Consulta Externa</option>
            <option value="2" >Urgencia</option>          
        
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="">Motivo de Referencia:</label>
        <select class="form-control" name="motivoR" id="motivoRCrear">
            <option value="1" selected>Servicio No Ofertado o No disponible</option>
            <option value="2" >Ausencia de Profesional</option>          
            <option value="3" >Falta de Equipo</option> 
            <option value="4" >Falta de Insumo</option> 
            <option value="5" >Caso de Actividades</option>
            <option value="6" >Otro, Cual</option> 
        </select>
    </div>
    <!-- Input oculto al inicio -->
    <div class="form-group col-md-6" id="otroMotivoDivCrear" style="display: none;">
        <label for="">Otro Motivo: <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="otroMotivoCrear" name="otroMotivo" placeholder="Especifique el motivo">
    </div>
    <div class="form-group col-md-12">
        <label for="">Anamnesia: <span class="text-danger">*</span></label>
        <textarea class="form-control" name="txtAmammensia" id="txtAnamnesiaCrear" rows="3" maxlength="865" required></textarea>
        <div id="charCountAnamnesiaCrear" class="text-muted small">0 / 865 caracteres</div>        
    </div>
    
    <!-- Signos Vitales -->
    <div class="form-group col-md-12">
        <label for="">Signos Vitales:</label>
        <div class="row">
            <div class="col-md-2">
                <label for="" class="small">P.A.:</label>
                <input type="text" class="form-control form-control-sm" name="presionArterial" id="presionArterialCrear" placeholder="120/80">
            </div>
            <div class="col-md-2">
                <label for="" class="small">F.C.:</label>
                <input type="text" class="form-control form-control-sm" name="frecuenciaCardiaca" id="frecuenciaCardiacaCrear" placeholder="70">
            </div>
            <div class="col-md-2">
                <label for="" class="small">F.R.:</label>
                <input type="text" class="form-control form-control-sm" name="frecuenciaRespiratoria" id="frecuenciaRespiratoriaCrear" placeholder="16">
            </div>
            <div class="col-md-1">
                <label for="" class="small">F.C.F.:</label>
                <input type="text" class="form-control form-control-sm" name="frecuenciaCardiacaFetal" id="frecuenciaCardiacaFetalCrear" placeholder="120">
            </div>
            <div class="col-md-1">
                <label for="" class="small">PESO:</label>
                <input type="text" class="form-control form-control-sm" name="peso" id="pesoCrear" placeholder="70">
            </div>
            <div class="col-md-2">
                <label for="" class="small">TEMP:</label>
                <input type="text" class="form-control form-control-sm" name="temperatura" id="temperaturaCrear" placeholder="36.5">
            </div>
            <div class="col-md-2">
                <label for="" class="small">TALLA:</label>
                <input type="text" class="form-control form-control-sm" name="talla" id="tallaCrear" placeholder="170">
            </div>
        </div>
    </div>
    <div class="form-group col-md-12">
        <label for="">Examen Fisico: <span class="text-danger">*</span></label>
        <textarea class="form-control" name="txtExamenFisico" id="txtExamenFisicoCrear" rows="3" maxlength="750" required></textarea>
        <div id="charCountExamenCrear" class="text-muted small">0 / 750 caracteres</div>        
    </div>
    <!--
    <div class="form-group col-md-12">
        <label for="">Resultado de Examenes:</label>
        <textarea class="form-control" name="txtResultados" id="txtResultadosCrear" rows="3"></textarea>        
    </div>-->
    <div class="form-group col-md-12">
        <label for="">Diagnostico: <span class="text-danger">*</span></label>
        <textarea class="form-control" name="txtDiagnostico" id="txtDiagnosticoCrear" rows="3" maxlength="230" required></textarea>
        <div id="charCountDiagnosticoCrear" class="text-muted small">0 / 230 caracteres</div>        
    </div>
    <div class="form-group col-md-12">
        <label for="">Tratamiento y Complicaciones: <span class="text-danger">*</span></label>
        <textarea class="form-control" name="txtTratamiento" id="txtTratamientoCrear" rows="3" maxlength="160" required></textarea>
        <div id="charCountTratamientoCrear" class="text-muted small">0 / 160 caracteres</div>        
    </div>
    <script>
        // Función para mostrar/ocultar el campo "Otro motivo"
        function initMotivoReferenciaCrear() {
            const motivoSelect = document.getElementById('motivoRCrear');
            const otroDiv = document.getElementById('otroMotivoDivCrear');
            
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
        function validarFormularioCrear() {
            const refiereA = document.getElementById('refiereACrear').value.trim();
            const anamnesia = document.getElementById('txtAnamnesiaCrear').value.trim();
            const examenFisico = document.getElementById('txtExamenFisicoCrear').value.trim();
            const diagnostico = document.getElementById('txtDiagnosticoCrear').value.trim();
            const tratamiento = document.getElementById('txtTratamientoCrear').value.trim();
            const motivoR = document.getElementById('motivoRCrear').value;
            
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
                const otroMotivo = document.getElementById('otroMotivoCrear').value.trim();
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
        function setupCharacterCounterCrear(textareaId, counterId, maxLength) {
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
        function initCharacterCountersCrear() {
            setupCharacterCounterCrear('txtAnamnesiaCrear', 'charCountAnamnesiaCrear', 865);
            setupCharacterCounterCrear('txtExamenFisicoCrear', 'charCountExamenCrear', 750);
            setupCharacterCounterCrear('txtDiagnosticoCrear', 'charCountDiagnosticoCrear', 230);
            setupCharacterCounterCrear('txtTratamientoCrear', 'charCountTratamientoCrear', 160);
        }

        // Función para inicializar validación del botón
        function initValidationCrear() {
            const btnCrear = document.getElementById('btnCrearModal2');
            if (btnCrear) {
                btnCrear.addEventListener('click', function(e) {
                    if (!validarFormularioCrear()) {
                        e.preventDefault();
                        return false;
                    }
                });
            }
        }

        // Función principal de inicialización
        function initCrearReferenciaForm() {
            initMotivoReferenciaCrear();
            initCharacterCountersCrear();
            initValidationCrear();
        }

        // Inicializar cuando el DOM esté listo
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initCrearReferenciaForm);
        } else {
            initCrearReferenciaForm();
        }

        // También inicializar después de un pequeño delay (para modales)
        setTimeout(initCrearReferenciaForm, 300);
    </script>

    
</div>

<div class="modal-footer">  
    <input type="hidden" name="txtId" id="txtId" class="form-control form-control-sm" value="{{$consulta->id}}">                                      
    <button type="submit" id="btnCrearModal2"  class="btn btn-primary text-left">Crear</button>
</div>