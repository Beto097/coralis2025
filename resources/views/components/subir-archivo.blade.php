<div class="form-group col-md-6">
    <label for="">Nombre del Archivo</label>
    <input type="text" class="form-control" id="" placeholder="Ejemplo: Crear Usuario"  value="{{old('txtNombre')}}" name="txtNombre" required>
</div>                                                                     
<div class="form-group col-md-6">
    
    <label for="">Archivo</label>
    <input type="file" class="form-control"   accept=".pdf,.doc,.docx,.txt,.jpg,.jpeg,.png" name="archivo" aria-describedby="inputGroupFileAddon04">
            
        
</div>

<div class="modal-footer">  
    <input type="hidden" name="txtId" id="txtId" class="form-control form-control-sm" value="{{$consulta->id}}">                                      
    <button type="submit" id="btnCrearModal2"  class="btn btn-primary text-left">Subir</button>
</div>