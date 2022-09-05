@extends('layouts.app')
@section('barraTareas')
    <li class="breadcrumb-item active">Usuarios</li>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Usuarios Vacacion</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($recibo as $item)
                                        <tr>
                                            <td>{{$item->nombre}}</td>
                                            <td>{{$item->inicioVacacio}}</td>
                                            <td>{{$item->finVacacion}}</td>
                                        </tr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </section>
@stop
