@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Crear Producto en Inventario')

@section('content_header')
    <h1 class="text-center">Productos en Inventario</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('productosinventario.store')}}" method='POST'>
        @csrf
        <div class="card  mb-2">
            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Producto</label>
                <select class="col-sm-7" class="form-control" id="Producto" name="Producto">
                    <option disabled selected>Escoja un Producto</option>
                    @foreach($productos as $producto)
                        {
                            <option  id=".$producto['Producto']">{{$producto["nombre_producto"]}}</option>
                        }
                    @endforeach
                </select>
                @if ($errors->has('Producto'))
                    <div     
                        id="Producto-error"                                          
                        class="error text-danger pl-3"
                        for="Producto"
                        style="display: block;">
                        <strong>{{$errors->first('Producto')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="calendar" class="col-sm-2 col-form-label">Fecha de Creacion Lote</label>
                 <div class="col-sm-7">
                    <input type="date" id="calendario1" name="calendario1" class="form-control">
                </div>
                @if ($errors->has('calendario1'))
                    <div     
                        id="calendario1-error"                                          
                        class="calendario1 text-danger pl-3"
                        for="calendario1"
                        style="display: block;">
                        <strong>{{$errors->first('calendario1')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="calendar" class="col-sm-2 col-form-label">Fecha de Caducidad Lote</label>
                 <div class="col-sm-7">
                    <input type="date" id="calendario2" name="calendario2" class="form-control">
                </div>
                @if ($errors->has('calendario2'))
                    <div     
                        id="calendario2-error"                                          
                        class="calendario2 text-danger pl-3"
                        for="calendario2"
                        style="display: block;">
                        <strong>{{$errors->first('calendario2')}}</strong>
                    </div>
                @endif
            </div>


            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Cantidad</label>
                 <div class="col-sm-7">
                    <input type="number" id="cantidad" name="cantidad"  class="form-control" min="1" max="9999999999" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Ingrese la Cantidad" value="{{old('cantidad')}}">
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
                <label for="colFormLabel" class="col-sm-2 col-form-label">Precio de Venta</label>
                 <div class="col-sm-7">
                    <input type="number" id="precio" name="precio"  class="form-control" min="1" max="9999999999" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Ingrese el precio de venta" value="{{old('precio')}}">
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

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('productosinventario.index')}}"
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