@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Agregar Gastos</h1>
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
                  <label for="">Fecha de pago:</label>
                  <input type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                  <label for="">Monto</label>
                  <input type="text" class="form-control" name="monto" id="monto" aria-describedby="helpId" placeholder="">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-3">
                <div class="form-group">
                  <label for="">Conceptos(sueldos, otros..)</label>
                  <input type="text" class="form-control" name="concepto" id="concepto" aria-describedby="helpId" placeholder="">
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
            <div class="col-2" hidden>
                <div class="col-3">
                    <div class="form-group">
                      <label for=""></label>
                      <input type="text" class="form-control" name="activo" id="activo" aria-describedby="helpId" placeholder="" value="1">
                    </div>
                </div>
            </div>
          </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-info" onclick="agregar('gasto', '/gastos/agregar')">Guardar</button>
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