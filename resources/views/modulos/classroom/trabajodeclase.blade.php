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
        @if (Auth::user()->hasRole('profesor'))
            <div id="nuevoanuncio" class="card" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
                <div class="card-body">
                    <img class="user_avatar" src="{{ url('/images/_avatar.png') }}" /> Crear nueva actividad
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">No categorizado</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @foreach ($actividades as $actividad)
                    @if ($actividad->topic_id === 0)
                        En futuro commit
                    @endif
                @endforeach
            </div>
        </div>
        @foreach ($categorias as $categoria)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $categoria->topic_data }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($actividades as $actividad)
                        @if ($actividad->topic_id === $categoria->id)
                            En futuro commit
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach

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
