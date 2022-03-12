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
            <h3 class="card-title">Tutores</h3>

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
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Activar</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($docentesI as $docente)
                        <tr>
                            <td>{{ $docente->id }}</td>
                            <td>{{ $docente->nombre }} {{ $docente->apellido }}</td>
                            <td>{{ $docente->dni }}</td>
                            <td>{{ $docente->email }}</td>
                            <td><a href="#" onclick="activar({{ $docente->id }}, 'docente', '/docentesInactivos/activar/', '/docentes')">Activar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        {{ $docentesI->links() }}
    </div>
    @include('footer.footer')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{ asset('js/requests.js') }}"></script>
@stop