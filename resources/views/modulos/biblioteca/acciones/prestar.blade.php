@extends('adminlte::page')

@section('title', 'Prestar < Biblioteca') @section('content_header') <h1>Realizando prestamo...</h1>
@stop

@section('content')

    <div class="row">
        <div class="col">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos del préstamo</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                class="fas fa-expand"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="POST" action="{{ url('/biblioteca/acciones/prestamo/') }}">
                        @csrf
                        <input type="number" value="{{$id}}" name="identificador" hidden/>
                        <div class="form-group">
                            <label for="correousuario">Introduce el correo del usuario</label>
                            <input type="text"
                                class="form-control form-control-sm" id="correousuario" name="correousuario" required/>
                        </div>
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control form-control-sm" id="nombre" name="nombre"
                                placeholder="Introduce primero el correo del usuario" required readonly/>
                        </div>
                        <div class="form-group">
                            <label>Clase</label>
                            <input type="text" class="form-control form-control-sm" id="clase" name="clase"
                                placeholder="Función pendiente de desarrollo" readonly/>
                        </div>
                        <div class="form-group">
                            <label>Fecha de Devolución</label>
                            <input type="date" class="form-control form-control-sm" id="fechadev" name="fechadev"/>
                            <small>Si no se personaliza la fecha de devolución, el valor será <?php echo
                                date('Y-m-d', strtotime(date('Y-m-d') . '+ 15 days')); ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary btn-sm">Enviar consulta</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos del título</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                class="fas fa-expand"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive-lg">
                    @foreach ($parametros as $item)
                        @csrf
                        <input id="id" name="id" value="{{ $item->id }}" hidden />
                        <table class="table table-bordered">
                            <tr>
                                <th>
                                    Título
                                </th>
                                <th>
                                    {{ $item->titulo }}
                                </th>
                            </tr>
                            <tr>
                                <th>Autor</th>
                                <th>{{ $item->autor }}</th>
                            </tr>
                            <tr>
                                <th>Editorial</th>
                                <th>{{ $item->editorial }}</th>
                            </tr>
                            <tr>
                                <th>ISBN</th>
                                <th>{{ $item->isbn }}</th>
                            </tr>
                            <tr>
                                <th>Año de Publicación</th>
                                <th>{{ $item->anopub }}</th>
                            </tr>
                            <tr>
                                <th>Ejemplar</th>
                                <th>{{ $item->ejemplar }}</th>
                            </tr>
                        </table>
                        </form>
                    @endforeach
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $("#correousuario").keyup(function() {
                var name = $("#correousuario").val();
                if (name == "") {
                    $("#display").html("");
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{url('/biblioteca/acciones/consultorio/usuarios')}}",
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            correousuario: name,
                        },
                        success: function(data) {
                            document.getElementById("nombre").value = data[0].name;
                        },
                    });
                }
            });
        });

    </script>
@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
