@extends('adminlte::page')

@section('title', 'Notificaciones < Biblioteca') @section('content_header') <h1>Notificaciones @if (Auth::user()->hasRole('director|vicedirector|secretaria|jeafaturadeestudios|it')) <a
            class="btn btn-success btn-sm" data-toggle="modal" data-target="#addbook" href=""><i
                class="fas fa-book-medical"></i> Añadir libro</a></h1>
    @endif
</h1> @stop

@section('content')

    <div class="row">
        @foreach ($datos['data'] as $item)
            @foreach (json_decode($item['json_data'], true) as $dato)
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">

                            <h5>{{ $dato['titulo'] }}</h6>
                                <p>{!! $dato['contenido'] !!}</p>
                                <p><small>{!! $dato['autor'] !!}</small></p>
                                @if (Auth::user()->hasRole('director|vicedirector|secretaria|jeafaturadeestudios|it'))
                                    <td class="form-inline">
                                        <a class="btn btn-primary" href="/../acciones/editar/{{ $item['id'] }}"><i
                                                class="fas fa-edit"></i> Editar</a>
                                        <a class="btn btn-danger" href="/../acciones/eliminar/{{ $item['id'] }}"><i
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

        <div class="modal fade" id="addbook" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <form class="modal-content" method="post" action="{{ url('/biblioteca/acciones/crear') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addbook">Añadir libro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>✨ Ahora puedes añadir libros más rápido! Solo escanea con el lector de código de barras
                            el código de barras del libro que desees añadir. Utilizando la tecnología de Google y un
                            poco de magia, completarás la información del libro en segundos. <mark>Ten en cuenta de
                                que esta tecnología no es precisa al 100%, pero generalmente si dará buenos
                                resultados.</mark></p>
                        <div id="gapisresult"></div>
                        <div class="form-group">
                            <label for="titulo">Título del libro</label>
                            <input id="titulo" name="titulo" class="form-control form-control-sm" type="text"
                                maxlength="255" value="" required />
                        </div>
                        <div class="form-group">
                            <label for="autor">Autor</label>
                            <input id="autor" name="autor" class="form-control form-control-sm" type="text"
                                maxlength="255" value="" required />
                        </div>
                        <div class="form-group">
                            <label for="ISBN">ISBN</label>
                            <input id="ISBN" name="ISBN" class="form-control form-control-sm" type="text"
                                maxlength="255" value="" required />
                        </div>
                        <div class="form-group">
                            <label for="editorial">Editorial</label>
                            <input id="editorial" name="editorial" class="form-control form-control-sm" type="text"
                                maxlength="255" value="" required />
                        </div>
                        <div class="form-group">
                            <label for="anopub">Año de Publicación</label>
                            <input id="anopub" name="anopub" class="form-control form-control-sm" type="text"
                                maxlength="255" value="" required />
                        </div>
                        <div class="form-group">
                            <label for="ejemplar">Ejemplar</label>
                            <input id="ejemplar" name="ejemplar" class="form-control form-control-sm" type="text"
                                maxlength="8" value="" required />
                        </div>
                        <div class="form-group">
                            <label for="ubicación">Ubicación</label>
                            <input id="ubicacion" name="ubicacion" class="form-control form-control-sm" type="text"
                                maxlength="12" value="" required />
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea type="text" id="descripcion" name="descripcion" class="md-textarea form-control"
                                maxlength="512" value="" required></textarea>
                        </div>
                        <div class="form-group">
                            <input id="portada" name="portada" type="text" value="" hidden />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info" id="gapi">Completar información</button>
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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#notificaciones').DataTable();

        });

    </script>
@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
