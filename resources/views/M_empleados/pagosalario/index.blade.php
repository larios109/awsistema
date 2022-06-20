@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('css')
<!-- <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@stop

@section('title', '| Pago Salario')
@section('content_header')
    <h1 class="text-center">Pagos Salario</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')

@can ('crear->pagosalario')
<a 
    href="{{route('pagosalario.create')}}"
    class="btn btn-outline-info text-center btn-block">
    <spam>Crear pago</spam> <i class="fas fa-plus-square"></i>
</a>
@endcan

<div class="table-responsive-sm mt-5">
    <table id="tablapagosalario" class="table table-stripped table-bordered table-condensed table-hover">
        <thead class=thead-dark>
            <tr>
                <th class="text-center">Codigo Pago</th>
                <th class="text-center">Codigo Usuario</th>
                <th class="text-center">Sueldo Bruto</th>
                <th class="text-center">IHSS</th>
                <th class="text-center">RAP</th>
                <th class="text-center">otras deducciones</th>
                <th class="text-center">vacaciones</th>
                <th class="text-center">Descripcion vacaciones</th>
                <th class="text-center">salario</th>
                <th class="text-center">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach($pagosaalario as $pago)
                <tr>
                    <td class="text-center">{{$i}}</td>
                    <td class="text-center">{{$pago["name"]}}</td>
                    <td class="text-center">{{$pago["sueldo_bruto"]}}</td>
                    <td class="text-center">{{$pago["IHSS"]}}</td>
                    <td class="text-center">{{$pago["RAP"]}}</td>
                    <td class="text-center">{{$pago["otras_deducciones"]}}</td>
                    <td class="text-center">{{$pago["vacaciones"]}}</td>
                    <td class="text-center">{{$pago["descripcion_vacaciones"]}}</td>
                    <td class="text-center">{{$pago["salario"]}}</td>
                    <td class="text-center">
                        @can ('editar->pagosalario')
                        <form action="{{route('pagosalario.destroy',$pago["cod_pago"])}}"  method='POST' >
                            <a href="{{route('pagosalario.edit',$pago["cod_pago"])}}" class="btn btn-warning btm-sm fa fa-edit"></a>
                            @can ('borrar->pagosalario')
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
        $('#tablapagosalario').DataTable({
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