@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Crear Registro')

@section('content_header')
    <h1 class="text-center">Registro Operacion</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('bitacora.store')}}" method='POST'>
        @csrf
        <div class="card  mb-2">
            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Codigo Empleado</label>
                <select class="col-sm-7" class="form-control" id="Empleado" name="Empleado">
                    <option disabled selected>Escoja un empleado</option>
                    @foreach($users as $user)
                        {
                            <option id=".$user['Empleado']">{{$user["name"]}}</option>
                        }
                    @endforeach
                </select>
                @if ($errors->has('Empleado'))
                    <div     
                        id="Empleado-error"                                          
                        class="error text-danger pl-3"
                        for="Empleado"
                        style="display: block;">
                        <strong>{{$errors->first('Empleado')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="calendar" class="col-sm-2 col-form-label">Fecha de Creacion</label>
                 <div class="col-sm-7">
                    <input type="date" id="calendario" name="calendario" class="form-control">
                </div>
                @if ($errors->has('calendario'))
                    <div     
                        id="calendario-error"                                          
                        class="calendario text-danger pl-3"
                        for="calendario"
                        style="display: block;">
                        <strong>{{$errors->first('calendario')}}</strong>
                    </div>
                @endif
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Codigo Operacion</label>
                <select class="col-sm-7" class="form-control" id="Operacion" name="Operacion">
                    <option disabled selected>Escoja un codigo de una operacion</option>
                    @foreach($tipoperacion as $tipo)
                        {
                            <option id=".$tipo['Operacion']">{{$tipo["cod_tipo_operacion"]}}.{{$tipo["nombre_operacion"]}}</option>
                        }
                    @endforeach
                </select>
                @if ($errors->has('Operacion'))
                    <div     
                        id="Operacion-error"                                          
                        class="error text-danger pl-3"
                        for="Operacion"
                        style="display: block;">
                        <strong>{{$errors->first('Operacion')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Referencia Operacion</label>
                 <div class="col-sm-7">
                    <input type="text" id="Referencia" name="Referencia"  class="form-control" maxlength="25" onkeyup="capitalizarPrimeraLetraoperacion()" placeholder="Ingrese la referencia de la operacion" value="{{old('Referencia')}}">
                </div>
                @if ($errors->has('Referencia'))
                    <div                 
                        id="Referencia-error"                             
                        class="error text-danger pl-3"
                        for="Referencia"
                        style="display: block;">
                        <strong>{{$errors->first('Referencia')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('bitacora.index')}}"
                    class="btn btn-danger w-100"
                    >Cancelar <i class="fa fa-times-circle ml-2"></i></a>
                </div>
                <div class="col-sm-6 col-xs-12 mb-2">
                    <button 
                        type="submit"
                        class="btn btn-success w-100">
                        Guardar <i class="fa fa-check-circle ml-2"></i>
                    </button>
                </div>
            </div>
        </div>
     </form>
@stop

@section('css')
@stop

@section('js')
<script>
    var input = document.getElementById('Referencia');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetraoperacion() {
    //almacenamos el valor del input
    var palabra = input.value;
    //Si el valor es nulo o undefined salimos
    if(!input.value) return;
    // almacenamos la mayuscula
    var mayuscula = palabra.substring(0,1).toUpperCase();
    //si la palabra tiene más de una letra almacenamos las minúsculas
    if (palabra.length > 0) {
        var minuscula = palabra.substring(1).toLowerCase();
    }
    //escribimos la palabra con la primera letra mayuscula
    input.value = mayuscula.concat(minuscula);
    }
</script>
@stop