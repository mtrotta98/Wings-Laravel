@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar al tutor: {{ $tutor->nombre }} {{ $tutor->apellido }}</h1>
@stop

@section('content')

<div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Modificar</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" id="form-actualizar">
      {!! csrf_field() !!}
      @method('POST')
      <div class="card-body">
          <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Id</label>
                    <input type="text" class="form-control" name="id" id="id" aria-describedby="helpId" value="{{ $tutor->id }}" readonly>
                </div>
            </div>
          </div>
          <div class="row">
              <div class="col-4">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" value="{{ $tutor->nombre }}">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                    <label for="">Apellido</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" aria-describedby="helpId" value="{{ $tutor->apellido }}">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                    <label for="">Dni</label>
                    <input type="text" class="form-control" name="dni" id="dni" aria-describedby="helpId" value="{{ $tutor->dni }}">
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" value="{{ $tutor->email }}">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                    <label for="">Domicilio</label>
                    <input type="text" class="form-control" name="domicilio" id="domicilio" aria-describedby="helpId" value="{{ $tutor->domicilio }}">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                    <label for="">Telefono</label>
                    <input type="text" class="form-control" name="telefono" id="telefono" aria-describedby="helpId" value="{{ $tutor->telefono }}">
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-4" hidden>
                <div class="form-group">
                    <label for=""></label>
                    <input type="text" class="form-control" name="activo" id="activo" aria-describedby="helpId" placeholder="" value=1>
                </div>
            </div>
          </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-info" onclick="modificar('tutor', '/tutores/editarTutores/actualizar', '/tutores')">Guardar</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->
</div>
    @include('footer.footer')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  <script src="{{ asset('js/requests.js') }}"></script>
@stop