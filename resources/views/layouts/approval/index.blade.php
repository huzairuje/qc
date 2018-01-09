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
                                            <span>APPROVAL</span>
                                            <i class="material-icons">autorenew</i>
                                        </h2>

                                        <div class="body">
                                            <a href="{{ route('approval.create') }}" class ="btn btn-primary waves-effect">Buat Data</a>
                                        </div>

                                    </div>

                                    <table id="table-Approval" class="table table-striped">
                                        <thead>
                                            <tr style="background-color: lightblue">

                                                <th>Nama Saksi</th>
                                                <th>Event</th>
                                                <th>Provinsi</th>
                                                <th>Kota/Kabupaten</th>
                                                <th>Kecamatan</th>
                                                <th>Kelurahan</th>
                                                <th>TPS</th>
                                                <th>status Approval</th>
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
                                        $('#table-Approval').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            ajax: '{!! route("approval.datatable") !!}',

                                            columns:
                                            [
                                                {data: 'user_id'},
                                                {data: 'event_id'},
                                                {data: 'provinsi'},
                                                {data: 'kota'},
                                                {data: 'kecamatan'},
                                                {data: 'kelurahan'},
                                                {data: 'tps_id'},
                                                {data: 'is_approved'},
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
