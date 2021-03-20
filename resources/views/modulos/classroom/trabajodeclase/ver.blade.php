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
                            @if($nrespuestasalumno != 0)
                                @if ($data['masrespuestas'] == 1)
                                    <div class="row">
                                        Introduce tu respuesta:
                                    </div>
                                    <form class="row"
                                        action="{{ url('/elearning/c/' . $hash . '/trabajodeclase/entregar') }}"
                                        method="POST">
                                        @csrf
                                        @if ($data['atributo'] === 'number')
                                            <input class="form-control col-11"
                                                placeholder="Introduce un valor entre {{ $data['min'] }} y {{ $data['max'] }}"
                                                name="respuesta" type="{{ $data['atributo'] }}"
                                                min="{{ $data['min'] }}" max="{{ $data['max'] }}" />
                                        @elseif($data['atributo'] === 'textarea')
                                            <div><textarea class="col-11" id="contenido" name="respuesta"></textarea>
                                            </div>
                                        @else <input class="form-control col-11" name="respuesta"
                                                type="{{ $data['atributo'] }}" />
                                        @endif
                                        <button type="submit"
                                            class="btn btn-light float-right col-1 fas fa-paper-plane"></button>
                                    </form>
                                @else

                                @endif
                            @else
                                <div class="row">
                                    Introduce tu respuesta:
                                </div>
                                <form class="row"
                                    action="{{ url('/elearning/c/' . $hash . '/trabajodeclase/entregar') }}"
                                    method="POST">
                                    @csrf
                                    @if ($data['atributo'] === 'number')
                                        <input class="form-control col-11"
                                            placeholder="Introduce un valor entre {{ $data['min'] }} y {{ $data['max'] }}"
                                            name="respuesta" type="{{ $data['atributo'] }}"
                                            min="{{ $data['min'] }}" max="{{ $data['max'] }}" />
                                    @elseif($data['atributo'] === 'textarea')
                                        <div><textarea class="col-11" id="contenido" name="respuesta"></textarea></div>
                                    @else <input class="form-control col-11" name="respuesta"
                                            type="{{ $data['atributo'] }}" />
                                    @endif
                                    <button type="submit"
                                        class="btn btn-light float-right col-1 fas fa-paper-plane"></button>
                                </form>
                            @endif
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
                                <h3>{{ $nopresentado }}</sup></h3>

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
                                <h3>{{ $presentado }}</sup></h3>

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
                                <h3>{{ $devuelto }}</sup></h3>

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

    @if ($classroom['classroom_teacher'] != Auth::user()->id)
        </div>
        <h3>Mis respuestas</h3>
        @foreach ($respuestasalumno as $solucion)
            @if ($actividad->type === 'pregunta')
                <div class="card">
                    <div class="card-header" id="class_message">Entregado el {{ $solucion->created_at }}</div>
                    <div class="card-body">{!! $solucion->response_data !!}</div>
                    <div class="card-footer">Entregado el {{ $solucion->created_at }}</div>
                </div>
            @else
            @endif
        @endforeach
    @else
        @foreach ($respuestas as $respuesta)
            @foreach ($listadoalumnos as $alumno)
                @php
                    $user_data = DB::table('users')
                        ->where('id', '=', $alumno->id)
                        ->first();
                @endphp
                @if ($respuesta->student_id === $alumno->id)
                    <div class="card" id="classroom_tablon">
                        <div class="card-header" id="class_message">
                            <img class="user_avatar" src="{{ url('/images/_avatar.png') }}" />
                            {{ $user_data->name }}
                            <h6 class="card-subtitle mb-2 text-muted">{{ $respuesta->created_at }}</h6>
                        </div>
                        <div class="card-body">
                            <h5>{!! $data['titulo'] !!}</h5>
                            {!! $respuesta->response_data !!}
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
    @endif

    </div>

    @endforeach
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function() {
            CKEDITOR.replace("contenido");
        });

    </script>
@stop
@section('footer')
    Edunetwork v1 .0
    < /> by duoestudios
@endsection
