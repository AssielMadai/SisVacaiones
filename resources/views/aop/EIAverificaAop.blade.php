@extends('layouts.app')
@section('barraTareas')
    <li class="breadcrumb-item active">EIA</li>
@endsection
@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Actividad, Obra y Proyecto</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th  ></th>
                    <th  >Municipio</th>
                    <th  >Categoria</th>
                    <th >Sector</th>
                    <th >Aop</th>
                    <th  >NIT/Codigo Catastral</th>
                    <th  >Ver</th>
                </tr>
                </thead>
                <tbody>
                @foreach($aops as $aop)
                    <tr>
                        <th scope="row"></th>
                        <td class="budget">{{$aop->munincipio}}</td>
                        <td class="text-center">{{$aop->categoria}}</td>
                        <td class="text-center">{{$aop->nombreSector}}</td>
                        <td class="text-center">{{$aop->nombreAop}}</td>
                        <td class="text-center">{{$aop->nitCodigo}}</td>
                        <td class="text-center"><a href="{{route('mostrarFichaAOP',$aop->id)}}">Ver</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function () {
            $('#example1').DataTable({
                responsive: true,
                autoWidth: false,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por pagina",
                    "zeroRecords": "No se encontro ningún registro"+ `<br/><br/>` +
                        `<button type="button" onclick='ruta();' class="btn btn-lg btn-success">Crear AOP</button>`
                        +"",
                    "info": "Mostrando la pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    'search': 'Buscar: ',
                    'paginate': {
                        'next': 'Siguiente',
                        'previous': 'Anterior'
                    }
                }
            });
        });
        function ruta() {
            {{--window.open('{{URL::action('App\Http\Controllers\AopController@registrarAopVista')}}', '_blank');--}}
                window.location.href = "/registrarAopVista";
        };
    </script>
@stop
