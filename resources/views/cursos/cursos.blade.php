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
            <h3 class="card-title">Cursos</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 500px;">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Dias</th>
                    <th>Horarios</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                    <th>Material del curso</th>
                    <th>Alumnos inscriptos</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($cursos as $curso)
                        <tr>
                            <td>{{ $curso->id }}</td>
                            <td>{{ $curso->nombre }}</td>
                            <td>{{ $curso->dias }}</td>
                            <td>{{ $curso->horarios }}</td>
                            <td><a href="{{ url('/cursos/editar', $curso->id) }}"><i class="fas fa-edit"></i></a></td>
                            <td><a href="#" onclick="borrar({{ $curso->id }}, 'curso', '/cursos/eliminar/', '/cursos')"><i class="fas fa-trash-alt"></i></a></td>
                            <td><a href="{{ url('/cursos/material', $curso->id) }}">Material</a></td>
                            <td><a href="{{ url('/cursos/alumnos', $curso->id) }}">Alumnos</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        {{ $cursos->links() }}
    </div>
    @include('footer.footer')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{ asset('js/requests.js') }}"></script>
@stop