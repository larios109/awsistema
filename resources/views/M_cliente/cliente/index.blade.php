@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('css')
<!-- <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@stop

@section('title', '| Clientes')
@section('content_header')
    <h1 class="text-center">Clientes</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')

@can ('crear->cliente')
<a 
    href="{{route('cliente.create')}}"
    class="btn btn-outline-info text-center btn-block">
    <spam>Crear cliente</spam> <i class="fas fa-plus-square"></i>
</a>
@endcan

<div class="table-responsive-sm mt-5">
    <table id="tablacliente" class="table table-stripped table-bordered table-condensed table-hover">
        <thead class=thead-dark>
            <tr>
                <th class="text-center">Codigo Cliente</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Apellido</th>
                <th class="text-center">DNI</th>
                <th class="text-center">Nombre Compañia</th>
                <th class="text-center">RTN Compañia</th>
                <th class="text-center">Fecha Ingreso</th>
                <th class="text-center">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach($clientes as $cliente)
                <tr>
                    <td class="text-center">{{$i}}</td>
                    <td class="text-center">{{$cliente["cliente_nombre"]}}</td>
                    <td class="text-center">{{$cliente["cliente_apellido"]}}</td>
                    <td class="text-center">{{$cliente["cliente_dni"]}}</td>
                    <td class="text-center">{{$cliente["compañia_nombre"]}}</td>
                    <td class="text-center">{{$cliente["compania_rtn"]}}</td>
                    <td class="text-center">{{$cliente["cliente_fecha"]}}</td>
                    <td class="text-center">
                        @can ('editar->cliente')
                        <form action="{{route('cliente.destroy',$cliente["cod_cliente"])}}"  method='POST' >
                            <a href="{{route('cliente.edit',$cliente["cod_cliente"])}}" class="btn btn-warning btm-sm fa fa-edit"></a>
                            @can ('borrar->cliente')
                            <button type="submit" class="btn btn-danger btm-sm fa fa-times-circle">   
                             @csrf
                             @method('DELETE')
                            </button>
                            @endcan
                        </form>
                        @endcan
                    </td>
                </tr>
            @php $i++; @endphp
            @endforeach
        </tbody>
    </table>
</div>

@stop

@section('css')

@stop

@section('js')
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tablacliente').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            // dom: 'Blfrtip',
            dom: '<"pt-2 row" <"col-xl mt-2"l><"col-xl text-center"B><"col-xl text-right mt-2 buscar"f>> <"row"rti<"col"><p>>',
            buttons: [
                {
                    extend: 'pdf',
                    className: 'btn btn-danger glyphicon glyphicon-duplicate',
                   
                }, 
                {
                    extend: 'print',
                    text: 'Imprimir',
                    className: 'btn btn-secondary glyphicon glyphicon-duplicate'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-success glyphicon glyphicon-duplicate'
                }
            ]
        });
    });
</script>
</script>
@stop