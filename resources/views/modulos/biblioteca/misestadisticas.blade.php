@extends('adminlte::page')

@section('title', 'Mi estadísticas')

@section('content_header')
    <h1>Mis Estadísticas</h1>
@stop

@section('content')

<script>
    $(document).ready( function () {
    $('#catalogo').DataTable();
} );
</script>

<div class="row">
          <div class="col-12">
            <div class="card table-responsive">
              <!-- /.card-header -->
              <div class="card-body">
                <div id="catalogo" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                  <thead>
                  <tr role="row"><th class="sorting_desc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" aria-sort="descending">Rendering engine</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Browser</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Platform(s)</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Engine version</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">CSS grade</th></tr>
                  </thead>
                  <tbody>
                  <tr role="row" class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">Webkit</td>
                    <td class="">Safari 3.0</td>
                    <td class="">OSX.4+</td>
                    <td class="">522.1</td>
                    <td class="">A</td>
                  </tr><tr role="row" class="even">
                    <td class="dtr-control sorting_1" tabindex="0">Webkit</td>
                    <td class="">Safari 2.0</td>
                    <td class="">OSX.4+</td>
                    <td class="">419.3</td>
                    <td class="">A</td>
                  </tr><tr role="row" class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">Webkit</td>
                    <td class="">Safari 1.3</td>
                    <td class="">OSX.3</td>
                    <td class="">312.8</td>
                    <td class="">A</td>
                  </tr><tr role="row" class="even">
                    <td class="dtr-control sorting_1" tabindex="0">Webkit</td>
                    <td class="">Safari 1.2</td>
                    <td class="">OSX.3</td>
                    <td class="">125.5</td>
                    <td class="">A</td>
                  </tr><tr role="row" class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">Webkit</td>
                    <td class="">S60</td>
                    <td class="">S60</td>
                    <td class="">413</td>
                    <td class="">A</td>
                  </tr><tr role="row" class="even">
                    <td class="dtr-control sorting_1" tabindex="0">Webkit</td>
                    <td class="">OmniWeb 5.5</td>
                    <td class="">OSX.4+</td>
                    <td class="">420</td>
                    <td class="">A</td>
                  </tr><tr role="row" class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">Webkit</td>
                    <td class="">iPod Touch / iPhone</td>
                    <td class="">iPod</td>
                    <td class="">420.1</td>
                    <td class="">A</td>
                  </tr><tr role="row" class="even">
                    <td class="dtr-control sorting_1" tabindex="0">Trident</td>
                    <td class="">Internet Explorer 7</td>
                    <td class="">Win XP SP2+</td>
                    <td class="">7</td>
                    <td class="">A</td>
                  </tr><tr role="row" class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">Trident</td>
                    <td class="">Internet
                      Explorer 6
                    </td>
                    <td class="">Win 98+</td>
                    <td class="">6</td>
                    <td class="">A</td>
                  </tr><tr role="row" class="even">
                    <td class="dtr-control sorting_1" tabindex="0">Trident</td>
                    <td class="">Internet
                      Explorer 5.5
                    </td>
                    <td class="">Win 95+</td>
                    <td class="">5.5</td>
                    <td class="">A</td>
                  </tr></tbody>
                  <tfoot>
                  <tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1">CSS grade</th></tr>
                  </tfoot>
                </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
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
    <script> console.log('Hi!'); </script>
@stop

@section('footer')
    Edunetwork v1.0 </> by duoestudios
@endsection
