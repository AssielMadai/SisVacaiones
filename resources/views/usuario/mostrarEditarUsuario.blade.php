@extends('layouts.app')
@section('barraTareas')
    <li class="breadcrumb-item active">EIA</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header"> Registrar Usuario</div>
        <div class="card-body">
            <form action="{{route('editarUsuario',$user->id)}}" method="POST"enctype="multipart/form-data">
                @method('PUT')
                @csrf
                {{--                        {{csrf_field()}}--}}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Primer Nombre</label>
                        <input type="text" value="{{$user->primerNombre}}" name="primerNombre" class="form-control @error('primerNombre') is-invalid @enderror" id="inputEmail4">
                        @error('primerNombre')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Segundo Nombre</label>
                        <input type="text" value="{{$user->segundoNombre}}" name="segundoNombre" class="form-control @error('segundoNombre') is-invalid @enderror " id="inputPassword4">
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
                        <input type="text" class="form-control  @error('apellidoPaterno') is-invalid @enderror" value="{{$user->apellidoPaterno}}" name="apellidoPaterno" id="inputEmail4">
                        @error('apellidoPaterno')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Apellido Materno</label>
                        <input type="text" class="form-control @error('apellidoMaterno') is-invalid @enderror" value="{{$user->apellidoMaterno}}" name="apellidoMaterno" id="inputPassword4">
                        @error('apellidoMaterno')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputCity">CI</label>
                        <input type="text" value="{{$user->ciUsuario}}" name="ci" class="form-control @error('ci') is-invalid @enderror" id="inputCity">
                        @error('ci')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputCity">Fecha de Nacimiento</label>
                        <input type="date" value="{{$user->fechaNacimiento}}" name="fechaNacimiento" class="form-control @error('fechaNacimiento') is-invalid @enderror" id="inputCity">
                        @error('fechaNacimiento')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputZip">Telefono</label>
                        <input type="number" value="{{$user->telefono}}" name="telefono" class="form-control @error('telefono') is-invalid @enderror" id="inputZip">
                        @error('telefono')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputState">Rol</label>
                        <select id="inputState" class="form-control" name="idRol">
                            @foreach($findRole as $role)
                                <option type="text">{{$role->name}}</option>
                            @endforeach
                            @foreach($roles as $item)
                                <option value="{{$item->name}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">Genero: @if($user->genero=='F') Femenino @else Masculino @endif</label>
                        <div class="form-check">
                            <input class="form-check-input  @error('genero') is-invalid @enderror" type="radio" name="genero" id="exampleRadios1" value="F" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Femenino
                            </label>
                            @error('genero')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-check">
                            <input class="form-check-input  @error('genero') is-invalid @enderror" type="radio" name="genero" id="exampleRadios2" value="M">
                            <label class="form-check-label" for="exampleRadios2">
                                Masculino
                            </label>
                            @error('genero')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputZip">Activo:  @if($user->activo) Si @else No @endif</label>
                        <div class="form-check">
                            <input class="form-check-input  @error('activo') is-invalid @enderror" type="radio" name="activo" id="exampleRadios1" value="1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Activo
                            </label>
                            @error('activo')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-check">
                            <input class="form-check-input  @error('activo') is-invalid @enderror" type="radio" name="activo" id="exampleRadios2" value="0">
                            <label class="form-check-label" for="exampleRadios2">
                                Inactivo
                            </label>
                            @error('activo')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>

@stop
@section('js')
@stop
