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
                                            <span>PARTAI</span>
                                            <i class="material-icons">autorenew</i>
                                        </h2>

                                        <div class="body">
                                            <a href="{{ route('datamaster.partai.create') }}" class ="btn btn-primary waves-effect">Buat Data</a>
                                        </div>

                                    </div>

                                    <table id="table-Partai" class="table table-striped">
                                        <thead>
                                            <tr style="background-color: lightblue">
                                                <th>Nomor Urut</th>
                                                <th>Nama</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                    </table><!-- Modal -->
                                    <script src="https://datatables.yajrabox.com/js/jquery.min.js"></script>
                                    <script src="https://datatables.yajrabox.com/js/bootstrap.min.js"></script>
                                    <script src="https://datatables.yajrabox.com/js/jquery.dataTables.min.js"></script>
                                    <script src="https://datatables.yajrabox.com/js/datatables.bootstrap.js"></script>
                                    <script type="text/javascript">
                                    $(function() {
                                        $('#table-Partai').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            ajax: '/datamaster/partai/getdatatable',

                                            columns:
                                            [
                                                {data: 'nomor'},
                                                {data: 'nama'},
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
