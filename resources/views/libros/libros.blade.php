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
            <h3 class="card-title">Libros</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 500px;">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Autor</th>
                    <th>Editora</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($libros as $libro)
                        <tr>
                            <td>{{ $libro->id }}</td>
                            <td>{{ $libro->nombre }}</td>
                            <td>{{ $libro->autor }}</td>
                            <td>{{ $libro->editora }}</td>
                            <td><a href="{{ url('/libros/editarLibro', $libro->id) }}"><i class="fas fa-edit"></i></a></td>
                            <td><a href="#" onclick="borrar({{ $libro->id }}, 'libro', '/libros/eliminar/', '/libros')"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        {{ $libros->links() }}
    </div>
    @include('footer.footer')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{ asset('js/requests.js') }}"></script>
@stop