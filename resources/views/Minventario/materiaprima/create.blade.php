@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Crear Materia Prima')

@section('content_header')
    <h1 class="text-center">Materia Prima</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('materiaprima.store')}}" method='POST'>
        @csrf
        <div class="card  mb-2">

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre Materia</label>
                 <div class="col-sm-7">
                    <input type="text" id="Nombre" name="Nombre" class="form-control" maxlength="25" onkeydown="return /[a-z, ]/i.test(event.key)" onkeyup="capitalizarPrimeraLetranombre()" placeholder="Ingrese el nombre" value="{{old('Nombre')}}">
                </div>
                @if ($errors->has('Nombre'))
                    <div               
                        id="Nombre-error"                               
                        class="error text-danger pl-3"
                        for="Nombre"
                        style="display: block;">
                        <strong>{{$errors->first('Nombre')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Descripcion</label>
                 <div class="col-sm-7">
                    <input type="text" id="Descripcion" name="Descripcion" class="form-control" maxlength="30" onkeyup="capitalizarPrimeraLetradescripcion()" placeholder="Ingrese la descripcion" value="{{old('Descripcion')}}">
                </div>
                @if ($errors->has('Descripcion'))
                    <div                 
                        id="Descripcion-error"                             
                        class="error text-danger pl-3"
                        for="Descripcion"
                        style="display: block;">
                        <strong>{{$errors->first('Descripcion')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Precio Compra Materia</label>
                 <div class="col-sm-7">
                    <input type="number" id="Precio" name="Precio" min="1" max="99999999" maxlength="8" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" placeholder="Ingrese el Precio" value="{{old('Precio')}}">
                </div>
                @if ($errors->has('Precio'))
                    <div          
                        id="Precio-error"                                     
                        class="error text-danger pl-3"
                        for="Precio"
                        style="display: block;">
                        <strong>{{$errors->first('Precio')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Tipo de Medida</label>
                 <div class="col-sm-7">
                    <input type="text" id="Medida" name="Medida"  class="form-control" maxlength="20" onkeydown="return /[a-z, ]/i.test(event.key)" onkeyup="capitalizarPrimeraLetramedida()" placeholder="Ingrese la medida" value="{{old('Medida')}}">
                </div>
                @if ($errors->has('Medida'))
                    <div
                        id="Medida-error"                                                
                        class="error text-danger pl-3"
                        for="Medida"
                        style="display: block;">
                        <strong>{{$errors->first('Medida')}}</strong>
                    </div>
                 @endif
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('materiaprima.index')}}"
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
    var input = document.getElementById('Nombre');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetranombre() {
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

    var input2 = document.getElementById('Descripcion');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetradescripcion() {
    //almacenamos el valor del input
    var palabra = input2.value;
    //Si el valor es nulo o undefined salimos
    if(!input2.value) return;
    // almacenamos la mayuscula
    var mayuscula = palabra.substring(0,1).toUpperCase();
    //si la palabra tiene más de una letra almacenamos las minúsculas
    if (palabra.length > 0) {
        var minuscula = palabra.substring(1).toLowerCase();
    }
    //escribimos la palabra con la primera letra mayuscula
    input2.value = mayuscula.concat(minuscula);
    }

    var input3 = document.getElementById('Medida');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetramedida() {
    //almacenamos el valor del input
    var palabra = input3.value;
    //Si el valor es nulo o undefined salimos
    if(!input3.value) return;
    // almacenamos la mayuscula
    var mayuscula = palabra.substring(0,1).toUpperCase();
    //si la palabra tiene más de una letra almacenamos las minúsculas
    if (palabra.length > 0) {
        var minuscula = palabra.substring(1).toLowerCase();
    }
    //escribimos la palabra con la primera letra mayuscula
    input3.value = mayuscula.concat(minuscula);
    }
</script>
@stop