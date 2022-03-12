@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Agregar Tutor</h1>
@stop

@section('content')

<div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Agregar</h3>
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
                    <input type="text" class="form-control" name="id" id="id" aria-describedby="helpId" value="{{ $libro->id }}" readonly>
                </div>
            </div>
        </div>
          <div class="row">
              <div class="col-4">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="" value="{{ $libro->nombre }}">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                    <label for="">Autor</label>
                    <input type="text" class="form-control" name="autor" id="autor" aria-describedby="helpId" placeholder="" value="{{ $libro->autor }}">
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                    <label for="">Editora</label>
                    <input type="text" class="form-control" name="editora" id="editora" aria-describedby="helpId" placeholder="" value="{{ $libro->editora }}">
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
        <button type="submit" class="btn btn-info" onclick="modificar('libro', '/libros/editarLibro/editar', '/libros')">Guardar</button>
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