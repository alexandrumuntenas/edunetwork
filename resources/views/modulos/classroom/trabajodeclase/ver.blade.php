@extends('adminlte::page')

@section('title', 'Classroom < Edunetwork') @section('content') <div class="row">
    @include('modulos.classroom.componentes.cabecera')

    <div class="col" id="class_sidebar">
        @include('modulos.classroom.componentes.sidebar')
    </div>
    <div class="col">
        <div class="card">
            @foreach (json_decode($actividad->activity_data, true) as $data)
                <div class="card-header" id="class_message">
                    <span class="card-title float-left">{{ $data['titulo'] }}</span>
                </div>
                <div class="card-body">
                    {!! $data['contenido'] !!}
                </div>
                @if ($actividad->type === 'pregunta')
                    <form class="card-footer row"
                        action="{{ url('/elearning/c/' . $hash . '/trabajodeclase/entregar') }}" method="POST">
                        @csrf
                        Introduce tu respuesta:
                        @if ($data['atributo'] === 'number')
                            <input class="form-control col-11"
                                placeholder="Introduce un valor entre {{ $data['min'] }} y {{ $data['max'] }}"
                                name="respuesta" type="{{ $data['atributo'] }}" min="{{ $data['min'] }}"
                                max="{{ $data['max'] }}" />
                        @elseif($data['atributo'] === 'textarea')
                            <textarea id="contenido" name="respuesta"></textarea>
                        @else <input class="form-control col-11" name="respuesta"
                                type="{{ $data['atributo'] }}" />
                        @endif
                        <button type="submit" class="btn btn-light float-right col-1 fas fa-paper-plane"></button>
                    </form>
                @endif

        </div>
        @endforeach
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
    Edunetwork v1 .0
    < /> by duoestudios
@endsection
