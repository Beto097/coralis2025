<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="crearConsultaMenorModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">Crear Consulta</h5>
            </div>
            <div class="modal-body">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{route('consulta.menor')}}" method="POST" role="form" autocomplete="off">
                                @csrf
                                
                                <div class="row" style="padding-top: 15px">      
                                    <div class="form-group col-md-6">
                                        <label for="">Nombre del Responsable</label>
                                        <input type="text" class="form-control" id="" placeholder="Ejemplo: Jose Ramos"  value="{{old('txtNombre')}}" name="txtNombre" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Parentesco</label>
                                        <input type="text" class="form-control" id="" placeholder="Ejemplo: Padre" value="{{old('txtParentesco')}}" name="txtParentesco" required>
                                    </div>                                    
                                    

                                    
                                </div>
                                
                                
                                <div class="modal-footer">                                        
                                    <button type="submit" id="btnCrearModal2"  class="btn btn-primary text-left">Crear Consulta</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>