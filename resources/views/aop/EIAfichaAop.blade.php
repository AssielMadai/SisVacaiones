@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('barraTareas')
    <li class="breadcrumb-item active"><a href="{{route('evaluacionImpactoAmbiental')}}">AOP</a></li>
    <li class="breadcrumb-item active">Detalle</li>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @foreach($aop as $item)
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{url('images/'.$item->foto)}}"
                                     alt="AOP">
                                @endforeach
                            </div>
                            @foreach($aop as $item)
                                <h3 class="profile-username text-center">{{$item->nombreAop}}</h3>
                                <p class="text-muted text-center">{{$item->sectorNombre}} - {{$item->subsector}}</p>
                            @endforeach
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Acerca de</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @foreach($aop as $itemA)
                                <strong><i class="far fa-file-alt mr-1"></i> NIT / Código Catastral</strong>
                                <p class="text-muted">{{$itemA->nit}} / {{$itemA->codigoCatastral}}</p>
                                <hr>
                                <strong><i class="fas fa-book mr-1"></i>Estado</strong>

                                <p class="text-muted">{{$itemA->estado}}</p>
                                <hr>
                                <strong><i class="fas fa-pencil-alt mr-1"></i>Categoria</strong>

                                <p class="text-muted">
                                    <span class="tag tag-danger">Categoria {{$itemA->categoria}}</span>
                                </p>
                                <hr>
                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Ubicacación</strong>

                                <p class="text-muted">{{$itemA->municipio}} - {{$itemA->provincia}}</p>
                            @endforeach
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link" href="#historial"
                                                        data-toggle="tab">Historial</a></li>
                                <li class="nav-item"><a class="nav-link active" href="#irap"
                                                        data-toggle="tab">IRAP</a></li>
                                <li class="nav-item"><a class="nav-link" href="#detalle"
                                                        data-toggle="tab">Detalle</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="historial">
                                    <!-- Post -->
                                    @foreach($historialIrap as $item)
                                        <div class="post">
                                            <div class="user-block">
                                                 <span class="username">
                                                     <a href="#">{{$item->irap}}</a>
                                                     <a href="#" class="float-right">{{$item->idSec}}</a>
                                                 </span>
                                                <span class="description">{{$item->fechaIngreso}}</span>

                                            </div>
                                            <!-- /.user-block -->
                                            <p>
                                                <b>Estado:    </b> {{$item->estado}}<br>
                                                <b>Cancelado: </b> {{$item->cancelado}}<br>
                                                <b>Archivo:   </b> {{$item->nombreArchivo}}<br>
                                            </p>
                                        </div>
                                @endforeach
                                <!-- /.post -->
                                </div>
                                <!-- /.tab-pane -->
                                <div class="active tab-pane" id="irap">
                                    <!-- The timeline -->
                                    <form class="form-horizontal" action="{{route('registraIrap')}}" method="POST"
                                          enctype="multipart/form-data">
                                        <div class="card-body">
                                            @csrf
                                            @foreach($aop as $item)
                                                <input name="idAop" type="hidden" value="{{$item->idAop}}">
                                            @endforeach

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label"
                                                       for="input-last-name">IRAP</label>
                                                <div class="col-sm-10">
                                                    <select
                                                        class="form-control select2 @error('representante') is-invalid @enderror"
                                                        name="select-Irap" id="select-Irap" style="width: 100%;">
                                                        <option value="">Selecciona un IRAP</option>
                                                        @foreach($irap as $item)
                                                            <option
                                                                value="{{$item->idIrap}}">{{$item->irap}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('representante')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputFile"
                                                       class="col-sm-2 col-form-label">Archivo</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="archivo-Irap"
                                                                   class="custom-file-input"
                                                                   id="exampleInputFile" accept="application/pdf">
                                                            <label class="custom-file-label" for="exampleInputFile">Seleccionar
                                                                Archivo</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fas fa-upload"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label"
                                                       for="input-last-name">Estado</label>
                                                <div class="col-sm-10">
                                                    <select
                                                        class="custom-select form-control-border border-width-2 @error('representante') is-invalid @enderror"
                                                        name="select-EstadoT" id="select-EstadoT" style="width: 100%;">
                                                        <option value="">Selecciona un Estado</option>
                                                        <option value=1>Inicio</option>
                                                        <option value=2>Reinicio</option>
                                                        <option value=3>Reingreso</option>
                                                    </select>
                                                    @error('representante')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-5">
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input @error('activo') is-invalid @enderror"
                                                            type="radio" name="check-Cancelado" id="exampleRadios1"
                                                            value="1">
                                                        <label class="form-check-label" for="exampleRadios2">
                                                            Cancelado
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input @error('activo') is-invalid @enderror"
                                                            type="radio" name="check-Cancelado" id="exampleRadios2"
                                                            value="0">
                                                        <label class="form-check-label" for="exampleRadios2">
                                                            Sin Cancelar
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success btn-md btn-flat">Guardar <i
                                                    class="fa fa-save"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="detalle">

                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputName"
                                                       placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail"
                                                       placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName2"
                                                       placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience"
                                                   class="col-sm-2 col-form-label">Experience</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="inputExperience"
                                                          placeholder="Experience"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputSkills"
                                                       placeholder="Skills">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
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
    </script>
@endsection
