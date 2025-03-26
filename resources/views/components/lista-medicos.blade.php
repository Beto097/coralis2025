<div class="col-lg-6"><label for="">Seleccione una Medico</label>                                                                         

    <select class="form-control" name="selectMedico" id="" required>
        


        @foreach($medicos as $medico)                                                
           
             
            <option value="{{$medico->id}}">{{$medico->nombre_usuario}}</option>
                
           
               

                
               
        
        @endforeach  
        
        
    </select>


</div>