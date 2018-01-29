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
                        SHOW TABULASI
                    </h2>
                </div>
                @include('flash::message')
                <div class="box box-primary">

                    <div class="box-body">

                        <div class="row">

                                    @include('layouts.tabulasi.show_fields')


                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection

@section('extra-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
    
    <script type="text/javascript">
    $(document).ready(function(){
        ajaxChart();
    });

    function ajaxChart(event_id = null){
        $.ajax({
            url: "{{ route('tabulasi.ajax') }}",
            type: "get",
            success: function(data) {
                console.log(data);
                var calon_nama = [];
                var jumlah_suara = [];
                var event_nama = [];

                for(var i in data) {
                    calon_nama.push(data[i].calon_nama);
                    jumlah_suara.push(data[i].jumlah_suara);
                }
                    event_nama.push(data[i].event_nama);
                console.log(event_nama);

                var chartdata = {
                    labels: calon_nama,
                    datasets : [
                        {
                            label: event_nama,
                            backgroundColor: 'rgba(200, 200, 200, 0.75)',
                            borderColor: 'rgba(200, 200, 200, 0.75)',
                            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                            hoverBorderColor: 'rgba(200, 200, 200, 1)',
                            data: jumlah_suara
                        }
                    ]
                };

                var ctx = $("#canvas");

                var barGraph = new Chart(ctx, {
                    type: 'bar',
                    data: chartdata
                });
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
</script>
{!! Charts::assets() !!}
@endsection
