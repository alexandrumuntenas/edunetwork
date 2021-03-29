@extends('adminlte::page')

@section('title', 'Classroom < Edunetwork') @section('content')<div class="h-100"><div class="row justify-content-center">
    @include('modulos.classroom.componentes.cabecera')

    <div class="col" id="class_sidebar">
        @include('modulos.classroom.componentes.sidebar')
    </div>
    <div class="col" style="max-width:712px">
        @foreach (json_decode($data->activity_data, true) as $activity_data)
            @if ($type === 'material')
                <form class="card" action="{{ url("/elearning/c/$hash/trabajodeclase/e") }}" method="POST">
                    <div class="card-header" id="class_title">
                        <span class="card-title float-left">Editar material</span><span class="float-right"><button
                                class="btn btn-primary btn-sm" type="submit">Actualizar</button></span>
                    </div>
                    <div class="card-body">
                        @csrf
                        <input id="id" name="id" hidden value="{{$data->id}}" readonly/>
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input class="form-control" name="titulo" id="titulo" value="{{$activity_data['titulo']}}" required />
                        </div>
                        <div class="form-group">
                            <label for="contenido">Descripción</label>
                            <textarea class="form-control" id="contenido" name="contenido">{{$activity_data['contenido']}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="tema">Tema</label>
                            <select class="form-control" name="tema" id="tema">
                                <option value="0">Sin tema</option>
                                @foreach ($temas as $tema)
                                    <option value="{{ $tema->id }}">{{ $tema->topic_data }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="card-title float-left">Editar material</span><span class="float-right"><button
                                class="btn btn-primary btn-sm" type="submit">Actualizar</button></span>
                    </div>
                </form>
            @endif
        @endforeach
    </div>

    </div>
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
