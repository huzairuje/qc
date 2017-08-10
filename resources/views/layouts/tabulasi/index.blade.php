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
                                                    <th >Dokumen</th>
                                                    <th >Provinsi</th>
                                                    <th >Kota/Kabupaten</th>
                                                    <th >Kecamatan</th>
                                                    <th >Kelurahan</th>
                                                    <th >Action</th>
                                                </tr>
                                                    @foreach($tabulasis as $tabulasi )
                                                <tr>
                                                    <td>{{ ($tabulasi->dokumen ? $tabulasi->dokumen->tipe_dokumen:'-') }}</td>
                                                    <td>{{ ($tabulasi->provinsi ? $tabulasi->provinsi->nama_provinsi:'-') }}</td>
                                                    <td>{{ ($tabulasi->kota_kabupaten ? $tabulasi->kota_kabupaten->nama:'-') }}</td>
                                                    <td>{{ ($tabulasi->kecamatan ? $tabulasi->kecamatan->nama:'-' ) }}</td>
                                                    <td>{{ ($tabulasi->kelurahan ? $tabulasi->kelurahan->nama:'-') }}</td>
                                                    <td>
                                                        <button id="showDialog" class="btn btn-warning btn-xs btn-detail open-modal" data-toggle="modal" data-target="#modalShow" data-id="{{$tabulasi->id}}">Lihat</button>

                                                        <button class="btn btn-warning btn-xs btn-detail open-modal" data-toggle="modal" data-target="#modalEdit" value="{{$tabulasi->id}}">Edit</button>


                                                        <button class="btn btn-danger btn-xs btn-delete open-modal" data-toggle="modal" data-target="#modalDelete" value="{{$tabulasi->id}}">Delete</button>

                                                        
                                                    </td>
                                                </tr>
                                               @endforeach

                                            </table>

                                            <div class="col-md-12">{{ $tabulasis->links() }} </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            console.log("hahaha")
            $("#showDialog").click(function(){
                 var myBookId = $(this).data('id');
                 $(".modal-body #documentID").html( myBookId );
                 console.log(myBookId);
            });
        })
    </script>                
@endsection
