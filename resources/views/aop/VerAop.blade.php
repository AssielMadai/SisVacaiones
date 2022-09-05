@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-left">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="inputState">Sector</label>
                                        <select name="select-Sector" id="select-Sector"
                                                class="form-control select2 @error('select-Sector') is-invalid @enderror">
                                            <option value="" selected>Selecciona un Sector</option>
                                            @foreach($sectores as $item)
                                                <option value="{{$item->idSector}}" {{old('select-Sector') == $item->idSector ? 'selected' : ''}}>{{$item->nombreSector}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="inputState">Subsector</label>
                                        <select name="select-SubSector" id="select-SubSector"
                                                class="form-control select2 @error('select-SubSector') is-invalid @enderror">
                                            <option value="" selected>Selecciona un SubSector</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <input type="search" class="form-control form-control-md" placeholder="Nombre de AOP" value="">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card card-solid">
                        <div class="card-body pb-0">
                            <div class="row">
                                @foreach($aop as $item)
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                    <div class="card bg-light d-flex flex-fill">
                                        <div class="card-header text-muted border-bottom-0">
                                            <div class="view overlay">
                                            <img src="{{url('images/'.$item->foto)}}" alt="foto-Aop"
                                                 class="align-items-center" style="max-width: 100px; height: 100px">
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="text-muted text-sm text-justify"><br><b>{{$item->nombreAop}} </b></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <p class="text-muted text-sm">
                                                <strong><i class="fas fa-pencil-alt mr-1"></i>Categoria: </strong>
                                                {{$item->categoria}}
                                                <br><strong><i class="far fa-file-alt mr-1"></i> NIT / Código Catastral: </strong><br>
                                                {{$item->nit}} / {{$item->codigoCatastral}}<br>
                                                <strong><i class="fas fa-book mr-1"></i>Estado: </strong>
                                                {{$item->estado}}
                                            </p>
                                            <div class="text-right">
                                                <a href="{{route('mostrarFichaAOP',$item->idAop)}}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-home"></i> Ver AOP
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <nav aria-label="Contacts Page Navigation">
                                <ul class="pagination justify-content-center m-0">
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                                    <li class="page-item"><a class="page-link" href="#">7</a></li>
                                    <li class="page-item"><a class="page-link" href="#">8</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->

                    <!-- /.card -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </section>
@endsection
@section('js')
    <script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            })
        });
        $('#select-Sector').on('change', function (e) {
            var sector_id = $(this).val();
            if (!sector_id)
                $('#select-SubSector').html('<option value="">Seleccione un SubSector</option>');

            $.get('sector/' + sector_id, function (data) {
                var html_select = '<option value="">Seleccione un SubSector</option>';
                for (var i = 0; i < data.length; ++i)
                    html_select += '<option value="' + data[i].idSubSector + '" >' + data[i].nombre + '</option>';
                $('#select-SubSector').html(html_select);
            })
        });
    </script>
@endsection
