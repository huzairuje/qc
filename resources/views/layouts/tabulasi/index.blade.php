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
                                                    {{ Form::button('Buat Data', array('class' => 'btn btn-primary waves-effect', 'data-toggle' => 'modal', 'data-target' => '#modalCreate')) }}
                                                </div>

                                            </div>
                                        
                                            <table id="tableTabulasi" class="table table-bordered" style="cursor: pointer;">
                                                <tr class="bg-blue" style="color: white;">
                                                    <th >No</th>
                                                    <th >Dokumen</th>
                                                    <th >Provinsi</th>
                                                    <th >Kota/Kabupaten</th>
                                                    <th >Kecamatan</th>
                                                    <th >Kelurahan</th>
                                                    <th >Action</th>
                                                </tr>
                                                <?php $i = 0 ?>
                                                    @foreach($tabulasis as $tabulasi )
                                                    <?php $i++ ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $tabulasi->dokumen_id}}</td>
                                                    <td>{{ $tabulasi->provinsi_id }}</td>
                                                    <td>{{ $tabulasi->kota_kabupaten_id }}</td>
                                                    <td>{{ $tabulasi->kecamatan_id }}</td>
                                                    <td>{{ $tabulasi->kelurahan_id }} KIDUL</td>
                                                    <td>
                                                        <button class="btn btn-warning btn-xs btn-detail open-modal" data-toggle="modal" data-target="#modalShow" value="{{$tabulasi->id}}">Lihat</button>

                                                        <button class="btn btn-warning btn-xs btn-detail open-modal" data-toggle="modal" data-target="#modalEdit" value="{{$tabulasi->id}}">Edit</button>


                                                        <button class="btn btn-danger btn-xs btn-delete open-modal" data-toggle="modal" data-target="#modalDelete" value="{{$tabulasi->id}}">Delete</button>

                                                    </td>
                                                </tr>
                                               @endforeach
                                            </table>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modalCreate" role="dialog">
                                                @include('layouts.tabulasi.modal_create')
                                            </div>
                                            <div class="modal fade" id="modalEdit" role="dialog">
                                                @include('layouts.tabulasi.modal_edit')
                                            </div>
                                            <div class="modal fade" id="modalShow" role="dialog">
                                                @include('layouts.tabulasi.modal_show')
                                            </div>
                                            <div class="modal fade" id="modalDelete" role="dialog">
                                                @include('layouts.tabulasi.modal_show')
                                            </div>
                                            <!--End Modal -->
                                            
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

@section('footer-script')


@endsection

