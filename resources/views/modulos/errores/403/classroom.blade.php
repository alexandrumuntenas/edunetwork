@extends('adminlte::page')

@section('title', 'Classroom < Edunetwork') @section('content') <h4>La clase solicitada no acepta nuevos alumnos. Volviendo al Inicio...<h4>
<script>$(document).ready(function(){
    setTimeout(function(){window.location = '{{ url('/elearning/') }}'}, 2000);
});</script>
@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
