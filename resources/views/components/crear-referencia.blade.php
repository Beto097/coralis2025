
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
        <select class="form-control" name="motivoR" id="motivoR">
            <option value="1" selected>Servicio No Ofertado o No disponible</option>
            <option value="2" >Ausencia de Profesional</option>          
            <option value="3" >Falta de Equipo</option> 
            <option value="4" >Falta de Insumo</option> 
            <option value="5" >Caso de Actividades</option>
            <option value="6" >Otro, Cual</option> 
        </select>
    </div>
    <!-- Input oculto al inicio -->
    <div class="form-group col-md-6" id="otroMotivoDiv" style="display: none;">
        <label for="">Otro Motivo: <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="otroMotivoCrear" name="otroMotivo" placeholder="Especifique el motivo">
    </div>
    <div class="form-group col-md-12">
        <label for="">Amammensia: <span class="text-danger">*</span></label>
        <textarea class="form-control" name="txtAmammensia" id="txtAnamnesiaCrear" rows="3" required></textarea>        
    </div>
    <div class="form-group col-md-12">
        <label for="">Examen Fisico: <span class="text-danger">*</span></label>
        <textarea class="form-control" name="txtExamenFisico" id="txtExamenFisicoCrear" rows="3" required></textarea>        
    </div>
    <div class="form-group col-md-12">
        <label for="">Resultado de Examenes:</label>
        <textarea class="form-control" name="txtResultados" id="txtResultadosCrear" rows="3"></textarea>        
    </div>
    <div class="form-group col-md-12">
        <label for="">Diagnostico: <span class="text-danger">*</span></label>
        <textarea class="form-control" name="txtDiagnostico" id="txtDiagnosticoCrear" rows="3" required></textarea>        
    </div>
    <div class="form-group col-md-12">
        <label for="">Tratamiento y Complicaciones: <span class="text-danger">*</span></label>
        <textarea class="form-control" name="txtTratamiento" id="txtTratamientoCrear" rows="3" required></textarea>        
    </div>
    <script>
        document.getElementById('motivoR').addEventListener('change', function() {
            const otroDiv = document.getElementById('otroMotivoDiv');
            if (this.value === '6') {
                otroDiv.style.display = 'block';
            } else {
                otroDiv.style.display = 'none';
            }
        });

        function validarFormularioCrear() {
            const refiereA = document.getElementById('refiereACrear').value.trim();
            const anamnesia = document.getElementById('txtAnamnesiaCrear').value.trim();
            const examenFisico = document.getElementById('txtExamenFisicoCrear').value.trim();
            const diagnostico = document.getElementById('txtDiagnosticoCrear').value.trim();
            const tratamiento = document.getElementById('txtTratamientoCrear').value.trim();
            const motivoR = document.getElementById('motivoR').value;
            
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

        document.getElementById('btnCrearModal2').addEventListener('click', function(e) {
            if (!validarFormularioCrear()) {
                e.preventDefault();
                return false;
            }
        });
    </script>

    
</div>

<div class="modal-footer">  
    <input type="hidden" name="txtId" id="txtId" class="form-control form-control-sm" value="{{$consulta->id}}">                                      
    <button type="submit" id="btnCrearModal2"  class="btn btn-primary text-left">Crear</button>
</div>