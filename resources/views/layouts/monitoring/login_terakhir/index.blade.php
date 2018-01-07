@extends('index')

@section('title')

@endsection

@section('extra-css')

@endsection

@section('content')

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-blue">
                    <h2>
                        LOGIN TERAKHIR
                    </h2>
                </div>

                <table id="table-Lastlogin" class="table table-striped">
                    <thead>
                        <tr style="background-color: lightblue">
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nomor Telepon</th>
                            <th>Login Terakhir</th>
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
                        $('#table-Lastlogin').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '{!! route("monitoring.loginterakhir.datatable") !!}',
                            columns:
                                [

                                  {data: 'username'},
                                  {data: 'email'},
                                  {data: 'phone'},
                                  {data: 'last_login'},
                                  {data: 'action'}
                                    ]
                                } );

                        } );

                </script>


            </div>
        </div>
    </div>

@endsection

@section('extra-script')

<script src="{{ asset('bsbmd/js/tables/editable-table.js') }}"></script>
<script src="{{ asset('bsbmd/js/tables/mindmup-editabletable.js') }}"></script>
<script src="{{ asset('bsbmd/js/tables/numeric-input-e.js') }}"></script>
<script src="{{ asset('bsbmd/js/tables/jquery-datatable.js') }}"></script>

@endsection
