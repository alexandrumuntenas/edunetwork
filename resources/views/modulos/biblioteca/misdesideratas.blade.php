@extends('adminlte::page')

@section('title', 'Desideratas < Biblioteca') @section('content_header') <h1 class="help-1">Desideratas</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card card-warning" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
                <div class="card-header">
                    <h3 class="card-title">Solicitudes pendientes...</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                class="fas fa-expand"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive-lg">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <table style="width:100%" id="pendientes"
                            class="table table-bordered table-hover dataTable dtr-inline collapsed">
                            <thead>
                                <tr>
                                    <td>Título</td>
                                    <td>Autor</td>
                                    <td>Editorial</td>
                                    <td>ISBN</td>
                                    <td>Solicitado</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pte as $item)
                                    <tr>
                                        <td>{{ $item->titulo }}</td>
                                        <td>{{ $item->autor }}</td>
                                        <td>{{ $item->editorial }}</td>
                                        <td>{{ $item->isbn }}</td>
                                        <td>{{ $item->fecha }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-12">
            <div class="card card-success" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
                <div class="card-header">
                    <h3 class="card-title">Solicitudes aprobadas...</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                class="fas fa-expand"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive-lg">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <table style="width:100%" id="aprobados"
                            class="table table-bordered table-hover dataTable dtr-inline collapsed">
                            <thead>
                                <tr>
                                    <td>Título</td>
                                    <td>Autor</td>
                                    <td>Editorial</td>
                                    <td>ISBN</td>
                                    <td>Solicitado</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($aprobados as $item)
                                    <tr>
                                        <td>{{ $item->titulo }}</td>
                                        <td>{{ $item->autor }}</td>
                                        <td>{{ $item->editorial }}</td>
                                        <td>{{ $item->isbn }}</td>
                                        <td>{{ $item->fecha }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-12">
            <div class="card card-danger" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
                <div class="card-header">
                    <h3 class="card-title">Solicitudes rechazadas...</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                class="fas fa-expand"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive-lg">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <table style="width:100%" id="rechazados"
                            class="table table-bordered table-hover dataTable dtr-inline collapsed">
                            <thead>
                                <tr>
                                    <td>Título</td>
                                    <td>Autor</td>
                                    <td>Editorial</td>
                                    <td>ISBN</td>
                                    <td>Solicitado</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rechazados as $item)
                                    <tr>
                                        <td>{{ $item->titulo }}</td>
                                        <td>{{ $item->autor }}</td>
                                        <td>{{ $item->editorial }}</td>
                                        <td>{{ $item->isbn }}</td>
                                        <td>{{ $item->fecha }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#pendientes').DataTable();
            $('#aprobados').DataTable();
            $('#rechazados').DataTable();
        });

    </script>
@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
