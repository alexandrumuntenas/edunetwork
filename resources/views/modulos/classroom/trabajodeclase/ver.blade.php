@extends('adminlte::page')

@section('title', 'Classroom < Edunetwork') @section('content') <div class="row">
    @include('modulos.classroom.componentes.cabecera')

    <div class="col" id="class_sidebar">
        @include('modulos.classroom.componentes.sidebar')
    </div>
    @foreach (json_decode($actividad->activity_data, true) as $data)
        <div class="col">
            <div class="card">
                <div class="card-header" id="class_message">
                    <span class="card-title float-left">{{ $data['titulo'] }}</span>
                </div>
                <div class="card-body">
                    {!! $data['contenido'] !!}
                </div>
                @if ($classroom['classroom_teacher'] != Auth::user()->id)
                    @if ($actividad->type === 'pregunta')
                        <div class="card-footer">
                            <div class="row">
                                Introduce tu respuesta:
                            </div>
                            <form class="row" action="{{ url('/elearning/c/' . $hash . '/trabajodeclase/entregar') }}"
                                method="POST">
                                @csrf
                                @if ($data['atributo'] === 'number')
                                    <input class="form-control col-11"
                                        placeholder="Introduce un valor entre {{ $data['min'] }} y {{ $data['max'] }}"
                                        name="respuesta" type="{{ $data['atributo'] }}" min="{{ $data['min'] }}"
                                        max="{{ $data['max'] }}" />
                                @elseif($data['atributo'] === 'textarea')
                                    <div><textarea class="col-11" id="contenido" name="respuesta"></textarea></div>
                                @else <input class="form-control col-11" name="respuesta"
                                        type="{{ $data['atributo'] }}" />
                                @endif
                                <button type="submit"
                                    class="btn btn-light float-right col-1 fas fa-paper-plane"></button>
                            </form>
                        </div>
                    @endif
                @else
            </div>
            <div class="card">
                <div class="card-body row">
                    <div class="col-4">
                        <!-- small card -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3></sup></h3>

                                <p>Tarea no-presentada</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <!-- small card -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3></sup></h3>

                                <p>Tarea presentada</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-inbox"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <!-- small card -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3></sup></h3>

                                <p>Tarea devuelta</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-reply"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <h3>Respuestas de los alumnos</h3>
    @endif

    </div>
    @if ($classroom['classroom_teacher'] != Auth::user()->id)
        @if ($actividad->type === 'pregunta')
            <div class="card">
                <div class="card-header">Respuestas anteriores</div>
                <div class="card-body"></div>
                <div class="card-footer"></div>
            </div>
        @else
        @endif
    @endif

    </div>

    @endforeach
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function() {
            CKEDITOR.replace("contenido", {
                on: {
                    // maximize the editor on startup
                    'instanceReady': function(evt) {
                        evt.editor.resize("100%", '100%');
                    }
                }
            });
        });

    </script>
@stop
@section('footer')
    Edunetwork v1 .0
    < /> by duoestudios
@endsection
