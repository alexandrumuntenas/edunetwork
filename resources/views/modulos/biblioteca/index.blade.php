@extends('adminlte::page')

@section('title', 'Catálogo < Biblioteca') @section('content_header') <h1>Catálogo @if (Auth::user()->hasRole('bibliotecario')) <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#addbook" href=""><i class="fas fa-book-medical"></i> Añadir libro</a> @endif </h1> @stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive-lg">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <table style="width:100%" id="catalogo"
                            class="table table-bordered table-hover dataTable dtr-inline collapsed">
                            <thead>
                                <tr>
                                    <td>Título</td>
                                    <td>Autor</td>
                                    <td>Editorial</td>
                                    <td>Año de Publicación</td>
                                    <td>ISBN</td>
                                    <td>Disponibilidad</td>
                                    @if (Auth::user()->hasRole('bibliotecario'))
                                        <td></td>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datos as $item)
                                    <tr>
                                        <td>{{ $item['titulo'] }}</td>
                                        <td>{{ $item['autor'] }}</td>
                                        <td>{{ $item['editorial'] }}</td>
                                        <td>{{ $item['anopub'] }}</td>
                                        <td>{{ $item['isbn'] }}</td>
                                        <td>
                                            @if ($item['disponibilidad'] === 1)
                                                <span class="badge bg-success">✓</span>
                                            @elseif($item['disponibilidad'] === 2)
                                                <span class="badge bg-warning">✗</span>
                                            @elseif($item['disponibilidad'] === 3)
                                                <span class="badge bg-danger">⏲</span>
                                            @elseif($item['disponibilidad'] === 4)
                                                <span class="badge bg-danger">😷</span>
                                            @endif
                                        </td>
                                        @if (Auth::user()->hasRole('bibliotecario'))
                                            <td class="form-inline">
                                                <a href="./acciones/editar/{{ $item['id'] }}"><i
                                                        class="fas fa-edit"></i></a>
                                                @if ($item['disponibilidad'] === 2)
                                                    <a href="./acciones/devolver/{{ $item['id'] }}"
                                                        style="margin: 0px 5px 0px 5px;"><i
                                                            class="fas fa-inbox"></i></a>
                                                    <a href="./acciones/prorroga/{{ $item['id'] }}"
                                                        style="margin: 0px 5px 0px 0px;"><i
                                                            class="fas fa-clock"></i></a>
                                                @elseif ($item['disponibilidad'] === 3)
                                                    <a href="./acciones/devolver/{{ $item['id'] }}"
                                                        style="margin: 0px 5px 0px 5px;"><i
                                                            class="fas fa-inbox"></i></a>
                                                @else
                                                    <a href="./acciones/prestar/{{ $item['id'] }}"
                                                        style="margin: 0px 5px 0px 5px;"><i
                                                            class="fas fa-book-open"></i></a>
                                                @endif
                                                <a href="./acciones/eliminar/{{ $item['id'] }}"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        @if (Auth::user()->hasRole('bibliotecario'))
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
                            <i class="fas fa-edit"></i> Editar
                        </p>
                        <p>
                            <i class="fas fa-inbox"></i> Devolver
                        </p>
                        <p>
                            <i class="fas fa-clock"></i> Retrasar devolución // Prorrogar préstamo
                        </p>
                        <p>
                            <i class="fas fa-trash"></i> Eliminar libro del catálogo
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="modal fade" id="addbook" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <form class="modal-content" method="post" action="{{url('/biblioteca/acciones/crear')}}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addbook">Añadir libro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>✨ Ahora puedes añadir libros más rápido! Solo escanea con el lector de código de barras el código de barras del libro que desees añadir. Utilizando la tecnología de Google y un poco de magia, completarás la información del libro en segundos. <mark>Ten en cuenta de que esta tecnología no es precisa al 100%, pero generalmente si dará buenos resultados.</mark></p>
                        <div id="gapisresult"></div>
                        <div class="form-group">
                            <label for="titulo">Título del libro</label>
                            <input id="titulo" name="titulo" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                        </div>
                        <div class="form-group">
                            <label for="autor">Autor</label>
                            <input id="autor" name="autor" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                        </div>
                        <div class="form-group">
                            <label for="ISBN">ISBN</label>
                            <input id="ISBN" name="ISBN" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                        </div>
                        <div class="form-group">
                            <label for="editorial">Editorial</label>
                            <input id="editorial" name="editorial" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                        </div>
                        <div class="form-group">
                            <label for="anopub">Año de Publicación</label>
                            <input id="anopub" name="anopub" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                        </div>
                        <div class="form-group">
                            <label for="ejemplar">Ejemplar</label>
                            <input id="ejemplar" name="ejemplar" class="form-control form-control-sm" type="text" maxlength="8" value="" required />
                        </div>
                        <div class="form-group">
                            <label for="ubicación">Ubicación</label>
                            <input id="ubicacion" name="ubicacion" class="form-control form-control-sm" type="text" maxlength="12" value="" required />
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea type="text" id="descripcion" name="descripcion" class="md-textarea form-control" maxlength="512" value="" required></textarea>
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
    </div>


@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#catalogo').DataTable();

        });

        function editar(id) {

        }

        function actualizar(id) {

        }

        function borrar(id) {

        }

        function prestar(id) {

        }

        function devolver(id) {

        }

        function prorroga(id) {

        }

        $("#gapi").click(function(){
 alert('toggled');
 })

    </script>
@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
