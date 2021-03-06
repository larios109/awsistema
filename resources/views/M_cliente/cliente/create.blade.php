@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Crear cliente')

@section('content_header')
    <h1 class="text-center">Cliente</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('cliente.store')}}" method='POST'>
        @csrf
        <div class="card  mb-2">
            
        <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre</label>
                 <div class="col-sm-7">
                    <input type="text" id="Nombre" name="Nombre" class="form-control" maxlength="10" onkeydown="return /[a-z, ]/i.test(event.key)"  onkeyup="capitalizarPrimeraLetranombre()" placeholder="Ingrese el nombre" value="{{old('Nombre')}}">
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
                <label for="colFormLabel" class="col-sm-2 col-form-label">Apellido</label>
                 <div class="col-sm-7">
                    <input type="text" id="Apellido" name="Apellido"  class="form-control" maxlength="10" onkeydown="return /[a-z, ]/i.test(event.key)" onkeyup="capitalizarPrimeraLetraapellido()" placeholder="Ingrese el apellido" value="{{old('Apellido')}}">
                </div>
                @if ($errors->has('Apellido'))
                    <div
                        id="Apellido-error"                                                
                        class="error text-danger pl-3"
                        for="Apellido"
                        style="display: block;">
                        <strong>{{$errors->first('Apellido')}}</strong>
                    </div>
                 @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">DNI</label>
                 <div class="col-sm-7">
                    <input type="number" id="DNI" name="DNI"  class="form-control" min="1" max="9999999999999" maxlength="13" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"   placeholder="Ingrese el dni" value="{{old('DNI')}}">
                </div>
                @if ($errors->has('DNI'))
                    <div                 
                        id="DNI-error"                             
                        class="error text-danger pl-3"
                        for="DNI"
                        style="display: block;">
                        <strong>{{$errors->first('DNI')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre Compa??ia</label>
                 <div class="col-sm-7">
                    <input type="text" id="Compania" name="Compania" class="form-control" maxlength="20" onkeydown="return /[a-z, ]/i.test(event.key)" onkeyup="capitalizarPrimeraLetracompania()" placeholder="Ingrese la compa??ia" value="{{old('Compania')}}">
                </div>
                @if ($errors->has('Compania'))
                    <div
                        id="Compania-error"                                              
                        class="error text-danger pl-3"
                        for="Compania"
                        style="display: block;">
                        <strong>{{$errors->first('Compania')}}</strong>
                     </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">RTN Compa??ia</label>
                 <div class="col-sm-7">
                    <input type="number" id="RTN" name="RTN" class="form-control" min="1" max="99999999999999" maxlength="14" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Ingrese el rtn" value="{{old('RTN')}}">
                </div>
                @if ($errors->has('RTN'))
                    <div
                        id="RTN-error"                                              
                        class="error text-danger pl-3"
                        for="RTN"
                        style="display: block;">
                        <strong>{{$errors->first('RTN')}}</strong>
                     </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="calendar" class="col-sm-2 col-form-label">Fecha Ingreso</label>
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

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('cliente.index')}}"
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
    //funci??n que capitaliza la primera letra
    function capitalizarPrimeraLetranombre() {
    //almacenamos el valor del input
    var palabra = input.value;
    //Si el valor es nulo o undefined salimos
    if(!input.value) return;
    // almacenamos la mayuscula
    var mayuscula = palabra.substring(0,1).toUpperCase();
    //si la palabra tiene m??s de una letra almacenamos las min??sculas
    if (palabra.length > 0) {
        var minuscula = palabra.substring(1).toLowerCase();
    }
    //escribimos la palabra con la primera letra mayuscula
    input.value = mayuscula.concat(minuscula);
    }

    var input2 = document.getElementById('Apellido');
    //funci??n que capitaliza la primera letra
    function capitalizarPrimeraLetraapellido() {
    //almacenamos el valor del input
    var palabra = input2.value;
    //Si el valor es nulo o undefined salimos
    if(!input2.value) return;
    // almacenamos la mayuscula
    var mayuscula = palabra.substring(0,1).toUpperCase();
    //si la palabra tiene m??s de una letra almacenamos las min??sculas
    if (palabra.length > 0) {
        var minuscula = palabra.substring(1).toLowerCase();
    }
    //escribimos la palabra con la primera letra mayuscula
    input2.value = mayuscula.concat(minuscula);
    }

    var input3 = document.getElementById('Compania');
    //funci??n que capitaliza la primera letra
    function capitalizarPrimeraLetracompania() {
    //almacenamos el valor del input
    var palabra = input3.value;
    //Si el valor es nulo o undefined salimos
    if(!input3.value) return;
    // almacenamos la mayuscula
    var mayuscula = palabra.substring(0,1).toUpperCase();
    //si la palabra tiene m??s de una letra almacenamos las min??sculas
    if (palabra.length > 0) {
        var minuscula = palabra.substring(1).toLowerCase();
    }
    //escribimos la palabra con la primera letra mayuscula
    input3.value = mayuscula.concat(minuscula);
    }
</script>
@stop