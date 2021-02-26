@extends('adminlte::page')

@section('title', 'Mis préstamos < Biblioteca') @section('content_header') <h1>Mis préstamos</h1>
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
    </div>


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
