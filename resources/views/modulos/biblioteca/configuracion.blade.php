@extends('adminlte::page')

@section('title', 'Configuración < Biblioteca < Edunetwork') @section('content_header') <h1>Configuración de la
    biblioteca</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <h5 class="mb-2">Estadísticas</h5>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $cantidad }}</h3>

                            <p>Libros en el catálogo</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $prestados }}</sup></h3>

                            <p>Libros prestados</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $devolucion }}</sup></h3>

                            <p>Libros por devolver</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-inbox"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $confinados }}</sup></h3>

                            <p>Libros confinados</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hand-holding-medical"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Acciones disponibles</h3>

                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class='form-inline'>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#importarabies">
                                    Importar catálogo desde <strong>abies</strong>
                                </button>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#importarbiblioweb" style="margin: 10px;">
                                    Importar catálogo desde <strong>biblioweb</strong>
                                </button>
                                <form action="{{ url('/biblioteca/acciones/borrarcatalogo') }}" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de querer borrar el catálogo? Una vez hayas aceptado, no podrás volver a recuperarlo');">
                                    <input type="submit" class="btn btn-danger" value="Vaciar catálogo">
                                    @csrf
                                </form>
                            </div>
                            <div class="modal fade" id="importarabies" tabindex="-1" role="dialog"
                                aria-labelledby="importarabies" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form enctype="multipart/form-data"
                                            action="{{ url('/biblioteca/acciones/subir/abies') }}" method="post">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="importarabies">Importar catálogo desde Abies
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                @csrf
                                            </div>
                                            <div class="modal-body">
                                                Nombre de archivo *.CSV a subir:<br /><br /><input size="50" type="file"
                                                    name="filename" accept=".csv" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" name="importarabies"
                                                    id="enviar" />Importar</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="importarbiblioweb" tabindex="-1" role="dialog"
                                aria-labelledby="importarbiblioweb" aria-hidden="true" onsubmit="importar()">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form enctype="multipart/form-data"
                                            action="{{ url('/biblioteca/acciones/subir/biblioweb') }}" method="post">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="importarbiblioweb">Importar catálogo desde
                                                    Biblioweb (JDA)
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                @csrf
                                            </div>
                                            <div class="modal-body">
                                                Nombre de archivo *.CSV a subir:<br /><br /><input size="50" type="file"
                                                    name="filename" accept=".csv" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" name="importarbiblioweb"
                                                    id="enviar" />Importar</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop



@section('js')
    <script>
        function importar() {
            $("#enviar").html(
                '<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only" > Loading... </span> </div> Importando'
                );
            $("#enviar").attr('disabled', true);
        }

    </script>

@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
