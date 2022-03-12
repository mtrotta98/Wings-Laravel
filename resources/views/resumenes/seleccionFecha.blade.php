@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    
    <!-- Modal -->
    <div class="modal fade" id="fecha" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Seleccione una fecha</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form method="POST" id="form-asignarCurso">
                            {!! csrf_field() !!}
                            @method('POST')

                            <div class="form-group">
                              <label for="">Fecha desde:</label>
                              <input type="date" class="form-control" name="fechaD" id="fechaD" aria-describedby="helpId" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="">Fecha hasta:</label>
                                <input type="date" class="form-control" name="fechaH" id="fechaH" aria-describedby="helpId" placeholder="">
                              </div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" id="cerrar">Cerrar</a>
                    <a href="#" onclick="redirect()">Buscar</a>
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
        document.addEventListener('DOMContentLoaded', function(){
            $('#fecha').modal('show');
        })

        document.getElementById('cerrar').addEventListener('click', function(){
            window.location.href = baseUrl;
        })

        function buscarD(){
            let fechaD = $('#fechaD').val()
            return fechaD
        }

        function buscarH(){
            let fechaH = $('#fechaH').val()
            return fechaH
        }

        function redirect(){
            if(($('#fechaD').val() == '') || (($('#fechaH').val() == ''))){
                alert('Seleccione las dos fechas')
            }else{
                localStorage.clear();
                localStorage.setItem("fechaD", $('#fechaD').val());
                localStorage.setItem('fechaH', $('#fechaH').val());
                window.location.href = baseUrl + '/resumenPorFecha/buscar/' + $('#fechaD').val() + '/' + $('#fechaH').val();
            }
        }
    </script>
@stop