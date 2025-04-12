

<div id="contenedorReceta">
    <div class="row filaReceta" id="filaReceta" style="padding-top: 15px">      
        <div class="form-group col-md-2">
            <label for="">Cantidad</label>
            <input type="text" class="form-control" id="cantidad" placeholder=""   name="txtCantidad[]" required autocomplete="off">
        </div>
        <div class="form-group col-md-3">
            <label for="">Medicamento</label>
            <input type="text" class="form-control" id="medicamento" placeholder=""   name="txtMedicamento[]" required>
        </div>
        <div class="form-group col-md-3">
            <label for="">Dosis</label>
            <input type="text" class="form-control" id="dosis" placeholder=""   name="txtDosis[]" required autocomplete="off">
        </div>
        <div class="form-group col-md-3 ">
            <label for="">Tratamiento</label>
            <input type="text" class="form-control" id="tratamiento" placeholder=""   name="txtTratamiento[]" required autocomplete="off">
        </div>
        <div class="form-group col-md-1 " style="padding-top: 1.5rem ; margin-left: -10px">
            <button type="button" class="btn btn-danger eliminarFila" style="display: none;"></button>
        </div>
        
    </div>

</div>


<div class="row">
    <div class="form-group col-md-11" style="margin-left: -10px">
        
    </div>
    <div class="form-group col-md-1 ">
        <button type="button" id="sumarFila"  class="btn btn-primary text-left" onclick="agregarFila()"><i id="iconoBoton" class="fa fa-plus"></i></button>
       
    </div>
</div>

<div class="modal-footer">      
    <input type="hidden" name="txtIdConsulta" id="txtIdConsulta" class="form-control form-control-sm" value="{{$consulta->id}}">                               


    @if (!isset($tipo))
        <button type="submit" title="Guarda Receta" id="btnCrearModal2" name="accion" value="guardar" class="btn btn-primary text-left">Guardar</button>
    @endif
</div>

