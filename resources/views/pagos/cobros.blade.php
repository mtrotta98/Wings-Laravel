@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Cobros</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                    </button>
                </div>
                </div>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 500px;">
            <table class="table table-head-fixed text-nowrap">
                <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Apellido Y Nombre</th>
                    <th>Dni</th>
                    <th>Monto</th>
                    <th>Cuota</th>
                    <th>Medio Pago</th>
                    <th>Fecha de pago</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($pagos as $pago)
                        <tr>
                            <td>{{ $pago->id }}</td>
                            <td>{{ $pago->nombre }} {{ $pago->apellido }}</td>
                            <td>{{ $pago->dni }}</td>
                            <td>{{ $pago->monto }}</td>
                            <td>{{ $pago->cuota }}</td>
                            @if ($pago->medio == 1)
                                <td>Contado</td>
                            @elseif ($pago->medio == 2)
                                <td>Transferencia</td>
                            @else
                                <td>Mercado Pago</td>
                            @endif
                            <td>{{ $pago->fecha }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        {{ $pagos->links() }}
    </div>
    @include('footer.footer')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        
    </script>
@stop