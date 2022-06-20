@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Actualizar producto materia prima')

@section('content_header')
    <h1 class="text-center">Productos Materia Prima</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('productomateriaprima.update',$prodmateriaprima->cod_prod_mat_prima)}}" method='POST'>
        @csrf
        @method('PUT')
        <div class="card  mb-2">
        <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre Producto</label>
                <select class="col-sm-7" class="form-control" id="Producto" name="Producto">
                    @foreach($productos as $prod)
                        {
                            <option id=".$prod['Producto']">{{$prod["nombre_producto"]}}</option>
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

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre Materia</label>
                <select class="col-sm-7" class="form-control" id="Materia" name="Materia">
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
                <label for="colFormLabel" class="col-sm-2 col-form-label">Cantidad Materia Requerida</label>
                 <div class="col-sm-7">
                    <input type="number" id="Cantidad" name="Cantidad" min="1" max="99999999" maxlength="8" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" placeholder="Ingrese la cantidad" value="{{$prodmateriaprima->can_materia_requerida}}">
                </div>
                @if ($errors->has('Cantidad'))
                    <div
                        id="Cantidad-error"                                              
                        class="error text-danger pl-3"
                        for="Cantidad"
                        style="display: block;">
                        <strong>{{$errors->first('Cantidad')}}</strong>
                     </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('productomateriaprima.index')}}"
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