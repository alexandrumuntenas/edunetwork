@extends('adminlte::page')

@section('title', 'Classroom < Edunetwork') @section('content') <div class="row">
    @include('modulos.classroom.componentes.cabecera')

    <div class="col" id="class_sidebar">
        @include('modulos.classroom.componentes.sidebar')
    </div>
    <div class="col">
        @if (Auth::user()->hasRole('profesor'))
            <div id="nuevoanuncio" class="card">
                <div class="card-body" data-toggle="modal" data-target="#nuevaactividadhub">
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
    @if (Auth::user()->hasRole('profesor'))
        <div class="modal fade" id="nuevaactividadhub" tabindex="-1" aria-labelledby="nuevaactividadhub"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="nuevaactividadhub">Crear nueva actividad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row" id="class_work">
                            @include('modulos.classroom.componentes.actividades')
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
