@extends('adminlte::page')

@section('title', 'Classroom < Edunetwork') @section('content')<div class="h-100"><div class="row justify-content-center">
    @include('modulos.classroom.componentes.cabecera')

    <div class="col" id="class_sidebar">
        @include('modulos.classroom.componentes.sidebar')
    </div>
    <div class="col" style="max-width:712px">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    @if (Auth::user()->hasRole('profesor'))
                        Alumnos
                    @else
                        Compañeros de clase
                    @endif
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 40px;"></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alumnos as $alumno)
                            @if ($alumno->id != $classroom['classroom_teacher'])
                                <tr>
                                    <th><img class="user_avatar" src="{{ url('/images/_avatar.png') }}" /></th>
                                    <th> {{ $alumno->name }}
                                        @if (Auth::user()->hasRole('profesor'))
                                            <br>
                                            <h6 class="card-subtitle">{{ $alumno->email }}</h6>
                                    </th>
                                @else
                                    </th>
                            @endif
                            <th style="text-align:right"><i class="far fa-paper-plane"></i></th>
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>


    </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('nuevomensaje');

        });

    </script>
@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
