<div class="row">
    @if (Auth::user()->hasRole('bibliotecario'))
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
    @endif
    <div class="w-100"></div>
    <div class="col">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Tus préstamos</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if ($prestamos != '[]')
                    <table style="width:100%" id="prestamos" class="table table-bordered table-hover">
                        <thead>
                            <td>Título</td>
                            <td>Fecha de devolución</td>
                        </thead>
                        <tbody>
                            @foreach ($prestamos as $item)
                                <tr>
                                    <td>{{ $item->titulo }}</td>
                                    <td>{{ $item->fechadev }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    No tienes prestamos activos...
                @endif
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Progreso de lectura</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                The body of the card
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Últimos libros en la biblioteca</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                The body of the card
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="w-100"></div>

</div>
