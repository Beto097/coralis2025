<div id="contenedorReceta">
    @foreach ($consulta->recetas as $filaReceta)
    
        <div class="row filaReceta {{ empty($tipo) ? '' : 'disabled-div' }}" id="filaReceta" style="padding-top: 15px" data-id="{{ $filaReceta->id }}"  >  
            <input type="hidden" name="txtFilaId[]" id="filaId" class="form-control form-control-sm" value="{{ $filaReceta->id }}">     
            <div class="form-group col-md-2">
                <label for="">Cantidad</label>
                <input type="text" class="form-control" id="cantidad" placeholder="" value="{{$filaReceta->cantidad}}"   name="txtCantidad[]" required >
            </div>
            <div class="form-group col-md-3">
                <label for="">Medicamento</label>
                <input type="text" class="form-control" id="medicamento" placeholder="" value="{{$filaReceta->medicamento}}"  name="txtMedicamento[]" required>
            </div>
            <div class="form-group col-md-3">
                <label for="">Dosis</label>
                <input type="text" class="form-control" id="dosis" placeholder=""  value="{{$filaReceta->dosis}}" name="txtDosis[]" required>
            </div>
            <div class="form-group col-md-3 ">
                <label for="">Tratamiento</label>
                <input type="text" class="form-control" id="tratamiento" placeholder="" value="{{$filaReceta->tratamiento}}"  name="txtTratamiento[]" required>
            </div>
            @if (!isset($tipo))
                <div class="form-group col-md-1 " style="padding-top: 1.5rem">
                    <button type="button" class="btn btn-danger eliminarFila"  onclick="eliminarFila2({{ $filaReceta->id }},this)"><i class="fa fa-trash"></i></button>
                </div>
            @endif
            
        </div>


    @endforeach 
</div>



<div class="row">
    <div class="form-group col-md-11">
        
    </div>
    @if (!isset($tipo))
        <div class="form-group col-md-1 ">
        
            <button type="button" id="sumarFila"  class="btn btn-primary text-left" onclick="agregarFila2()"><i id="iconoBoton" class="fa fa-plus"></i></button>
        
        </div>
    @endif
</div>

<div class="modal-footer">      
    <input type="hidden" name="txtIdConsulta" id="txtIdConsulta" class="form-control form-control-sm" value="{{$consulta->id}}"> 
    <input type="hidden" name="txtEliminarId" id="txtEliminarId" class="form-control form-control-sm"> 


    @if (!isset($tipo))
        <button type="submit" title="Guarda Receta" id="btnCrearModal2" name="accion" value="guardar" class="btn btn-primary text-left">Guardar</button>
    @endif


</div>

<style>
    .disabled-div {
        pointer-events: none; /* Evita clics e interacción */
        opacity: 0.9; /* Lo hace visualmente tenue */
    }
    .hidden {
        display: none; /* Oculta el div completamente */
    }
</style>


