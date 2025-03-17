@extends('plantilla.plantilla')
@section('titulo')
    Crear Rol
@endsection



@section('contenido')
<br>
<br>

<!--muestro el error-->
@include('plantilla.errores')
<!-- fin del error-->
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Crear Roles</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            
            <form action="{{route('rol.insert')}}" method="POST" role="form" autocomplete="off">
                @csrf
                
                <x-crear-rol />
                
            </form>
        </div>
    </div>
</div>

@endsection
