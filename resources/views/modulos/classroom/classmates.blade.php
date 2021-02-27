@extends('adminlte::page')

@section('title', 'Classroom < Edunetwork') @section('content') <div class="row">
    @foreach (json_decode($classroom['classroom_config']) as $i)
        <div class="col-12" id="class_header">
            <div class="card">
                <img class="classbg"
                    src="https://cdn.duoestudios.es/wp-content/uploads/2021/02/pexels-elina-krima-3309968-scaled.jpg">
                <div class="text-block">
                    <h4>{{ $i->asignatura }}</h4>
                    <p>{{ $i->clase }} · {{ $i->profesor_name }}</p>
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-3" id="class_pte_act">
        <div id="class_sidebar">
            @include('modulos.classroom.componentes.sidebar')
        </div>
    </div>
    <div class="col-9">
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
