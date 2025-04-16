<div id="contenedorReceta">
    @foreach ($consulta->recetas as $filaReceta)
    
        <div class="row filaReceta {{ empty($tipo) ? '' : 'disabled-div' }}" id="filaReceta" style="padding-top: 15px" data-id="{{ $filaReceta->id }}"  >  
            <input type="hidden" name="txtFilaId[]" id="filaId" class="form-control form-control-sm" value="{{ $filaReceta->id }}">     
            <div class="form-group col-md-2">            
                <label for="">Tipo</label> 
                <select class="form-control" name="txtDosis[]" id="txtDosis">               
                                                            
                    
                    <option value="inyectable" @if($filaReceta->dosis =='inyectable') selected @endif>Inyectable</option>
                    <option value="oral" @if($filaReceta->dosis =='oral') selected @endif>Oral</option>  
                    <option value="otro"@if($filaReceta->dosis =='otro') selected @endif>Otro</option> 
            
                </select>
               
            </div>
            <div class="form-group col-md-4">
                <label for="">Medicamento</label>
                <input type="text" class="form-control" id="medicamento" list="medicamentos" autocomplete="off" placeholder=""  value="{{$filaReceta->medicamento}}"  name="txtMedicamento[]" required>
            </div>
            <div class="form-group col-md-2">
                <label for="">Cantidad</label>
                <input type="text" min="1" class="form-control" id="cantidad" placeholder=""  value="{{$filaReceta->cantidad}}"    name="txtCantidad[]" required autocomplete="off">
            </div>
    
            <div class="form-group col-md-3 ">
                <label for="">Tratamiento</label>
                <input type="text" class="form-control" id="tratamiento" placeholder=""   value="{{$filaReceta->tratamiento}}"    name="txtTratamiento[]" required autocomplete="off">
            </div>
            @if (!isset($tipo))
                <div class="form-group col-md-1 " style="padding-top: 1.5rem; margin-left: -10px">
                    <button type="button" class="btn btn-danger eliminarFila"  onclick="eliminarFila2({{ $filaReceta->id }},this)"><i class="fa fa-trash"></i></button>
                </div>
            @endif
            
        </div>


    @endforeach 
    <datalist id="medicamentos">

        @foreach ($medicamentos as $medicamento)
            <option value="{{$medicamento}}">
        @endforeach
        
        

    </datalist>
</div>



<div class="row">
    <div class="form-group col-md-11">
        
    </div>
    @if (!isset($tipo))
        <div class="form-group col-md-1 " style="margin-left: -10px">
        
            <button type="button" id="sumarFila"  class="btn btn-primary text-left" onclick="agregarFila2()"><i id="iconoBoton" class="fa fa-plus"></i></button>
        
        </div>
    @endif
</div>

<div class="modal-footer">      
    <input type="hidden" name="txtIdConsulta" id="txtIdConsulta" class="form-control form-control-sm" value="{{$consulta->id}}"> 
    <input type="hidden" name="txtEliminarId" id="txtEliminarId" class="form-control form-control-sm"> 
    <input type="hidden" name="txtNumero" id="txtNumero" class="form-control form-control-sm" value="{{$filaReceta->numero}}"> 

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


