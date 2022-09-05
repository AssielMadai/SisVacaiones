@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
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
                @foreach($aop as $item)
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
                    <h7>Instrumento de Regulacion de Alcance Particular</h7>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('registraIrap')}}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            @foreach($aop as $item)
                                <input name="idAop" type="hidden" value="{{$item->idAop}}">
                            @endforeach
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-last-name">IRAP</label>
                                        <select class="form-control select2 @error('representante') is-invalid @enderror"
                                                name="select-Irap" id="select-Irap" style="width: 100%;">
                                            <option value="">Selecciona un IRAP</option>
                                            @foreach($irapC as $item)
                                                <option value="{{$item->idIrap}}">{{$item->irap}}</option>
                                            @endforeach
                                        </select>
                                        @error('representante')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Archivo</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="archivo-Irap" class="custom-file-input"
                                                       id="exampleInputFile" accept="application/pdf">
                                                <label class="custom-file-label" for="exampleInputFile">Seleccionar Archivo</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-upload"></i></span>
                                            </div>
                                        </div>
                                    </div>
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
            <!-- /.card-body -->
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script type="text/javascript">
        $(function () {
            $('.select2').select2({
                theme: 'bootstrap4'
            })
        });
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection



