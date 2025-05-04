<div class="row" style="padding-top: 15px">      
    <div class="form-group col-md-6">
        <label for="">Horario de constancia:</label>
        <input type="text" class="form-control" id="" placeholder="Ejemplo: CSS"  value="{{old('RefiereA')}}" name="RefiereA">
    </div>
    <div class="form-group col-md-6">
        <label for="">Hora de entrada:</label>
        <input type="time" name="hora" />
    </div>

    
</div>

<div class="modal-footer">  
    <input type="hidden" name="txtId" id="txtId" class="form-control form-control-sm" value="{{$consulta->id}}">                                      
    <button type="submit" id="btnCrearModal2"  class="btn btn-primary text-left">Crear</button>
</div>