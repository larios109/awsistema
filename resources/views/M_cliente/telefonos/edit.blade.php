@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Actualizar Telefono')

@section('content_header')
    <h1 class="text-center">Telefono</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
<form action="{{route('telefonos.update', $actualizartelefono->cod_telefono)}}" method='POST'>
        @csrf
        @method('PUT')
        <div class="card  mb-2">
            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Tipo Telefono</label>
                <select class="col-sm-7" class="form-control" id="tipotelefono" name="tipotelefono">
                    <option>Casa</option>
                    <option>Personal</option>
                    <option>Trabajo</option>
                </select>
                @if ($errors->has('tipotelefono'))
                    <div     
                        id="Cliente-error"                                          
                        class="error text-danger pl-3"
                        for="tipotelefono"
                        style="display: block;">
                        <strong>{{$errors->first('tipotelefono')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Telefono</label>
                 <div class="col-sm-7">
                    <input type="number" id="Telefono" name="Telefono" class="form-control" min="1" max="99999999" maxlength="8" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"   placeholder="Ingrese el telefono" value="{{$actualizartelefono->telefono}}">
                </div>
                @if ($errors->has('Telefono'))
                    <div
                        id="Telefono-error"                                              
                        class="error text-danger pl-3"
                        for="Telefono"
                        style="display: block;">
                        <strong>{{$errors->first('Telefono')}}</strong>
                     </div>
                @endif
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre Empleado</label>
                <select class="col-sm-7" class="form-control" id="codusuario" name="codusuario" >
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

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('telefonos.index')}}"
                    class="btn btn-danger w-100"
                    >Cancelar <i class="fa fa-times-circle ml-2"></i></a>
                </div>
                <div class="col-sm-6 col-xs-12 mb-2">
                    <button 
                        type="submit"
                        class="btn btn-success w-100">
                        Actualizar <i class="fa fa-check-circle ml-2"></i>
                    </button>
                </div>
            </div>
        </div>
     </form>
@stop

@section('css')
@stop