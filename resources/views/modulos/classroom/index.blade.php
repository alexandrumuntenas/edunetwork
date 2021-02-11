@extends('adminlte::page')

@section('title', 'Classroom < Edunetwork') @section('content_header') <h1>Classroom</h1>
</h1> @stop

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <img class="classbg"
                    src="https://cdn.duoestudios.es/wp-content/uploads/2021/01/monastery-569368_1920.jpg">
                <div class="text-block">
                    <h4>Actividades pendientes</h4>
                    <p>
                    <ul>
                        <li>Presentación Powerpoint UE</li>
                        <li>Actividades Tema 3</li>
                        <li>La narración - Tema 1</li>
                    </ul>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <img class="classbg"
                    src="https://cdn.duoestudios.es/wp-content/uploads/2021/02/pexels-elina-krima-3309968-scaled.jpg">
                <div class="text-block">
                    <h4>Lengua Castellana y Literatura</h4>
                    <p>3F · Profesor Facherito Refacherito</p>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <style>
        .card {
            max-width: 350px;
            min-width: 300px;
            height: auto;
            transition: transform .2s;
        }

        .card:hover {
            box-shadow: 2px 2px 20px #000;
            transform: scale(1.025);
        }

        .text-block {
            position: absolute;
            left: 10px;
            top: 20px;
            color: white;
            padding-left: 20px;
            padding-right: 20px;
        }

        .card h4 {
            font-weight: bold;
        }

        .classbg {
            filter: brightness(0.25);
            height: 197.75px;
            object-fit: cover;
        }

    </style>
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
