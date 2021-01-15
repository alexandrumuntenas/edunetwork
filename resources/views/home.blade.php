@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Inicio</h1>
@stop

@section('content')
    @include('componentes.cards.home_cards_default')
    <h4>Biblioteca</h4>
    @include('componentes.cards.home_cards_biblio')

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

@section('footer')
    Edunetwork v1.0 </> by duoestudios
@endsection
