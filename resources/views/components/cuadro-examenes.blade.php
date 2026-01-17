<div class="col-row">

@foreach($examenes as $caracteristicas_examen)
    
    <div class="form-check-inline col-md-4 mb-2">
        <label class="form-check-label">
            <input type="checkbox" 
                   class="form-check-input examen-check" 
                   value="{{$caracteristicas_examen->id}}" 
                   name="examenes_id[]"
                   @if(in_array($caracteristicas_examen->id, $examenesSeleccionados)) checked @endif>
            <strong>{{$caracteristicas_examen->nombre_examen}}</strong>
        </label>
    </div>
  
@endforeach
</div>

<script>
$(document).ready(function() {
    // Usar un namespace específico para evitar conflictos
    $('#ordenForm, #ordenEstudioForm').off('submit.examenes').on('submit.examenes', function(e) {
        const checks = $(this).find('.examen-check:checked');
        const error = $(this).find('#error-examenes');

        if (checks.length === 0) {
            e.preventDefault(); 
            if (error.length) {
                error.removeClass('d-none');
            }
            $(this).find('.examen-check').first().focus();
        } else {
            if (error.length) {
                error.addClass('d-none');
            }
        }
    });
});
</script>