@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Actualizar Inventario Materia Prima')

@section('content_header')
    <h1 class="text-center">Inventario Materia Prima</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('inventariomateriaprima.update',$inventmateriap->cod_invent_materia_prima)}}" method='POST'>
        @csrf
        @method('PUT')
        <div class="card  mb-2">
            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre Materia</label>
                <select class="col-sm-7" class="form-control" id="Materia" name="Materia" value="{{$inventmateriap->nom_materia}}">
                    @foreach($materiaprima as $materiap)
                        {
                            <option id=".$materiap['Materia']">{{$materiap["nom_materia"]}}</option>
                        }
                    @endforeach
                </select>
                @if ($errors->has('Materia'))
                    <div     
                        id="Materia-error"                                          
                        class="error text-danger pl-3"
                        for="Materia"
                        style="display: block;">
                        <strong>{{$errors->first('Materia')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="calendar" class="col-sm-2 col-form-label">Fecha Compra</label>
                 <div class="col-sm-7">
                    <input type="date" id="calendario" name="calendario" class="form-control" value="{{$inventmateriap->fec_compra}}">
                </div>
                @if ($errors->has('calendario'))
                    <div     
                        id="calendario-error"                                          
                        class="error text-danger pl-3"
                        for="calendario"
                        style="display: block;">
                        <strong>{{$errors->first('calendario')}}</strong>
                    </div>
                @endif
            </div>


            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Cantidad</label>
                 <div class="col-sm-7">
                    <input type="number" id="cantidad" name="cantidad" min="1" max="99999" maxlength="5" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" placeholder="Ingrese la Cantidad" value="{{$inventmateriap->can_Compra}}">
                </div>
                @if ($errors->has('cantidad'))
                    <div               
                        id="cantidad-error"                               
                        class="error text-danger pl-3"
                        for="cantidad"
                        style="display: block;">
                        <strong>{{$errors->first('cantidad')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Precio Compra</label>
                 <div class="col-sm-7">
                    <input type="number" id="precio" name="precio" min="1" max="999999" maxlength="6" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" placeholder="Ingrese el precio de compra" value="{{$inventmateriap->pre_compra}}">
                </div>
                @if ($errors->has('precio'))
                    <div                 
                        id="precio-error"                             
                        class="error text-danger pl-3"
                        for="precio"
                        style="display: block;">
                        <strong>{{$errors->first('precio')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="calendar" class="col-sm-2 col-form-label">Fecha Caducidad</label>
                 <div class="col-sm-7">
                    <input type="date" id="calendario2" name="calendario2" class="form-control" value="{{$inventmateriap->fec_caducidad}}">
                </div>
                @if ($errors->has('calendario2'))
                    <div     
                        id="calendario2-error"                                          
                        class="error text-danger pl-3"
                        for="calendario2"
                        style="display: block;">
                        <strong>{{$errors->first('calendario2')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('inventariomateriaprima.index')}}"
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

@section('js')
@stop