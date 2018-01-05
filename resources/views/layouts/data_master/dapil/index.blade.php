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
                                            <span>DAPIL</span>
                                            <i class="material-icons">autorenew</i>
                                        </h2>

                                        <div class="body">
                                            <a href="{{ route('datamaster.dapil.create') }}" class ="btn btn-primary waves-effect">Buat Data</a>
                                        </div>

                                    </div>

                                    <table id="table-Tabulasi" class="table table-striped">
                                        <thead>
                                            <tr style="background-color: lightblue">
                                                <th>Nama Event</th>
                                                <th>Nama Dapil</th>
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
                                            ajax: '{!! route("datamaster.dapil.datatable") !!}',
                                            columns:
                                            [
                                                {data: 'event'},
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
