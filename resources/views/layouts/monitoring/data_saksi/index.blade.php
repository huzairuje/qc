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
                                                    <span>DATA SAKSI</span>
                                                    <i class="material-icons">autorenew</i>
                                                </h2>
                                            </div>
                                        
                                            <table id="tableTabulasi" class="table table-bordered" style="cursor: pointer;">
                                                <tr class="bg-blue" style="color: white;">
                                                    <th rowspan="2">Wilayah</th>
                                                    <th colspan="3">Korsak TPS</th>
                                                    <th colspan="3">Saksi TPS</th>
                                                    <th rowspan="2">Action</th>
                                                </tr>
                                                <tr class="bg-blue" style="color: white;">
                                                    <td>S</td>
                                                    <td>T</td>
                                                    <td>%</td>
                                                    <td>S</td>
                                                    <td>T</td>
                                                    <td>%</td>
                                                </tr>
                                                <tr>
                                                    <td>Cipinang Melayu</td>
                                                    <td>7</td>
                                                    <td>7</td>
                                                    <td>100</td>
                                                    <td>69</td>
                                                    <td>69</td>
                                                    <td>100</td>
                                                    <td>
                                                        <button href="" type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#myModal">Lihat Data</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Halim Perdana Kusuma</td>
                                                    <td>4</td>
                                                    <td>4</td>
                                                    <td>100</td>
                                                    <td>36</td>
                                                    <td>36</td>
                                                    <td>100</td>
                                                    <td>
                                                        <button href="" type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#myModal">Lihat Data</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Kebon Pala</td>
                                                    <td>4</td>
                                                    <td>4</td>
                                                    <td>100</td>
                                                    <td>36</td>
                                                    <td>36</td>
                                                    <td>100</td>
                                                    <td>
                                                        <button href="" type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#myModal">Lihat Data</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Makasar</td>
                                                    <td>4</td>
                                                    <td>4</td>
                                                    <td>100</td>
                                                    <td>36</td>
                                                    <td>36</td>
                                                    <td>100</td>
                                                    <td>
                                                        <button href="" type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#myModal">Lihat Data</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>PinangRanti</td>
                                                    <td>4</td>
                                                    <td>4</td>
                                                    <td>100</td>
                                                    <td>36</td>
                                                    <td>36</td>
                                                    <td>100</td>
                                                    <td>
                                                        <button href="" type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#myModal">Lihat Data</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Total</td>
                                                    <td>32</td>
                                                    <td>29</td>
                                                    <td>100.34</td>
                                                    <td>268</td>
                                                    <td>268</td>
                                                    <td>100</td>
                                                    <td>
                                                        <button href="" type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#myModal">Lihat Data</button>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal" role="dialog">
                                                 @include('layouts.monitoring.data_saksi.modal_data_saksi')
                                            </div>
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

@section('extra-script')

    <script src="{{ asset('bsbmd/js/tables/editable-table.js') }}"></script>
    <script src="{{ asset('bsbmd/js/tables/jquery-datatable.js') }}"></script>
    

@endsection