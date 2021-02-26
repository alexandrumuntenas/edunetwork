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
        <div id="nuevoanuncio" class="card" style="width:100%" data-toggle="modal" data-target="#crearanuncio">
            <div class="card-body">
                <img class="user_avatar" src="{{ url('/images/_avatar.png') }}" /> Anuncia algo a tu clase
            </div>
        </div>
        @foreach ($anuncios as $anuncio)
            <div class="card" id="classroom_tablon">
                <div class="card-header" id="class_message">
                    <img class="user_avatar" src="{{ url('/images/_avatar.png') }}" />
                    {{ $anuncio['author'] }}
                    <h6 class="card-subtitle mb-2 text-muted">{{ $anuncio['created_at'] }}</h6>
                </div>
                <div class="card-body">
                    {!! $anuncio['message_data'] !!}
                </div>
            </div>
        @endforeach
    </div>

    </div>
    <div class="modal fade" id="crearanuncio" tabindex="-1" aria-labelledby="crearanuncio" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <form class="modal-content" method="post"
                    action="{{ url('/elearning/c/' . $hash . '/tablon/crear') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addnotification">Anuncia algo a tu clase</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea type="text" id="nuevomensaje" name="nuevomensaje" class="md-textarea form-control"
                                maxlength="2048" value="" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Añadir</button>
                    </div>
                </form>
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