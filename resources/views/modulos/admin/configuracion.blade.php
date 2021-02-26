@extends('adminlte::page')

@section('title', 'Configuración < Administrar Edunetwork') @section('content_header') <h1>Configuración</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card table-responsive">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <table id="catalogo" class="table table-bordered table-hover dataTable dtr-inline collapsed">
                            <thead>
                                <tr>
                                    <td>Título</td>
                                    <td>Autor</td>
                                    <td>Editorial</td>
                                    <td>Año de Publicación</td>
                                    <td>ISBN</td>
                                    <td>Disponibilidad</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>


@stop





@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
