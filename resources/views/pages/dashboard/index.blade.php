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
                              <h2>{{ $participation }}<sup>%</sup></h2>
                              <p class="font-14">Participación</p>
                           </div>
                           <h3 class="card-subtitle mb-2">Condiciones inseguras</h3>
                           <p class="font-16">{{ date('m-Y') }}</p>
                        </div>
                        <div class="increase">
                           <div class="card-title d-flex align-items-end mb-2">
                              <h2>{{ $participationCC }}<sup>%</sup></h2>
                              <p class="font-14">Participación</p>
                           </div>
                           <h3 class="card-subtitle mb-2">Cuidado del Compañero</h3>
                           <p class="font-16">{{ date('m-Y') }}</p>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- End Card -->
            </div>
                <!--CRITICA -->
            <div class="col-xl-2 col-md-4 col-sm-6">
               <!-- Card -->
               <div class="card area-chart-box mb-30">
                  <div class="card-body">
                     <div class="d-flex justify-content-between">
                        <div class="">
                           <h4 class="mb-1">Prioridad CRITICA</h4>
                           <p class="font-14 @if($porcent_critica >= 50) c3 @else soft-pink @endif">COMPLETADAS</p>
                        </div>
                        <div class="">
                           <h2>{{ $porcent_critica }}<sup>%</sup></h2>
                        </div>
                     </div>
                  </div>
                  <div id="apex_area-chart" class="chart"></div>
               </div>
               <!-- End Card -->
            </div>
                <!--ALATA -->
            <div class="col-xl-2 col-md-4 col-sm-6">
               <!-- Card -->
               <div class="card area-chart-box mb-30">
                  <div class="card-body">
                     <div class="d-flex justify-content-between">
                        <div class="">
                           <h4 class="mb-1">Prioridad ALTA</h4>
                           <p class="font-14 @if($porcent_alta >= 50) c3 @else soft-pink @endif">COMPLETADAS</p>
                        </div>
                        <div class="">
                           <h2>{{ $porcent_alta }}<sup>%</sup></h2>
                        </div>
                     </div>
                  </div>
                  <div id="apex_area2-chart" class="chart"></div>
               </div>
               <!-- End Card -->
            </div>
               <!--MEDIA -->
            <div class="col-xl-2 col-md-4 col-sm-6">
               <!-- Card -->
               <div class="card area-chart-box mb-30">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="">
                           <h4 class="mb-1">Prioridad MEDIA</h4>
                           <p class="font-14 @if($porcent_media >= 50) c3 @else soft-pink @endif">COMPLETADAS</p>
                        </div>
                        <div class="">
                           <h2>{{ $porcent_media }}<sup>%</sup></h2>
                        </div>
                     </div>
                  </div>
                  <div id="apex_area3-chart" class="chart"></div>
               </div>
               <!-- End Card -->
            </div>
               <!--BAJA -->
            <div class="col-xl-2 col-md-4 col-sm-6">
               <!-- Card -->
               <div class="card area-chart-box mb-30">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="">
                           <h4 class="mb-1">Prioridad BAJA</h4>
                           <p class="font-14 @if($porcent_baja >= 50) c3 @else soft-pink @endif">COMPLETADAS</p>
                        </div>
                        <div class="">
                           <h2>{{ $porcent_baja }}<sup>%</sup></h2>
                        </div>
                     </div>
                  </div>
                  <div id="apex_area4-chart" class="chart"></div>
               </div>
               <!-- End Card -->
            </div>
        </div>
        @include('pages.dashboard.components.tablaCulturaDeSeguridadDia')

    </div>
</div>
@endsection
@section('footer')

@endsection
@section('js')
<!-- ======= BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
<script src="{{ asset('assets/plugins/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/plugins/apex/custom-apexcharts.js') }}"></script>
<a class="ruta" href="{{ route('dashboardCharts') }}"></a>
<script>
   function chartschange(params) {

      $('#test2').hide(0);
      $('#test3').hide(0);
      $('#test1').show(0);
   }
   function chartschange1(params) {
      $('#test1').hide(0);
      $('#test3').hide(0);
      $('#test2').show(0);
   }
   function chartschange2(params) {
      $('#test1').hide(0);
      $('#test2').hide(0);
      $('#test3').show(0);
   }

   function chartschangeExterno(params) {
   $('#testExterno2').hide(0);
   $('#testExterno3').hide(0);
   $('#testExterno1').show(0);
   }
   function chartschangeExterno1(params) {
   $('#testExterno1').hide(0);
   $('#testExterno3').hide(0);
   $('#testExterno2').show(0);
   }
   function chartschangeExterno2(params) {
   $('#testExterno1').hide(0);
   $('#testExterno2').hide(0);
   $('#testExterno3').show(0);
   }

   $(function() {

   });
</script>
<!-- ======= End BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
@endsection
