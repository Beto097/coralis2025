                                                                      
<div class="col-lg-6">
    <label for="">Seleccione un Medico</label> 
    <select class="form-control" name="selectMedico" id="selectMedico">
        
        @foreach($medicos as $medico)                                                
           
            <option value="{{$medico->id}}">{{$medico->nombre_usuario}}</option>
               

           
               
        
        @endforeach       
        
  
    </select>
</div>
