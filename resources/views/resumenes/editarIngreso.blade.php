@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar pago</h1>
@stop

@section('content')

<div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Editar</h3>
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
                    <input type="text" class="form-control" name="id" id="id" aria-describedby="helpId" value="{{ $ingreso->id }}" readonly>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-4">
                <div class="form-group">
                  <label for="">Fecha de pago:</label>
                  <input type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="" value="{{ $ingreso->fecha }}">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                  <label for="">Cuota a pagar:</label>
                  <select class="form-control" name="cuota" id="cuota">
                    <option selected value="{{ $ingreso->cuota }}">{{ $ingreso->cuota }}</option>
                  </select>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
                <div class="form-group">
                  <label for="">Monto</label>
                  <input type="text" class="form-control" name="monto" id="monto" aria-describedby="helpId" placeholder="" value="{{ $ingreso->monto }}">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                  <label for="">tipo</label>
                  <select class="form-control" name="tipo" id="tipo">
                    @if ($ingreso->cuota == 0)
                        <option selected value="0">Ficha</option>  
                    @else
                        <option selected value="1">Cuota</option>
                    @endif
                  </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                  <label for="">Forma de pago</label>
                  <select class="form-control" name="medio" id="medio">
                    @if ($ingreso->medio == 1)
                        <option selected value="1">CONTADO</option>
                    @elseif($ingreso->medio == 2)
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
        <button type="submit" class="btn btn-info" onclick="modificar('ingreso', '/resumen/editar/editarIngreso', '/resumenMensual')">Guardar</button>
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