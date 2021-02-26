@extends('adminlte::page')

@section('title', 'Editar < Notificaciones') @section('content_header') <h1>Editando...</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    @foreach ($datos as $datos)
                        <?php $id = $datos['id']; ?>
                        @foreach (json_decode($datos['json_data'], true) as $datos)
                            <form method="POST" action="{{ url('notificaciones/acciones/actualizar/') }}">
                                @csrf
                                <input id="id" name="id" value="{{$id}}"hidden/>
                                <div class="form-group">
                                    <label for="titulo">Título de la notificación</label>
                                    <input id="titulo" name="titulo" class="form-control form-control-sm" type="text"
                                        maxlength="255" value="{{ $datos['titulo'] }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="autor">Autor</label>
                                    <input id="autor" name="autor" class="form-control form-control-sm" type="text"
                                        maxlength="255" value="{{ $datos['autor'] }}" readonly />
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Contenido</label>
                                    <textarea type="text" id="contenido" name="contenido"
                                        class="md-textarea form-control" maxlength="1024" value=""
                                        required>{{ $datos['contenido'] }}</textarea>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Actualizar" />
                                <a href="{{url('notificaciones/v/'.$id)}}" class="btn btn-danger">Cancelar</a>
                            </form>
                        @endforeach
                    @endforeach

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
            CKEDITOR.replace('contenido');

        });

    </script>
@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
