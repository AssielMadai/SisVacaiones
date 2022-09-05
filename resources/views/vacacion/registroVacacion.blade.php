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
                            <h3 class="card-title">Registro Vacacion</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                                <div class="callout callout-info">
                                    @foreach($user as $item)
                                        <address>
                                            <strong><i class="far fa-file-alt mr-1"></i> Nombre:</strong> {{$item->nombre}} <br>
                                            Tiene {{$item->aniosTranscurridos}} años en nuestra empresa por lo cual tiene <strong> {{$opcion1}} dias </strong> de vacacion.
                                        </address>
                                    @endforeach
                                </div>
                            <form action="{{route('registrarVacacion',$id)}}" method="POST"enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Fecha Inicio Vacacion:</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="fechaInicio" class="form-control datetimepicker-input"
                                               data-target="#reservationdate"/>
                                        <div class="input-group-append" data-target="#reservationdate"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-md btn-flat">Guardar <i class="fa fa-save"></i>
                                </button>
                            </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
    </section>
@stop
@section('js')
    <script>
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
    </script>
@stop
