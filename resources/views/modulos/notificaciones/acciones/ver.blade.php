@extends('adminlte::page')

@section('title', 'Notificaciones < Biblioteca') @section('content_header') <h1>Notificación #{{$id}}</h1>
</h1> @stop

@section('content')

    <div class="row">
            @foreach (json_decode($datos['json_data'], true) as $dato)
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">

                            <h5>{{ $dato['titulo'] }}</h6>
                                <p>{!! $dato['contenido'] !!}</p>
                                <p><small>{{ $dato['autor'] }}</small></p>
                                @if (Auth::user()->hasRole('director|vicedirector|secretaria|jeafaturadeestudios|it'))
                                    <td class="form-inline">
                                        <a class="btn btn-primary" href="{{ url('/notificaciones/acciones/editar/'.$datos['id']) }}"><i
                                                class="fas fa-edit"></i> Editar</a>
                                        <a class="btn btn-danger" href="{{ url('/notificaciones/acciones/editar/'.$datos['id']) }}"><i
                                                class="fas fa-trash"></i> Eliminar</a>
                                    </td>
                                @endif
                                </tr>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
        @endforeach
    </div>


@stop

@section('css')
@stop

@section('js')
@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
