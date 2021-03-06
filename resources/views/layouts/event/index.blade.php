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
                                            <span>DATA EVENT</span>
                                            <i class="material-icons">autorenew</i>
                                        </h2>

                                        @if( Sentinel::getUser()->roles->first()->slug == 'admin-pusat' )
                                        <div class="body">
                                            <a href="{{ route('event.create') }}" class ="btn btn-primary waves-effect">Buat Data</a>
                                        </div>
                                        @endif


                                    </div>

                                    <table id="table-Event" class="table table-striped">
                                        <thead>
                                            <tr style="background-color: lightblue">
                                                <!-- <th>No</th> -->
                                                <th>Tahun Event</th>
                                                <th>Expired Event</th>
                                                <th>Nama Event</th>
                                                <th>Jenis Event</th>
                                                <th>Tingkat Event</th>
                                                <th>Lokasi</th>
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
                                        $('#table-Event').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            ajax: '{!! route("event.datatable") !!}',
                                            columns:
                                            [
                                                {data: 'tahun', name: 'tahun'},
                                                {data: 'expired', name: 'expired'},
                                                {data: 'nama', name: 'nama'},
                                                {data: 'jenis', name: 'jenis'},
                                                {data: 'tingkat', name: 'tingkat'},
                                                {data: 'lokasi', name: 'lokasi'},
                                                {data: 'action', name: 'action'}
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
