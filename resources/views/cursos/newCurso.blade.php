@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Agregar curso</h1>
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
                    <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                    <label for="">Descripcion</label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId">
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-2">
                <div class="form-group">
                  <label for="">Dias</label>
                  <select class="form-control" name="desde" id="desde">
                    <option selected>Elija un dia</option>
                    <option value="Lunes">Lunes</option>
                    <option value="Martes">Martes</option>
                    <option value="Miercoles">Miercoles</option>
                    <option value="Jueves">Jueves</option>
                    <option value="Viernes">Viernes</option>
                  </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="">Dias</label>
                    <select class="form-control" name="hasta" id="hasta">
                        <option selected>Elija un dia</option>
                        <option value="Lunes">Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miercoles">Miercoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                      </select>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label for="">Horario Inicio</label>
                    <input type="time" class="form-control" name="horaInicio" id="horaInicio" aria-describedby="helpId">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="">Horario Fin</label>
                    <input type="time" class="form-control" name="horaFin" id="horaFin" aria-describedby="helpId">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-2" hidden>
                <div class="form-group">
                    <label for=""></label>
                    <input type="text" class="form-control" name="activo" id="activo" aria-describedby="helpId" placeholder="" value=1>
                </div>
            </div>
          </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-info" onclick="agregar('curso', '/nuevoCurso/agregar', '/cursos')">Guardar</button>
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