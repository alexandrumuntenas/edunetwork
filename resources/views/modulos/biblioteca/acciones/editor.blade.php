@extends('adminlte::page')

@section('title', 'Editar < Biblioteca') @section('content_header') <h1>Editando...</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive-lg">
                    @foreach ($parametros as $item)
                        <form method="POST" action="{{ url('biblioteca/acciones/actualizar/') }}">
                            @csrf
                            <input id="id" name="id" value="{{ $item->id }}" hidden />
                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input id="titulo" value="{{ $item->titulo }}" name="titulo" type="text"
                                    required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="autor">Autor</label>
                                <input id="autor" value="{{ $item->autor }}" name="autor" type="text"
                                    required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="editorial">Editorial</label>
                                <input id="editorial" value="{{ $item->editorial }}" name="editorial" type="text"
                                    required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="isbn">ISBN</label>
                                <input id="isbn" value="{{ $item->isbn }}" name="isbn" type="text" required="required"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="anopub">Año de Publicación</label>
                                <input id="anopub" value="{{ $item->anopub }}" name="anopub" type="text"
                                    required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="ejemplar">Ejemplar</label>
                                <input id="ejemplar" value="{{ $item->ejemplar }}" name="ejemplar" type="text"
                                    required="required" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea id="descripcion" name="descripcion" required="required"
                                    class="form-control">{{ $item->descripcion }}</textarea>
                            </div>
                            <div class="form-group">
                                <button name="submit" type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
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
