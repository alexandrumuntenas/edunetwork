@extends('adminlte::page')

@section('title', 'Classroom < Edunetwork') @section('content')<div class="h-100"><div class="row justify-content-center">
    @include('modulos.classroom.componentes.cabecera')

    <div class="col" id="class_sidebar">
        @include('modulos.classroom.componentes.sidebar')
    </div>
    @foreach (json_decode($actividad->activity_data, true) as $data)
        <div class="col" style="max-width:712px">
            <div class="card">
                <div class="card-header" id="class_title">
                    <span class="card-title float-left">{{ $data['titulo'] }}</span>
                </div>
                <div class="card-body">
                    {!! $data['contenido'] !!}
                </div>
                @if ($classroom['classroom_teacher'] != Auth::user()->id)
                    @if ($actividad->type === 'pregunta')
                        <div class="card-footer">
                            @if ($nrespuestasalumno != 0)
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
                                            <div><textarea class="col-11" id="contenido" name="respuesta"
                                                    required></textarea>
                                            </div>
                                        @else <input class="form-control col-11" name="respuesta"
                                                type="{{ $data['atributo'] }}" required />
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
                                            min="{{ $data['min'] }}" max="{{ $data['max'] }}" required />
                                    @elseif($data['atributo'] === 'textarea')
                                        <div><textarea class="col-11" id="contenido" name="respuesta"
                                                required></textarea></div>
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
                    <div class="card-header" id="class_title">Entregado el {{ $solucion->created_at }}</div>
                    <div class="card-body">
                        @if ($data['atributo'] == 'color')
                            <div class="col-4">
                                <!-- small card -->
                                <div class="small-box" style="background-color:{!! $solucion->response_data !!}">
                                    <div class="inner">
                                        <h3>{!! $solucion->response_data !!}</sup></h3>

                                        <p>Puntuación: {{ $solucion->mark }}/{{ $data['puntos'] }}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                </div>
                            </div>
                        @else
                            {!! $solucion->response_data !!}
                        @endif
                    </div>
                    @if ($data['atributo'] != 'color')
                        <div class="card-footer">Puntuación: {{ $solucion->mark }}/{{ $data['puntos'] }}</div>
                    @endif
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
                    <div class="card">
                        <div class="card-header" id="class_title">
                            <h5>{{$alumno->name}}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Entregado el {{ $respuesta->created_at }}</h6>
                        </div>
                        <div class="card-body">
                            @if ($data['atributo'] == 'color')
                                <div class="col-4">
                                    <!-- small card -->
                                    <div class="small-box" style="background-color:{!! $respuesta->response_data !!}">
                                        <div class="inner">
                                            <h3>{!! $respuesta->response_data !!}</sup></h3>

                                            <p>Puntuación: {{ $respuesta->mark }}/{{ $data['puntos'] }}</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-inbox"></i>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {!! $respuesta->response_data !!}
                            @endif
                        </div>
                        <form method="post" class="card-footer form-inline">
                            Puntuación: <input class="form-control form-control-sm col-1" id="{{ $respuesta->id }}"
                                type="number" value="{{ $respuesta->mark ?? null }}" />/{{ $data['puntos'] }}
                            <script>
                                $(document).ready(function() {
                                    $("#{{ $respuesta->id }}").focusout(function() {
                                        var pts = $("#{{ $respuesta->id }}").val();
                                        var csrf = "{{ csrf_token() }}";
                                        var user = "{{ $respuesta->student_id }}";
                                        var actv = "{{ $respuesta->activity_id }}";
                                        var rpsi = "{{ $respuesta->id }}";
                                        $.ajax({
                                            type: "POST",
                                            url: "{{ url('/elearning/c/' . $hash . '/trabajodeclase/v/' . $respuesta->activity_id . '/evaluar') }}",
                                            data: {
                                                puntuacion: pts,
                                                usuario: user,
                                                actividad: actv,
                                                respuesta: rpsi,
                                                _token: csrf
                                            },
                                            success: function(html) {
                                                $("#display").html(html).show();
                                            },
                                        });
                                    });
                                });

                            </script>
                        </form>
                @endif
            @endforeach
            </div>
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
