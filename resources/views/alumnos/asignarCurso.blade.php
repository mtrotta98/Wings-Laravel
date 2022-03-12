@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Asignar curso al alumno: {{ $alumno->nombre }} {{ $alumno->apellido }}</h1>
@stop

@section('content')

<div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Asignar</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" id="form-asignarCurso">
      {!! csrf_field() !!}
      @method('POST')
      <div class="card-body">
          <div class="row">
              <div class="col-4">
                <div class="form-group">
                    <label for="">Id</label>
                    <input type="text" class="form-control" name="id_alumno" id="id_alumno" aria-describedby="helpId" value="{{ $alumno->id }}" readonly>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-4">
                <div class="form-group">
                  <label for="">Elegir curso:</label>
                  <select class="form-control form-control-sm" name="id_curso" id="id_curso">
                    <option selected>Elegir curso</option>
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                  <label for="">Elegir profesor:</label>
                  <select class="form-control form-control-sm" name="id_docente" id="id_docente">
                      <option selected>Elegir docente</option>
                    @foreach ($docentes as $docente)
                        <option value="{{ $docente->id }}">{{ $docente->nombre }} {{ $docente->apellido }}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                  <label for="">Elegir libro:</label>
                  <select class="form-control form-control-sm" name="id_libro" id="id_libro">
                    <option selected>Elegir libro</option>
                    @foreach ($libros as $libro)
                        <option value="{{ $libro->id }}">{{ $libro->nombre }}</option>
                    @endforeach
                  </select>
                </div>
            </div>
          </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-info" id="asign">Guardar</button>
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
    <script>
        document.getElementById('asign').addEventListener('click', function(){
            event.preventDefault();
            let formulario = document.querySelector('#form-asignarCurso');
            const datos = new FormData(formulario);
            const url = baseUrl + "/asignarCurso/asignar";
            console.log(url);
            axios.post(url, datos)
                .then(function(response){
                alert("Alumno asignado");
                window.location.href = baseUrl;
                })
                .catch(function(error){
                console.log(error);
                });
        })
    </script>
@stop