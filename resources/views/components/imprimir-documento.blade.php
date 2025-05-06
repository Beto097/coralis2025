<div class="form-group col-md-12 col-sm-12 col-xs-12">                                        
    <div class="input-group mb-3">
        <label for="">Seleccione el documento a imprimir</label>                                                                           
        <div class="col-sm-12">
            <select class="form-control" name="selectDocumento" id="">
                
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
    <button type="submit" id="btnCrearModal2"  class="btn btn-primary text-left">Imprimir</button>
</div>