@extends('layouts.app')
@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@stop
@section('barraTareas')
    <li class="breadcrumb-item active"><a href="{{route('evaluacionImpactoAmbiental')}}">AOP</a></li>
    <li class="breadcrumb-item active">Registrar</li>
@endsection
@section('content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">REGISTRO</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('registraAopFun')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Representante Legal</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-last-name">CI</label>
                                    <select class="form-control select2 @error('representante') is-invalid @enderror"
                                            name="representante" style="width: 100%;" id="idRepresentante">
                                        <option value="">Seleccione un Representante</option>
                                        @foreach($representante as $item)
                                            <option value="{{$item->id}}">{{$item->ci}}</option>
                                        @endforeach
                                    </select>
                                    @error('representante')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-last-name">Registrar </label>
                                    <button type="button" class="btn btn-info form-control" data-toggle="modal"
                                            data-target="#modal-representante">
                                        Nuevo
                                    </button>
                                </div>
                                <div class="row" id="datosRepresentante"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Actividad, Obra y Proyecto</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Nombre</label>
                                            <input type="text" id="input-nombreAop" name="input-nombreAop"
                                                   class="form-control form-control-border border-width-2 @error('input-nombreAop') is-invalid @enderror"
                                                   placeholder="Actividad, Obra y/o Proyecto"
                                                   value="{{old('input-nombreAop')}}">
                                            @error('input-nombreAop')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label class="form-control-label" for="input-last-name">NIT</label>
                                        <input type="text" id="input-NIT" name="input-NIT"
                                               class="form-control form-control-border border-width-2 @error('input-NIT') is-invalid @enderror"
                                               placeholder="NIT" value="{{old('input-NIT')}}">
                                        @error('input-NIT')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-7">
                                        <label class="form-control-label" for="input-first-name">Código
                                            Catastral</label>
                                        <input type="text" id="input-CodigoCatastral" name="input-CodigoCatastral"
                                               class="form-control form-control-border border-width-2 @error('input-CodigoCatastral') is-invalid @enderror"
                                               placeholder="Codigo de Suelo" value="{{old('input-CodigoCatastral')}}">
                                        @error('input-CodigoCatastral')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-control-label" for="input-last-name">Estado</label>
                                        <select name="select-Estado" id="select-Estado"
                                                class="custom-select form-control-border border-width-2 @error('select-Estado') is-invalid @enderror"
                                                onChange="mostrar(this.value);">
                                            <option value="" selected>Selecciona un Estado</option>
{{--                                            <option value="En Funcionamiento" {{old('select-Estado') == "En Funcionamiento" ? 'selected' : ''}}>En Funcionamiento</option>--}}
{{--                                            <option value="En Proyecto" {{old('select-Estado') == "En Proyecto" ? 'selected' : ''}}>En Proyecto</option>--}}
                                            @foreach($estadoAop as $item)
                                            <option value="{{$item->idEstado}}">{{$item->estado}}</option>
                                            @endforeach
                                        </select>
                                        @error('select-Estado')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label class="form-control-label" for="input-last-name">Categoria</label>
                                        <select name="select-Categoria" id="select-Categoria"
                                                class="custom-select form-control-border border-width-2 @error('select-Categoria') is-invalid @enderror">
                                            <option value="" selected>Selecciona una Categoria</option>
                                            @foreach($categorias as $item)
                                                <option
                                                    value="{{$item->idCategoria}}" {{old('select-Categoria') == $item->idCategoria ? 'selected' : ''}}>{{$item->nombreCategoria}}</option>
                                            @endforeach
                                        </select>
                                        @error('select-Categoria')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-control-label" for="input-last-name">Sector</label>
                                        <select name="select-Sector" id="select-Sector"
                                                class="form-control select2 @error('select-Sector') is-invalid @enderror">
                                            <option value="" selected>Selecciona un Sector</option>
                                            @foreach($sectores as $item)
                                                <option value="{{$item->idSector}}" {{old('select-Sector') == $item->idSector ? 'selected' : ''}}>{{$item->nombreSector}}</option>
                                            @endforeach
                                        </select>
                                        @error('select-Sector')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <label class="form-control-label" for="input-last-name">SubSector</label>
                                        <select name="select-SubSector" id="select-SubSector"
                                                class="form-control select2 @error('select-SubSector') is-invalid @enderror">
                                            <option value="" selected>Selecciona un SubSector</option>
                                        </select>
                                        @error('select-SubSector')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
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
        </div><!-- /.card-body -->
    </div>
    <div class="modal fade" id="modal-representante">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title"><i class="fas fa-user"></i> DATOS</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" method="post" id="formRepre">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="input-username">Primer Nombre</label>
                                <input type="text" id="input-PrimerNombre" name="input-PrimerNombre"
                                       class="form-control form-control-border border-width-2"
                                       placeholder="Primer Nombre">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="input-first-name">Segundo Nombre</label>
                                <input type="text" id="input-SegundoNombre" name="input-SegundoNombre"
                                       class="form-control form-control-border border-width-2"
                                       placeholder="Segundo Nombre">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="input-username">Apellido Paterno</label>
                                <input type="text" id="input-ApellidoPaterno" name="input-ApellidoPaterno"
                                       class="form-control form-control-border border-width-2"
                                       placeholder="Apellido Paterno">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="input-first-name">Apellido Materno</label>
                                <input type="text" id="input-ApellidoMaterno" name="input-ApellidoMaterno"
                                       class="form-control form-control-border border-width-2"
                                       placeholder="Apellido Materno">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="input-username">CI</label>
                                <input type="text" id="input-CI" name="input-CI"
                                       class="form-control form-control-border border-width-2" placeholder="CI">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="input-username">Expedido</label>
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
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger btn-md btn-flat" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="submit" class="btn btn-success btn-md btn-flat">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
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

        // $('#reservationdate').datetimepicker({
        //     format: 'YYYY/MM/DD'
        // });
        // $('#reservation').datetimepicker({
        //     format: 'YYYY/MM/DD'
        // });

        // function mostrar(id) {
        //     if (id == "En Funcionamiento") {
        //         $('#EstadoEnFuncionamiento').show();
        //         $('#EstadoEnProyecto').hide();
        //     }
        //     if (id == "En Proyecto") {
        //         $('#EstadoEnProyecto').show();
        //         $('#EstadoEnFuncionamiento').hide();
        //     }
        // }

        $('#submit').click(function (e) {
            e.preventDefault();
            let primerNombre = $("#input-PrimerNombre").val();
            let segundoNombre = $("#input-SegundoNombre").val();
            let apellidoPaterno = $("#input-ApellidoPaterno").val();
            let apelidoMaterno = $("#input-ApellidoMaterno").val();
            let ci = $("#input-CI").val();
            let expedido= $("#select-Expedido").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                method: 'POST',
                url: '{{route('registrarRepresentante')}}',
                dataType: 'JSON',
                data: {
                    primerNombre: primerNombre,
                    segundoNombre: segundoNombre,
                    apellidoPaterno: apellidoPaterno,
                    apelidoMaterno: apelidoMaterno,
                    ci: ci,
                    expedido:expedido
                },
                success: function (data) {
                    console.log(data);
                    // alert(data.msg);
                    location.reload();
                    $("#modal-representante").modal('hide');
                    // /*LIMPIEZA DEL MODAL*/
                    $("#formRepre")[0].reset();
                }
            });
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

        $('#idRepresentante').on('change', function (event) {
            var idRepresentante = $(this).val();
            $.get('/mostrarRepresentante/' + idRepresentante, function (data) {
                let html = '';
                for (var i = 0; i < data.length; ++i)
                    html += mostrarproducto(data[i].nombres, data[i].apellidos, data[i].ciR, data[i].expedido);
                $('#datosRepresentante').html(html);
            });
        });

        function mostrarproducto(nombres, apellidos, ciR, expedido) {
            let html = `
            <div class="col-12">
                <strong class="text-primary">Datos: </strong><br>
                <b>Apellidos:</b> ${apellidos}<br>
                <b>Nombres:</b> ${nombres}<br>
                <b>CI:</b> ${ciR} ${expedido}<br>
            </div>
            `;
            return html;
        }
    </script>
@endsection
