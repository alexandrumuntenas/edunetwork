@extends('adminlte::page')

@section('title', 'Notificaciones < Edunetwork') @section('content_header') <h1>Notificaciones @if (Auth::user()->hasRole('director|vicedirector|secretaria|jeafaturadeestudios|it')) <a
            class="btn btn-success btn-sm" data-toggle="modal" data-target="#addnotification" href=""><i
                class="fas fa-bell"></i> Crear notificación</a>
    @endif
    </h1>
</h1> @stop

@section('content')

    <div class="row">
        @foreach ($datos['data'] as $item)
            @foreach (json_decode($item['json_data'], true) as $dato)
                <div class="col-4">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">

                            <h5>{{ $dato['titulo'] }}</h6>
                                <p>{!! substr($dato['contenido'], 0, 256) !!}... <a
                                        href="{{ url('/notificaciones/v/' . $item['id']) }}">Leer más</a></p>
                                <p><small>{!! $dato['autor'] !!}</small></p>
                                @if (Auth::user()->hasRole('director|vicedirector|secretaria|jeafaturadeestudios|it'))
                                    <td class="form-inline">
                                        <a class="btn btn-primary"
                                            href="{{ url('/notificaciones/acciones/editar/' . $item['id']) }}"><i
                                                class="fas fa-edit"></i> Editar</a>
                                        <a class="btn btn-danger"
                                            href="{{ url('/notificaciones/acciones/eliminar/' . $item['id']) }}"><i
                                                class="fas fa-trash"></i> Eliminar</a>
                                    </td>
                                @endif
                                </tr>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
            @endforeach
        @endforeach
    </div>
    </div>
    @if (Auth::user()->hasRole('director|vicedirector|secretaria|jeafaturadeestudios|it'))
        <div class="col-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Leyenda</h3>

                    <div class="card-tools">

                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                            <i class="fas fa-expand"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body form-inline leyenda">
                    <p>
                        <i class="fas fa-edit"></i> Editar notificación
                    </p>
                    <p>
                        <i class="fas fa-trash"></i> Eliminar notificación
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <div class="modal fade" id="addnotification" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <form class="modal-content" method="post" action="{{ url('/notificaciones/acciones/crear') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addnotification">Añadir notificación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="titulo">Título de la notificación</label>
                            <input id="titulo" name="titulo" class="form-control form-control-sm" type="text"
                                maxlength="255" value="" required />
                        </div>
                        <div class="form-group">
                            <label for="autor">Autor</label>
                            <input id="autor" name="autor" class="form-control form-control-sm" type="text"
                                maxlength="255" value="{{ $autor }}" readonly />
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Contenido</label>
                            <textarea type="text" id="contenido" name="contenido" class="md-textarea form-control"
                                maxlength="1024" value="" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Añadir</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    <!-- /.col -->
    {{ $links->links() }}

    </div>


@stop

@section('css')
    <style>
        .card {
            min-width: 300px;
            height: auto;
        }

    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('contenido');
        });

    </script>
@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
