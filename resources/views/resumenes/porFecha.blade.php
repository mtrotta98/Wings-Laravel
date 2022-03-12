@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Resumen por Fecha</h1>
@stop

@section('content')

<div class="row">
  <div class="col-md-4 col-sm-6 col-12">
      <div class="info-box">
      <span class="info-box-icon bg-success"><i class="fas fa-poll"></i></span>

      <div class="info-box-content">
          <span class="info-box-text">Ingresos del mes</span>
          <span class="info-box-number">{{$ingresos}}</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
  </div>

  <div class="col-md-4 col-sm-6 col-12">
      <div class="info-box">
      <span class="info-box-icon bg-danger"><i class="fas fa-poll"></i></span>

      <div class="info-box-content">
          <span class="info-box-text">Egresos del mes</span>
          <span class="info-box-number">{{$egresos}}</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
  </div>

  <div class="col-md-4 col-sm-6 col-12">
      <div class="info-box">
      <span class="info-box-icon bg-warning"><i class="fas fa-poll"></i></span>

      <div class="info-box-content">
          <span class="info-box-text">Resumen</span>
          <span class="info-box-number">{{$total}}</span>
      </div>
      <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
  </div>
</div>

<div class="row">
  <div class="col-md-6">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Cobros</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Fecha</th>
                  <th>Medio</th>
                  <th style="width: 40px">Monto</th>
                  <th>Editar</th>
                  <th>Borrar</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cobros as $cobro)
                <tr>
                    <td>{{ $cobro->id }}</td>
                    <td>{{ $cobro->fecha }}</td>
                    @if ($cobro->medio == 1)
                        <td>Contado</td>
                    @elseif ($cobro->medio == 2)
                        <td>Transferencia</td>
                    @else
                        <td>Mercado Pago</td>
                    @endif
                    <td>{{ $cobro->monto }}</td>
                    <td><a href="{{ url('/resumen/editarPF', $cobro->id) }}"><i class="fas fa-edit"></i></a></td>
                    <td><a href="#" onclick="borrar({{$cobro->id}}, 'ingreso', '/resumen/borrarIngreso/', '/resumenPorFecha/buscar/')"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
              {{ $cobros->links() }}
          </div>
        </div>
  </div>
  <div class="col-md-6">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Gastos</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Concepto</th>
                  <th>Fecha</th>
                  <th style="width: 40px">Monto</th>
                  <th>Editar</th>
                  <th>Borrar</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($gastos as $gasto)
                  <tr>
                    <td>{{ $gasto->id }}</td>
                    <td>{{ $gasto->concepto }}</td>
                    <td>{{ $gasto->fecha }}</td>
                    <td>{{ $gasto->monto }}</td>
                    <td><a href="{{ url('/resumen/editarEPF', $gasto->id) }}"><i class="fas fa-edit"></i></a></td>
                    <td><a href="#" onclick="borrar({{$gasto->id}}, 'egreso', '/resumen/borrarEgreso/', '/resumenPorFecha/buscar/')"><i class="fas fa-trash-alt"></i></a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            {{ $gastos->links() }}
          </div>
        </div>
  </div>
</div>

    @include('footer.footer')    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  <script>

    function borrar(id, tipo, dir, vuelta = ''){
    event.preventDefault();
    var opcion = confirm("¿Seguro desea eliminar al " + tipo + "?");
      if (opcion == true) {
        let fechaD = localStorage.getItem('fechaD');
        let fechaH = localStorage.getItem('fechaH'); 
        const url = baseUrl + dir + id;
        axios.post(url)
          .then(function(response){
            alert(tipo + " eliminado");
            window.location.href = baseUrl + vuelta + fechaD + "/" + fechaH;
          })
          .catch(function(error){
            console.log(error);
          });
        }else {
          window.location.href = baseUrl + vuelta + fechaD + "/" + fechaH;
        }
    }
  </script>
@stop