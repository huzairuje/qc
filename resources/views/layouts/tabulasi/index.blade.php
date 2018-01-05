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
                                    @include('flash::message')
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
                                                        <th>Dokumen</th>
                                                        <th>Provinsi</th>
                                                        <th>Kota/Kabupaten</th>
                                                        <th>Kecamatan</th>
                                                        <th>Kelurahan</th>
                                                        <th>Data Suara</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table><!-- Modal -->
                                            <script src="https://datatables.yajrabox.com/js/jquery.min.js"></script>
                                            <script src="https://datatables.yajrabox.com/js/bootstrap.min.js"></script>
                                            <script src="https://datatables.yajrabox.com/js/jquery.dataTables.min.js"></script>
                                            <script src="https://datatables.yajrabox.com/js/datatables.bootstrap.js"></script>
                                            <script type="text/javascript">
                                                $(function() {
                                                    $('#table-Tabulasi').DataTable({
                                                        processing: true,
                                                        serverSide: true,
                                                        ajax: '{!! route("tabulasi.datatable") !!}',
                                                        columns:
                                                            [

                                                                {data: 'dokumen'},
                                                                {data: 'provinsi_id'},
                                                                {data: 'kota_id'},
                                                                {data: 'kecamatan_id'},
                                                                {data: 'kelurahan_id'},
                                                                {data: 'data_suara', render: function (data, type, row, meta) {
                                                                return data == 1 ? 'Ada' : 'Tidak Ada'}},
                                                                {data: 'action'}
                                                                ]
                                                            } );

                                                    } );

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
