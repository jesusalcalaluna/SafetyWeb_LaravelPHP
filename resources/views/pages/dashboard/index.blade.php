@extends('layouts.app_dashboard')

@section('navbar')
    @include('globals.dashboard.navbar')
    @include('globals.dashboard.sidebar')
@endsection
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-md-8">
                <!-- Card -->
                <div class="card mb-30">
                   <div class="card-body">
                      <div class="d-flex align-items-center justify-content-between">
                         <div class="increase">
                            <div class="card-title d-flex align-items-end mb-2">
                               <h2>86<sup>%</sup></h2>
                               <p class="font-14">Increased</p>
                            </div>
                            <h3 class="card-subtitle mb-2">Congratulation!</h3>
                            <p class="font-16">You've finished all of your tasks for this week.</p>
                         </div>
                         <div class="congratulation-img">
                            <img src="assets/img/media/congratulation-img.png" alt="">
                         </div>
                      </div>
                   </div>
                </div>
                <!-- End Card -->
             </div>

             <div class="col-xl-2 col-md-4 col-sm-6">
                <!-- Card -->
                <div class="card area-chart-box mb-30">
                   <div class="card-body">
                      <div class="d-flex justify-content-between">
                         <div class="">
                            <h4 class="mb-1">Income</h4>
                            <p class="font-14 c3">Increase in Average</p>
                         </div>
                         <div class="">
                            <h2>50<sup>%</sup></h2>
                         </div>
                      </div>
                   </div>
                   <div id="apex_area-chart" class="chart"></div>
                </div>
                <!-- End Card -->
             </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <!-- Card -->
                <div class="card mb-30">
                      <div class="card-body pb-1">
                      <h4 class="font-20">Participacion Condiciones Inseguras</h4>
                   </div>
                   <div class="p-sm-3">
                      <div id="participacionCondiocionesInsegurasParticipacion" class="chart"></div>
                   </div>
                </div>
                <!-- End Card -->
             </div>
            <div class="col-lg-6">
                <!-- Card -->
                <div class="card mb-30">
                      <div class="card-body pb-1">
                      <h4 class="font-20">Participacion Cuidado del Compañero</h4>
                   </div>
                   <div class="p-sm-3">
                      <div id="participacionCuidadoCompañero" class="chart"></div>
                   </div>
                </div>
                <!-- End Card -->
             </div>
        </div>        
    </div>
</div>
@endsection
@section('footer')
    
@endsection
@section('js')
   <!-- ======= BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
   <script src="assets/plugins/apex/apexcharts.min.js"></script>
   <script>
       //Donut Chart
        var donut_options = {
            series: [44, 55],
            labels: ['Si', 'No'],
            chart: {
                width: '100%',
                height: 380,
                type: 'donut',
                foreColor: '#fff',
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'gradient',
            },
            stroke: {
                show: true,
                width: 1,
                colors: ['transparent']
            },
            legend: {
                formatter: function (val, opts) {
                    return val + " - " + opts.w.globals.series[opts.seriesIndex]
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: '100%'
                    }
                }
            }]
        };

    var donut_chart = new ApexCharts(document.querySelector("#participacionCondiocionesInsegurasParticipacion"), donut_options);
    donut_chart.render();
    
    var donut_options = {
            series: [44, 55],
            labels: ['Si', 'No'],
            chart: {
                width: '100%',
                height: 380,
                type: 'donut',
                foreColor: '#fff',
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'gradient',
            },
            stroke: {
                show: true,
                width: 1,
                colors: ['transparent']
            },
            legend: {
                formatter: function (val, opts) {
                    return val + " - " + opts.w.globals.series[opts.seriesIndex]
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: '100%'
                    }
                }
            }]
        };

    var donut_chart = new ApexCharts(document.querySelector("#participacionCuidadoCompañero"), donut_options);
    donut_chart.render();
   </script>
   <!-- ======= End BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
@endsection