@extends('layouts.app')
@section('barraTareas')
    <li class="breadcrumb-item active">Usuarios</li>
@endsection
@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Usuarios</h3>
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
                    <th  >Nombre Completo</th>
                    <th  >Ci</th>
                    <th >Estado</th>
                    <th >Rol</th>
                    <th  >Acciones</th>
                    <th  >Acciones</th>
                    <th  >Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user as $item)
                    <tr>
                        <th scope="row"></th>
                        <td class="budget">{{$item->nombre}}</td>
                        <td class="text-center">{{$item->ci}}</td>
                        @if($item->estado == 1)
                            <td class="text-center"><span class="badge badge-success">Activo</span></td>
                        @else
                            <td class="text-center"><span class="badge badge-danger">Inactivo</span></td>
                        @endif
                        <td class="text-center">{{$item->rol}}</td>
                        <td><a class="btn btn-info" href="{{route('mostrarEditarRegistro',$item->id)}}">Editar</a></td>
                        <td><a class="btn btn-danger" href="{{route('eliminarUsuario',$item->id)}}" onclick="return confirm('¿Seguro que desea eliminar?')">Eliminar</a></td>
                        <td><a class="btn btn-info" href="{{route('registrarVacacionVista',$item->id)}}">Registrar</a></td>
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
