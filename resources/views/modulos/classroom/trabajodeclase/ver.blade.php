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
                    <span class="card-title float-left">{{$data['titulo']}}</span>
                </div>
                <div class="card-body">
                    {!!$data['contenido']!!}
                </div>
        </div>
        @endforeach
    </div>
    </div>
@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
