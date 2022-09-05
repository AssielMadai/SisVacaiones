@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('barraTareas')
    <li class="breadcrumb-item active">Usuarios</li>
    <li class="breadcrumb-item active">Crear</li>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <form action="{{route('registrarUsuario')}}" method="POST"enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Usuario</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Primer Nombre</label>
                                    <input type="text" name="primerNombre"
                                           class="form-control form-control-border border-width-2 @error('primerNombre') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('primerNombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Segundo Nombre</label>
                                    <input type="text" name="segundoNombre"
                                           class="form-control form-control-border border-width-2 @error('segundoNombre') is-invalid @enderror"
                                           id="inputPassword4">
                                    @error('segundoNombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Apellido Paterno</label>
                                    <input type="text" name="apellidoPaterno"
                                           class="form-control form-control-border border-width-2 @error('apellidoPaterno') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('apellidoPaterno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Apellido Materno</label>
                                    <input type="text" name="apellidoMaterno"
                                           class="form-control form-control-border border-width-2 @error('apellidoMaterno') is-invalid @enderror"
                                           id="inputPassword4">
                                    @error('apellidoMaterno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">CI</label>
                                    <input type="text" name="CI"
                                           class="form-control form-control-border border-width-2 @error('CI') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('CI')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Expedido</label>
                                    <select name="select-Expedido" id="select-Expedido"
                                            class="custom-select select2 form-control-border border-width-2 @error('select-Expedido') is-invalid @enderror">
                                        <option value="" selected>Expedido</option>
                                        <option value="LP">La Paz</option>
                                        <option value="OR">Oruro</option>
                                        <option value="PT">Potosí</option>
                                        <option value="CB">Cochabamba</option>
                                        <option value="TJ">Tarija</option>
                                        <option value="Ch">Chuquisaca</option>
                                        <option value="PD">Pando</option>
                                        <option value="BE">Beni</option>
                                        <option value="SC">Santa Cruz</option>
                                    </select>
                                    @error('select-Expedido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Telefono</label>
                                    <input type="text" name="telefono"
                                           class="form-control form-control-border border-width-2 @error('Telefono') is-invalid @enderror"
                                           id="inputEmail4">
                                    @error('Telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Genero</label>
                                    <select name="select-genero" id="select-genero"
                                            class="custom-select form-control-border border-width-2 @error('select-genero') is-invalid @enderror">
                                        <option value="" selected>Genero</option>
                                        <option value="F">Femenino</option>
                                        <option value="M">Masculino</option>
                                    </select>
                                    @error('select-genero')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" name="activo" type="checkbox" value="1" checked>
                                        <label for="inputEmail4" class="form-check-label">Activo</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" name="activo" type="checkbox" value="0">
                                        <label for="inputEmail4" class="form-check-label">Inactivo</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Fecha Inicio:</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="fechaInicio" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Rol</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"
                                       for="input-last-name">Rol</label>
                                <div class="col-sm-10">
                                    <select
                                        class="custom-select form-control-border border-width-2  @error('rol') is-invalid @enderror"
                                        name="select-rol" id="select-rol" style="width: 100%;">
                                        <option value="">Selecciona un Rol</option>
                                        @foreach($roles as $item)
                                            <option
                                                value="{{$item->nombre}}">{{$item->nombre}}</option>
                                        @endforeach
                                    </select>
                                    @error('rol')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-md btn-flat">Guardar <i class="fa fa-save"></i>
                        </button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script type="text/javascript">
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            })
        });
        $(function () {
            bsCustomFileInput.init();
        });
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
    </script>
@endsection

