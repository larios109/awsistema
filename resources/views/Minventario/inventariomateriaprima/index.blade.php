@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('css')
<!-- <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@stop

@section('title', '| Inventario Materia Prima')
@section('content_header')
    <h1 class="text-center">Inventario Materia Prima</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')

@can ('crear->inventariomateriaprima')
<a 
    href="{{route('inventariomateriaprima.create')}}"
    class="btn btn-outline-info text-center btn-block">
    <spam>Crear Inventario Materia Prima</spam> <i class="fas fa-plus-square"></i>
</a>
@endcan

<div class="table-responsive-sm mt-5">
    <table id="tablainventmateriaprima" class="table table-stripped table-bordered table-condensed table-hover">
        <thead class=thead-dark>
            <tr>
                <th class="text-center">Codigo Inventario Materia prima</th>
                <th class="text-center">Nombre Materia</th>
                <th class="text-center">Fecha Compra</th>
                <th class="text-center">Cantidad Compra</th>
                <th class="text-center">Precio Compra</th>
                <th class="text-center">Fecha Caducidad</th>
                <th class="text-center">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach($inventariomateriaprima as $invetmateria)
                <tr>
                    <td class="text-center">{{$i}}</td>
                    <td class="text-center">{{$invetmateria["nom_materia"]}}</td>
                    <td class="text-center">{{$invetmateria["fec_compra"]}}</td>
                    <td class="text-center">{{$invetmateria["can_Compra"]}}</td>
                    <td class="text-center">{{$invetmateria["pre_compra"]}}</td>
                    <td class="text-center">{{$invetmateria["fec_caducidad"]}}</td>
                    <td class="text-center">
                        @can ('editar->inventariomateriaprima')
                        <form action="{{route('inventariomateriaprima.destroy',$invetmateria["cod_invent_materia_prima"])}}"  method='POST' >
                            <a href="{{route('inventariomateriaprima.edit',$invetmateria["cod_invent_materia_prima"])}}" class="btn btn-warning btm-sm fa fa-edit"></a>
                            @can ('borrar->inventariomateriaprima')
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
        $('#tablainventmateriaprima').DataTable({
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