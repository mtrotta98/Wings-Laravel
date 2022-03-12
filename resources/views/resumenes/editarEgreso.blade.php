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
    <form method="POST" id="form-modificar">
      {!! csrf_field() !!}
      @method('POST')
      <div class="card-body">
          <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Id</label>
                    <input type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="" value="{{ $gasto->id }}" readonly>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
                <div class="form-group">
                  <label for="">Fecha de pago:</label>
                  <input type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="" value="{{ $gasto->fecha }}">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                  <label for="">Monto</label>
                  <input type="text" class="form-control" name="monto" id="monto" aria-describedby="helpId" placeholder="" value="{{ $gasto->monto }}">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-3">
                <div class="form-group">
                  <label for="">Conceptos(sueldos, otros..)</label>
                  <input type="text" class="form-control" name="concepto" id="concepto" aria-describedby="helpId" placeholder="" value="{{ $gasto->concepto }}">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                  <label for="">Forma de pago</label>
                  <select class="form-control" name="medio" id="medio">
                    @if ($gasto->medio == 1)
                        <option selected value="1">CONTADO</option>
                    @elseif($gasto->medio == 2)
                        <option selected value="2">TRANSFERENCIA</option>
                    @else
                        <option selected value="3">MERCADO PAGO</option>
                    @endif
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
        <button type="submit" class="btn btn-info" onclick="modificar('gasto', '/resumen/editarE/editarEgreso', '/resumenMensual')">Guardar</button>
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
  <script src="{{ asset('js/resumen.js') }}"></script>
@stop