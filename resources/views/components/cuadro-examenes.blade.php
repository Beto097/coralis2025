<div class="col-row">
@foreach($examenes as $caracteristicas_examen)
    
    <div class="form-check-inline col-md-4 mb-2">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" value="{{$caracteristicas_examen->id}}" name="examenes_id[]">
            <strong>{{$caracteristicas_examen->nombre_examen}}</strong>
        </label>
    </div>
  
@endforeach
</div>
