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
                                            <span>Calon</span>
                                            <i class="material-icons">autorenew</i>
                                        </h2>

                                        <div class="body">
                                            <a href="{{ route('datamaster.calon.create') }}" class ="btn btn-primary waves-effect">Buat Data</a>
                                        </div>

                                    </div>

                                    <table id="table-Calon" class="table table-striped">
                                        <thead>
                                            <tr style="background-color: lightblue">

                                                <th>Event</th>
                                                <th>Nomor Urut</th>
                                                <th>Nama Calon</th>
                                                <th>Nama Wakil Calon</th>
                                                <th>Foto Calon</th>
                                                <th>Foto Wakil Calon</th>
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
                                        $('#table-Calon').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            ajax: '{!! route("datamaster.calon.datatable") !!}',
                                            columns:
                                            [
                                                {data: 'event'},
                                                {data: 'nomor'},
                                                {data: 'nama'},
                                                {data: 'nama_wakil'},
                                                {data: 'foto'},
                                                {data: 'foto_wakil'},
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
