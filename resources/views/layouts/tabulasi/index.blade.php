@extends('index')

@section('title')

@endsection

@section('extra-css')

@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-line">
                                <div class="body">
                                    <div class="row clearfix">
                                            <div class="header">
                                                <h2>
                                                    <span>TABULASI</span>
                                                    <i class="material-icons">autorenew</i>
                                                </h2>
                                                <div class="body">
                                                    <a href="{{ route('tabulasi.create') }}" class ="btn btn-primary waves-effect">Buat Data</a>
                                                </div>

                                            </div>
                                        
                                            <table id="table-Tabulasi" class="table table-striped">
                                                <thead>
                                                    <tr style="background-color: lightblue">
                                                        <th >Dokumen</th>
                                                        <th >Provinsi</th>
                                                        <th >Kota/Kabupaten</th>
                                                        <th >Kecamatan</th>
                                                        <th >Kelurahan</th>
                                                        <th>Data Suara</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>  
                                            <script src="https://datatables.yajrabox.com/js/jquery.min.js"></script>
                                            <script src="https://datatables.yajrabox.com/js/bootstrap.min.js"></script>
                                            <script src="https://datatables.yajrabox.com/js/jquery.dataTables.min.js"></script>
                                            <script src="https://datatables.yajrabox.com/js/datatables.bootstrap.js"></script>
                                            <script type="text/javascript">
                                                $(function() {
                                                    $('#table-Tabulasi').DataTable({
                                                        processing: true,
                                                        serverSide: true,
                                                        ajax: '/tabulasi/getdatatable',
                                                        columns: 
                                                            [
                                                                {data: 'dokumen_id'},
                                                                {data: 'provinsi_id'},
                                                                {data: 'kota_kabupaten_id'},
                                                                {data: 'kecamatan_id'},
                                                                {data: 'kelurahan_id'},
                                                                {data: 'data_suara', render: function (data, type, row, meta) {
                                                                return data == 1 ? 'Ada' : 'Tidak Ada'}},
                                                                {
                                                                    className: "center",
                                                                    defaultContent: '<button href="" class="editor_show">Lihat</button>  <button href="" class="editor_edit">Edit</button>  <button href="" class="editor_remove">Delete</button>'}
                                                                ]
                                                            } );
                                                    // New record
                                                    $('#editor_edit').on( 'click', function (e) {
                                                        e.preventDefault();
                                                 
                                                        editor
                                                            .title( 'Create new record' )
                                                            .buttons( { "label": "Add", "fn": function () { editor.submit() } } )
                                                            .create();
                                                    } );
                                                    $('#example').DataTable( {
                                                        serverSide: true,
                                                        ajax: {
                                                            url: '/tabulasi/create',
                                                            type: 'POST'
                                                        }
                                                    } );
                                                 
                                                    // Edit record
                                                    $('#editor_edit').on( 'click', 'a.editor_edit', function (e) {
                                                        e.preventDefault();
                                                 
                                                        editor
                                                            .title( 'Edit record' )
                                                            .buttons( { "label": "Update", "fn": function () { editor.submit() } } )
                                                            .edit( $(this).closest('tr') );
                                                    } );
                                                 
                                                    // Delete a record
                                                    $('#editor_remove').on( 'click', 'a.editor_remove', function (e) {
                                                        e.preventDefault();
                                                 
                                                        editor
                                                            .title( 'Edit record' )
                                                            .message( "Are you sure you wish to delete this row?" )
                                                            .buttons( { "label": "Delete", "fn": function () { editor.submit() } } )
                                                            .remove( $(this).closest('tr') );
                                                    });
                                                });
                                            </script>                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection
