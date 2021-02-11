@extends('adminlte::page')
@section('plugins.Summernote', true)

@section('title', 'Editar < Notificaciones') @section('content_header') <h1>Editando...</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    @php
$config = [
    "height" => "100",
    "toolbar" => [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']],
    ],
]
@endphp
<x-adminlte-text-editor name="teConfig" label="WYSIWYG Editor" label-class="text-danger"
    size="sm" placeholder="Write some text..." :config="$config"/>
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
            $('#prestamos').DataTable();
        });

    </script>
@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
