@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Agregar Docente</h1>
@stop

@section('content')

<div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Agregar</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" id="form-agregar">
      {!! csrf_field() !!}
      @method('POST')
      <div class="card-body">
          <div class="row">
              <div class="col-4">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                    <label for="">Apellido</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" aria-describedby="helpId" placeholder="">
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Dni</label>
                    <input type="text" class="form-control" name="dni" id="dni" aria-describedby="helpId" placeholder="">
                </div>
              </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="">
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
        <button type="submit" class="btn btn-info" onclick="agregar('docente', '/agregarDocente/agregar', '/docentes')">Guardar</button>
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