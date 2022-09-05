@extends('layouts.app')
@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h1 class="card-title">ACTIVIDAD, OBRA Y/O PROYECTO</h1>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($historial as $item)
                    <div class="col-4">
                        <address>
                            <strong>{{$item->nombreAop}}</strong><br>
                            <b>NIT:</b> {{$item->nit}}<br>
                            <b>Estado:</b>{{$item->estado}}<br>
                        </address>
                    </div>
                    <div class="col-4">
                        <br><b>Codigo de suelo:</b> {{$item->codigoCatastral}}<br>
                        <b>Categoria:</b> {{$item->categoria}}<br>
                    </div>
                    <div class="col-4">
                        <br><b>Fecha :</b> {{$item->fecha}}<br>
                        <b>Sector :</b> {{$item->sectorNombre}}<br>
                    </div>
                @endforeach
            </div>
            <div class="card card-secondary">
                <div class="card-header">
                    <h7>Historial</h7>
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
                            <th >Irap</th>
                            <th >Documento</th>
                            <th >Fecha</th>
                            <th >Estado</th>
                            <th >Flujo</th>
                            <th >Dias</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($historial as $item)
                            <tr>
                                <th scope="row">{{$item->irap}}</th>
                                <th scope="row">{{$item->fnca}}</th>
                                <th scope="row">{{$item->fechaIngreso}}</th>
                                <th scope="row">{{$item->estado}}</th>
                                <th scope="row">{{$item->flujo}}</th>
                                <th scope="row">{{$item->dias}}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- /.card-body -->
            </div>
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
                    "zeroRecords": "No se encontro ningún registro",
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
    </script>
@stop
