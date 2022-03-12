@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Agregar pago al alumno: {{ $alumno->nombre }} {{ $alumno->apellido }}</h1>
@stop

@section('content')

<div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Agregar</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" id="form-agregarPago">
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
                  <label for="">Fecha de pago:</label>
                  <input type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                  <label for="">Cuota a pagar:</label>
                  <select class="form-control" name="cuota" id="cuota">
                    <option selected>Eligir la cuota</option>
                    @foreach ($cuotasSinPagar as $cuotaS)
                        <option value="{{ $cuotaS->cuota }}">{{ $cuotaS->cuota }}</option>
                    @endforeach
                  </select>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
                <div class="form-group">
                  <label for="">Monto</label>
                  <input type="text" class="form-control" name="monto" id="monto" aria-describedby="helpId" placeholder="">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                  <label for="">tipo</label>
                  <select class="form-control" name="tipo" id="tipo">
                    <option selected>Eligir el tipo</option>
                  </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                  <label for="">Forma de pago</label>
                  <select class="form-control" name="medio" id="medio">
                    <option selected>Eligir el medio</option>
                    @foreach ($mediosP as $medioP)
                        <option value="{{ $medioP->id }}">{{ $medioP->medio }}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-4" hidden>
              <div class="form-group">
                <label for=""></label>
                <input type="text" class="form-control" name="activo" id="activo" aria-describedby="helpId" placeholder="" value="1">
              </div>
          </div>
          </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-info" id="addPago">Guardar</button>
        <a href="{{ url('/historialDePago', $alumno->id) }}" style="padding-left: 87pc">Historial de pagos</a>
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
        document.getElementById('cuota').addEventListener('change', function(){
            if($('#cuota').val() == 0){
                let opciones ="<option selected>Elegir</option>";
                opciones+= '<option value="0">Ficha</option>';
                document.getElementById("tipo").innerHTML = opciones;
            }else{
                let opciones ="<option selected>Elegir</option>";
                opciones+= '<option value="1">Cuota</option>';
                document.getElementById("tipo").innerHTML = opciones;
            }     
        });

        document.getElementById('addPago').addEventListener('click', function(){
            event.preventDefault();
            let formulario = document.querySelector('#form-agregarPago');
            const datos = new FormData(formulario);
            const url = baseUrl + "/agregarPago";
            console.log(url);
            axios.post(url, datos)
                .then(function(response){
                alert("Pago registrado");
                window.location.href = baseUrl;
                })
                .catch(function(error){
                console.log(error);
                });
        });
    </script>
@stop