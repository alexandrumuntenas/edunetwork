@extends('adminlte::page')

@section('title', 'Classroom < Edunetwork') @section('content')<div class="h-100"><div class="row justify-content-center">
    @include('modulos.classroom.componentes.cabecera')
    <div class="col" id="class_sidebar">
        @include('modulos.classroom.componentes.sidebar')
    </div>
    <div class="col" style="max-width:712px">
        @foreach (json_decode($classroom['classroom_config']) as $config)
            <div id="nuevoanuncio" class="card" style="width:100%" data-toggle="modal" data-target="#crearanuncio">
                <div class="card-body">
                    <img class="user_avatar" src="{{ url('/images/_avatar.png') }}" /> Anuncia algo a tu clase
                </div>
            </div>

            @foreach ($anuncios as $anuncio)
                @if ($anuncio->type == 'publicacion')
                    <div class="card" id="classroom_tablon">
                        <div class="card-header" id="class_title">
                            <img class="user_avatar" src="{{ url('/images/_avatar.png') }}" />
                            @if ($anuncio->author_id == Auth::user()->id)
                                <div class="card-tools dropleft float-right">
                                    <button type="button" class="btn btn-tool" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                            class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Editar</a>
                                        <a class="dropdown-item" href="#">Eliminar</a>
                                        <button class="dropdown-item" disabled>Copiar enlace</a>
                                    </div>
                                </div>
                            @endif

                            {{ $anuncio->author }}
                            <h6 class="card-subtitle mb-2 text-muted">{{ $anuncio->created_at }}</h6>

                        </div>
                        <div class="card-body">
                            {!! $anuncio->message_data !!}
                        </div>
                        @php
                            $comentarios = DB::table($hash . '_class_messages')
                                ->where('type', '=', 'comentario')
                                ->where('parent', '=', $anuncio->id)
                                ->get();
                            if ($comentarios == '[]') {
                                $comentarios = null;
                            }
                        @endphp
                        <div class="card-body comments">
                            <h5>Comentarios</h5>
                            @if (isset($comentarios))

                                @foreach ($comentarios as $comentario)
                                    <div id="row">
                                        <div id="col">
                                            <img class="user_avatar_comments"
                                                src="{{ url('/images/_avatar.png') }}" />
                                        </div>
                                        <div id="col" style="margin-top: 25px; max-width:712px">
                                            <h6>{{ $comentario->author }} <span
                                                    class="text-muted">{{ $comentario->created_at }}</span></h6>
                                            {{ $comentario->message_data }}
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div id="comentario">
                                </div>
                            @endif
                        </div>

                        @if ($config->comentarios == 'activado')
                            <form class="card-footer comments" name="{{ hash('sha256', $anuncio->id) }}">
                                <div class="input-group">
                                    @csrf
                                    <img class="user_avatar_comments" src="{{ url('/images/_avatar.png') }}" />
                                    <input value="{{ $anuncio->id }}" name="parent" hidden />
                                    <textarea class="form-control" id="{{ hash('sha256', $anuncio->id) }}textarea"
                                        required name="content"></textarea>
                                    <button type="submit" class="btn btn-light"><i
                                            class="fas fa-paper-plane"></i></button>
                                </div>
                            </form>
                            <script>
                                $(document).ready(function() {
                                    $('form[name="{{ hash('sha256', $anuncio->id) }}"]').ajaxForm({
                                        url: '{{ url('/elearning/c/' . $hash . '/tablon/comentar') }}',
                                        type: 'post',
                                        beforeSend: function(Pace) {
                                            $('#{{ hash('sha256', $anuncio->id) }}textarea')
                                                .prop(
                                                    'readonly',
                                                    true);
                                        },
                                        error: function() {
                                            const Toast = Swal.mixin({
                                                toast: true,
                                                position: 'bottom',
                                                showConfirmButton: false,
                                                timer: 3000,
                                                timerProgressBar: true,
                                                didOpen: (toast) => {
                                                    toast.addEventListener('mouseenter',
                                                        Swal
                                                        .stopTimer)
                                                    toast.addEventListener('mouseleave',
                                                        Swal
                                                        .resumeTimer)
                                                }
                                            })

                                            Toast.fire({
                                                icon: 'error',
                                                title: 'El comentario no se ha podido publicar...'
                                            })
                                            $('#{{ hash('sha256', $anuncio->id) }}textarea')
                                                .prop('readonly',
                                                    false);
                                        },
                                        success: function() {
                                            const Toast = Swal.mixin({
                                                toast: true,
                                                position: 'bottom',
                                                showConfirmButton: false,
                                                timer: 3000,
                                                timerProgressBar: true,
                                                didOpen: (toast) => {
                                                    toast.addEventListener('mouseenter',
                                                        Swal
                                                        .stopTimer)
                                                    toast.addEventListener('mouseleave',
                                                        Swal
                                                        .resumeTimer)
                                                }
                                            });

                                            Toast.fire({
                                                icon: 'success',
                                                title: 'El comentario se ha publicado, recargando página...'
                                            });
                                            setTimeout(function() {
                                                location.reload()
                                            }, 3000);
                                        }
                                    });
                                });

                            </script>
                        @elseif($config->comentarios == 'noeditar')
                            <form class="card-footer comments form-inline">
                                Actualización de los comentarios pte
                            </form>
                        @endif
                    </div>
                @elseif($anuncio->type == 'actividad')
                    <a class="card" id="classroom_activity_msg"
                        href="{{ url('/elearning/c/' . $hash . '/trabajodeclase/v/' . $anuncio->parent) }}">
                        <div class="card-header" id="class_title">
                            <i class="activitybcast fas fa-bullhorn"></i>
                            {{ $anuncio->author }}
                        </div>
                        <div class="card-footer text-muted">
                            {{ $anuncio->created_at }}
                        </div>
                    </a>
                @endif
            @endforeach

            {{ $anuncios->links() }}
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
