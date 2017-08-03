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
                        HASIL QUICK REAL COUNT
                    </h2>
                </div>
                
                <div class="box box-primary">

                    <div class="box-body">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="body">
                                            <div class="row clearfix">
                                                <div class="card">
                                                <table id="tableTabulasi" class="table table-bordered" style="cursor: pointer;">
                                                    <thead>
                                                        <tr>
                                                            <th class="tg-yw4l">TPS</th>
                                                            @for ($x = 1; $x <= 6; $x++)
                                                                <th class="tg-yw4l">Pasangan Calon {{ $x }}</th>
                                                            @endfor
                                                            <th class="tg-yw4l">Suara Sah</th>
                                                            <th class="tg-yw4l">Suara Tidak Sah</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for ($y = 1; $y <= 20; $y++)
                                                          <tr>
                                                            @for ($x = 1; $x <= 9; $x++)
                                                                <td class="tg-yw4l" tabindex="1"></td>
                                                            @endfor
                                                          </tr>
                                                        @endfor
                                                      
                                                    </tbody>

                                                </table>
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
    </div>
                
@endsection

@section('extra-script')

    <script src="{{ asset('bsbmd/js/tables/editable-table.js') }}"></script>
    <script src="{{ asset('bsbmd/js/tables/jquery-datatable.js') }}"></script>
    

@endsection