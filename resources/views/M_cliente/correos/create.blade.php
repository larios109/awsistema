@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Crear Correo')

@section('content_header')
    <h1 class="text-center">Correos</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('correos.store')}}" method='POST'>
        @csrf
        <div class="card  mb-2">
            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Correo</label>
                 <div class="col-sm-7">
                    <input type="email" id="Correo" name="Correo" class="form-control" placeholder="Ingrese el correo" value="{{old('Correo')}}">
                </div>
                @if ($errors->has('Correo'))
                    <div               
                        id="Correo-error"                               
                        class="error text-danger pl-3"
                        for="Correo"
                        style="display: block;">
                        <strong>{{$errors->first('Correo')}}</strong>
                    </div>
                @endif
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre Empleado</label>
                <select class="col-sm-7" class="form-control" id="codusuario" name="codusuario" >
                    <option disabled selected>Escoja un empleado</option>
                    @foreach($users as $user)
                        {
                            <option id=".$user['codusuario']">{{$user["name"]}}</option>
                        }
                    @endforeach
                </select>
                @if ($errors->has('codusuario'))
                    <div     
                        id="codusuario-error"                                          
                        class="error text-danger pl-3"
                        for="codusuario"
                        style="display: block;">
                        <strong>{{$errors->first('codusuario')}}</strong>
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

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('correos.index')}}"
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
@stop