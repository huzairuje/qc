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
                                        <div class="card">
                                            <div class="header">
                                                <h2>
                                                    <span>REKAPITULASI</span>
                                                    <i class="material-icons">autorenew</i>
                                                </h2>
                                            </div>
                                        
                                            <table id="tableTabulasi" class="table table-bordered" style="cursor: pointer;">
                                                <tr class="bg-blue" style="color: white;">
                                                    <th rowspan="2">Wilayah</th>
                                                    <th colspan="4">Presensi Korsak TPS</th>
                                                    <th colspan="4">Presensi Saksi TPS</th>
                                                    <th rowspan="2">Action</th>
                                                </tr>
                                                <tr class="bg-blue" style="color: white;">
                                                    <td>Hadir</td>
                                                    <td>%</td>
                                                    <td>Belum Hadir</td>
                                                    <td>%</td>
                                                    <td>Hadir</td>
                                                    <td>%</td>
                                                    <td>Belum Hadir</td>
                                                    <td>%</td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>MAKASAR</td>
                                                    <td>25</td>
                                                    <td>78</td>
                                                    <td>7</td>
                                                    <td>21.88</td>
                                                    <td>216</td>
                                                    <td>80.60</td>
                                                    <td>52</td>
                                                    <td>19.40</td>
                                                    <td>
                                                        <button href="" type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#myModal">Lihat Data</button>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal" role="dialog">
                                                 @include('layouts.monitoring.presensi_petugas.modal_presensi_petugas')
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
    </div>
                
@endsection

@section('extra-script')

    <script src="{{ asset('bsbmd/js/tables/editable-table.js') }}"></script>
    <script src="{{ asset('bsbmd/js/tables/jquery-datatable.js') }}"></script>
    

@endsection