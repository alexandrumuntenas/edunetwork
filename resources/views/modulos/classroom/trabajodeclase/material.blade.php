@extends('adminlte::page')

@section('title', 'Classroom < Edunetwork') @section('content') <div class="row">
    @include('modulos.classroom.componentes.cabecera')

    <div class="col" id="class_sidebar">
        @include('modulos.classroom.componentes.sidebar')
    </div>
    <div class="col">
        <form class="card" action="{{ url("/elearning/c/$hash/trabajodeclase/c/material") }}" method="POST">
            <div class="card-header">
                <span class="card-title float-left">Crear nuevo material</span><span class="float-right"><button class="btn btn-success btn-sm" type="submit">Publicar</button></span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input class="form-control" name="titulo" id="titulo" required/>
                </div>
                <div class="form-group">
                    <label for="contenido">Descripción</label>
                    <textarea class="form-control" id="contenido" name="contenido"></textarea>
                </div>
        </form>
    </div>

    </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('contenido');
        });

    </script>
@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
