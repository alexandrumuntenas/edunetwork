@extends('adminlte::page')

@section('title', 'Préstamos < Biblioteca') @section('content_header') <h1>Préstamos</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive-lg">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <table style="width:100%" id="prestamos"
                            class="table table-bordered table-hover dataTable dtr-inline collapsed">
                            <thead>
                                <tr>
                                    <td>Título</td>
                                    <td>Autor</td>
                                    <td>Editorial</td>
                                    <td>Año de Publicación</td>
                                    <td>ISBN</td>
                                    <td>Fecha de devolución</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datos as $item)
                                    <tr>
                                        <td>{{ $item->titulo }}</td>
                                        <td>{{ $item->autor }}</td>
                                        <td>{{ $item->editorial }}</td>
                                        <td>{{ $item->anopub }}</td>
                                        <td>{{ $item->isbn }}</td>
                                        <td>{{ $item->fechadev }}</td>
                                        <td><a href="./acciones/devolver/{{ $item->id }}"
                                                style="margin: 0px 5px 0px 5px;"><i class="fas fa-inbox"></i></a>
                                            <a href="./acciones/prorroga/{{ $item->id }}"
                                                style="margin: 0px 5px 0px 0px;"><i class="fas fa-clock"></i></a>
                                        </td>
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
        <!-- /.col -->
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
                <div class="card-body leyenda form-inline">
                    <p>
                        <i class="fas fa-inbox"></i> Devolver
                    </p>
                    <p>
                        <i class="fas fa-clock"></i> Retrasar devolución // Prorrogar préstamo
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#prestamos').DataTable();
        });

    </script>
@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
