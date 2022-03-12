@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
@stop

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="listados" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Listados</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <form method="POST" id="form-listados">
                        @method('POST')
                        {!! csrf_field() !!}
                        <div class="container-fluid">
                            <div class="form-group">
                              <label for="">Que desea listar</label>
                              <select class="form-control" name="listT" id="listT">
                                <option selected>Elija una opcion</option>
                                <option value="1">Alumnos activos/inactivos</option>
                                <option value="2">Alumnos por curso</option>
                                <option value="3">Pagos</option>
                              </select>
                            </div>
                        </div>
                        <div class="container-fluid" id="esc" hidden>
                            <div class="form-group">
                              <label for="">Seleccione una opcion</label>
                              <select class="form-control" name="als" id="als">
                                <option selected>Elija una opcion</option>
                                <option value="1">Activos</option>
                                <option value="2">Inactivos</option>
                              </select>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="form-group" id="fecha1" hidden>
                                <label for="">Elija las fechas</label>
                                <input type="date" class="form-control" name="fechaD" id="fechaD" aria-describedby="helpId" placeholder="">
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="form-group" id="fecha2" hidden>
                                <label for=""></label>
                                <input type="date" class="form-control" name="fechaH" id="fechaH" aria-describedby="helpId" placeholder="">
                            </div>
                        </div>
                        <div class="container-fluid" id="cur" hidden>
                            <div class="form-group">
                              <label for="">Seleccione un curso</label>
                              <select class="form-control" name="curso" id="curso">
                                <option selected>Elija un curso</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" id="cerrar">Cerrar</a>
                    <a href="#" onclick="redirect()">Buscar</a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> 
        document.addEventListener('DOMContentLoaded', function(){
            $('#listados').modal('show');
        })

        document.getElementById('cerrar').addEventListener('click', function(){
            window.location.href = baseUrl;
        })

        document.getElementById('listT').addEventListener('change', function(){
            if($('#listT').val() == 1){
                document.getElementById("esc").removeAttribute('hidden');
                document.getElementById("fecha1").setAttribute('hidden', 'true');
                document.getElementById("fecha2").setAttribute('hidden', 'true');
                document.getElementById("cur").setAttribute('hidden', 'true');
            }else if($('#listT').val() == 2){
                document.getElementById("fecha1").setAttribute('hidden', 'true');
                document.getElementById("fecha2").setAttribute('hidden', 'true');
                document.getElementById("esc").setAttribute('hidden', 'true');
                document.getElementById("cur").removeAttribute('hidden');
            }else if($('#listT').val() == 3){
                document.getElementById("esc").setAttribute('hidden', 'true');
                document.getElementById("cur").setAttribute('hidden', 'true');
                document.getElementById("fecha1").removeAttribute('hidden');
                document.getElementById("fecha2").removeAttribute('hidden');
            }
        })

        function redirect(){
            if($('#listT').val() == 1){
                window.location.href = baseUrl + "/listados/alumnos/" + $('#als').val();
            }else if($('#listT').val() == 2){
                window.location.href = baseUrl + "/listados/cursos/" + $('#curso').val();
            }else if($('#listT').val() == 3){
                window.location.href = baseUrl + "/listados/pagos/" + $('#fechaD').val() + "/" + $('#fechaH').val();
            }
        }
    </script>
@stop