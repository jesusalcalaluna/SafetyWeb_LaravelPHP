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
                           <h3 class="card-subtitle mb-2">{{ date('d-m-Y') }}</h3>
                           <p class="font-16">Condiciones inseguras registradas.</p>
                        </div>
                        <div class="congratulation-img">
                           <img src="assets/img/media/congratulation-img.png" alt="">
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

        <div class="row">
            <div class="col-xl-5">
                <!-- Card -->
                <div class="card mb-30">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="">
                                <h4 class="mb-2">Participacion Interna</h4>
                            </div>
                            <div class="d-flex align-items-center">
                                <!-- Dropdown Button -->
                                <div class="dropdown-button">
                                    <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                        <div class="menu-icon style--two mr-0">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a onclick="chartschange(this);">Hoy</a>
                                        <a onclick="chartschange1(this);">Mes</a>
                                        <a onclick="chartschange2(this);">Año</a>
                                    </div>
                                </div>
                                <!-- End Dropdown Button -->
                            </div>
                        
                        
                        </div>
                        <div id="test1">Hoy<div id="apex_bar-chart2"  class="chart"></div></div>
                        <div id="test2" style="display: none;">Mes<div id="apex_bar-chart1"  class="chart"></div></div>
                        <div id="test3" style="display: none;">Año<div id="apex_bar-chart" class="chart"></div></div>
                        
                        
                        
                    </div>
                </div>
                <!-- End Card -->
            </div>

            <div class="col-xl-5">
                <!-- Card -->
                <div class="card mb-30">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="">
                                <h4 class="mb-2">Participacion Externa</h4>
                            </div>
                            <div class="d-flex align-items-center">
                                <!-- Dropdown Button -->
                                <div class="dropdown-button">
                                    <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                        <div class="menu-icon style--two mr-0">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a onclick="chartschangeExterno(this);">Hoy</a>
                                        <a onclick="chartschangeExterno1(this);">Mes</a>
                                        <a onclick="chartschangeExterno2(this);">Año</a>
                                    </div>
                                </div>
                                <!-- End Dropdown Button -->
                            </div>
                        
                        
                        </div>
                        <div id="testExterno1">Hoy<div id="apex_bar-chartExterno2"  class="chart"></div></div>
                        <div id="testExterno2" style="display: none;">Mes<div id="apex_bar-chartExterno1"  class="chart"></div></div>
                        <div id="testExterno3" style="display: none;">Año<div id="apex_bar-chartExterno" class="chart"></div></div>
                        
                        
                        
                    </div>
                </div>
                <!-- End Card -->
            </div>
            <div class="col-xl-6 col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <!-- Card -->
                        <div class="card mb-30">
                        <div class="card-body d-flex justify-content-between mb-n72">
                            <div class="position-relative index-9">
                                <h4 class="mb-1">Website Analytics</h4>
                                <p class="font-14">Check out each column for more details</p>
                            </div>

                            <!-- Dropdown Button -->
                            <div class="dropdown-button">
                                <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                    <div class="menu-icon style--two mr-0">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#">Daily</a>
                                    <a href="#">Sort By</a>
                                    <a href="#">Monthly</a>
                                </div>
                            </div>
                            <!-- End Dropdown Button -->

                        </div>
                        <div id="apex_column-chart" class="chart"></div>
                        </div>
                        <!-- End Card -->
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <!-- Card -->
                        <div class="card mb-30 progress_1">
                        <div class="card-body">
                            <h4 class="progress-title">Registrations</h4>

                            <div class="ProgressBar-wrap position-relative mb-4">
                                <div class="ProgressBar ProgressBar_1" data-progress="75">
                                    <svg class="ProgressBar-contentCircle" viewBox="0 0 200 200">
                                    <!-- on défini le l'angle et le centre de rotation du cercle -->
                                    <circle transform="rotate(135, 100, 100)" class="ProgressBar-background" cx="100" cy="100" r="8" />
                                    <circle transform="rotate(135, 100, 100)" class="ProgressBar-circle" cx="100" cy="100" r="85" />
                                    </svg>
                                    <span class="ProgressBar-percentage--text">
                                    Increase
                                    </span>
                                    <span class="ProgressBar-percentage ProgressBar-percentage--count"></span>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap mb-2 progress-info">
                                <div>Users</div>
                                <div><img src="assets/img/svg/caret-up.svg" alt="" class="svg"> 2.6k</div>
                                <div><img src="assets/img/svg/caret-down.svg" alt="" class="svg">568</div>
                            </div>

                            
                            <div class="d-flex flex-wrap progress-info">
                                <div>Disabled</div>
                                <div><img src="assets/img/svg/caret-up.svg" alt="" class="svg">1.26k</div>
                                <div><img src="assets/img/svg/caret-down.svg" alt="" class="svg">25</div>
                            </div>
                        </div>
                        </div>
                        <!-- End Card -->
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <!-- Card -->
                        <div class="card mb-30 progress_2">
                        <div class="card-body">
                            <h4 class="progress-title">Sales</h4>

                            <div class="ProgressBar-wrap position-relative mb-4">
                                <div class="ProgressBar ProgressBar_2" data-progress="35">
                                    <svg class="ProgressBar-contentCircle" viewBox="0 0 200 200">
                                    <!-- on défini le l'angle et le centre de rotation du cercle -->
                                    <circle transform="rotate(135, 100, 100)" class="ProgressBar-background" cx="100" cy="100" r="85" />
                                    <circle transform="rotate(135, 100, 100)" class="ProgressBar-circle" cx="100" cy="100" r="85" />
                                    </svg>
                                    <span class="ProgressBar-percentage--text">Increase</span>
                                    <span class="ProgressBar-percentage ProgressBar-percentage--count"></span>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap mb-2 progress-info">
                                <div>Net Profit</div>
                                <div><img src="assets/img/svg/caret-up.svg" alt="" class="svg"> 268k</div>
                                <div><img src="assets/img/svg/caret-down.svg" alt="" class="svg">89k</div>
                            </div>

                            
                            <div class="d-flex flex-wrap progress-info">
                                <div>Expenses</div>
                                <div><img src="assets/img/svg/caret-up.svg" alt="" class="svg">1.26k</div>
                                <div><img src="assets/img/svg/caret-down.svg" alt="" class="svg">1.5k</div>
                            </div>
                        </div>
                        </div>
                        <!-- End Card -->
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <!-- Card -->
                        <div class="card mb-30 progress_3 mr-0">
                        <div class="card-body">
                            <h4 class="progress-title">Company Growth</h4>

                            <div class="ProgressBar-wrap position-relative mb-4">
                                <div class="ProgressBar ProgressBar_3" data-progress="70">
                                    <svg class="ProgressBar-contentCircle" viewBox="0 0 200 200">
                                    <!-- on défini le l'angle et le centre de rotation du cercle -->
                                    <circle transform="rotate(135, 100, 100)" class="ProgressBar-background" cx="100" cy="100" r="85" stroke-width="20" />
                                    <circle transform="rotate(135, 100, 100)" class="ProgressBar-circle" cx="100" cy="100" r="85" stroke-width="20" />
                                    </svg>
                                    <span class="ProgressBar-percentage--text"> Increase </span>
                                    <span class="ProgressBar-percentage ProgressBar-percentage--count"></span>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap mb-2 progress-info">
                                <div>Employee</div>
                                <div><img src="assets/img/svg/caret-up.svg" alt="" class="svg">15</div>
                                <div><img src="assets/img/svg/caret-down.svg" alt="" class="svg">3</div>
                            </div>

                            
                            <div class="d-flex flex-wrap progress-info">
                                <div>Production</div>
                                <div><img src="assets/img/svg/caret-up.svg" alt="" class="svg">1.26k</div>
                                <div><img src="assets/img/svg/caret-down.svg" alt="" class="svg">1.2k</div>
                            </div>
                        </div>
                        </div>
                        <!-- End Card -->
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- Card -->
                        <div class="card mb-30">
                        <div class="card-body">
                            <div id="apex_line-chart" class="chart"></div>

                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div class="">
                                    <h4 class="mb-1">Website Analytics</h4>
                                    <p class="font-14">Check out each column for more details</p>
                                </div>

                                <div class="dropdown-button">
                                    <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                    <div class="menu-icon justify-content-end pb-1 style--two mr-0">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#">Daily</a>
                                    <a href="#">Sort By</a>
                                    <a href="#">Monthly</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!-- End Card -->
                    </div>

                    <div class="col-sm-6">
                        <!-- Card -->
                        <div class="card mb-30">
                        <div class="card-body">
                            <div id="apex_line2-chart" class="chart"></div>

                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div class="">
                                    <h4 class="mb-1">Company Growth</h4>
                                    <p class="font-14">Company is growing 20% in average</p>
                                </div>

                                <div class="dropdown-button">
                                    <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                    <div class="menu-icon justify-content-end pb-1 style--two mr-0">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#">Daily</a>
                                    <a href="#">Sort By</a>
                                    <a href="#">Monthly</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!-- End Card -->
                    </div>

                    <div class="col-12">
                        <!-- Card -->
                        <div class="card todo-list mb-30">
                        <div class="card-body p-0">
                            <!-- Todo Single -->
                            <div class="single-row border-bottom pt-3 pb-2">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="">
                                    <h4 class="card-title">Today To Do List</h4>
                                    <p class="card-text font-14 bold">Saturday, <br />
                                        12 October 2019</p>
                                    </div>

                                    <div class="d-flex align-items-center">
                                    <a href="pages/apps/todolist/add-new.html" class="btn-circle">
                                        <img src="assets/img/svg/plus_white.svg" alt="" class="svg">
                                    </a>

                                    <div class="dropdown-button">
                                        <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                            <div class="menu-icon style--two justify-content-center mr-0">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#">Daily</a>
                                            <a href="#">Sort By</a>
                                            <a href="#">Monthly</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Todo Single -->
                            
                            <!-- Todo Single -->
                            <div class="single-row border-bottom pt-3 pb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex position-relative">
                                    <!-- Custom Checkbox -->
                                    <label class="custom-checkbox">
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                    <!-- End Custom Checkbox -->

                                    <!-- Todo Text -->
                                    <div class="todo-text line-through">
                                        <p class="card-text mb-1">For detracty charmed add talking age. Shy resolution instrument unreserved man few.</p>
                                        <p class="text-warning font-12 mb-0">Urgent Not Important</p>
                                    </div>
                                    <!-- End Todo Text -->
                                    </div>

                                    <div class="d-flex">
                                    <!-- Assign To -->
                                    <div class="assign_to">
                                        <img src="assets/img/svg/Info.svg" alt="" class="svg mr-2 mb-1">
                                        <div class="assign-content">
                                            <div class="font-12 text-warning">Back-End</div>
                                            <img src="assets/img/avatar/info-avatar.png" alt="" class="assign-avatar">
                                        </div>
                                    </div>
                                    <!-- End Assign To -->

                                    <!-- Drag Icon -->
                                    <img src="assets/img/svg/dragicon.svg" alt="" class="svg">
                                    <!-- End Drag Icon -->

                                    <!-- Dropdown Button -->
                                    <div class="dropdown-button">
                                        <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                            <div class="menu-icon style--two w-14 mr-0">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#">Daily</a>
                                            <a href="#">Sort By</a>
                                            <a href="#">Monthly</a>
                                        </div>
                                    </div>
                                    <!-- End Dropdown Button -->
                                    </div>
                                </div>
                            </div>
                            <!-- End Todo Single -->

                            <!-- Todo Single -->
                            <div class="single-row border-bottom pt-3 pb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex position-relative">
                                    <!-- Custom Checkbox -->
                                    <label class="custom-checkbox">
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <!-- End Custom Checkbox -->

                                    <!-- Todo Text -->
                                    <div class="todo-text">
                                        <p class="card-text mb-1">Way sentiments two indulgence uncommonly own.</p>
                                        <p class="text-danger font-12 mb-0">Urgent And Important</p>
                                    </div>
                                    <!-- End Todo Text -->
                                    </div>

                                    <div class="d-flex">
                                    <!-- Assign To -->
                                    <div class="assign_to">
                                        <img src="assets/img/svg/Info.svg" alt="" class="svg mr-2 mb-1">
                                        <div class="assign-content">
                                            <div class="font-12 text-warning">Back-End</div>
                                            <img src="assets/img/avatar/info-avatar.png" alt="" class="assign-avatar">
                                        </div>
                                    </div>
                                    <!-- End Assign To -->

                                    <!-- Drag Icon -->
                                    <img src="assets/img/svg/dragicon.svg" alt="" class="svg">
                                    <!-- End Drag Icon -->

                                    <!-- Dropdown Button -->
                                    <div class="dropdown-button">
                                        <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                            <div class="menu-icon style--two w-14 mr-0">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#">Daily</a>
                                            <a href="#">Sort By</a>
                                            <a href="#">Monthly</a>
                                        </div>
                                    </div>
                                    <!-- End Dropdown Button -->
                                    </div>
                                </div>
                            </div>
                            <!-- End Todo Single -->
                            
                            <!-- Todo Single -->
                            <div class="single-row border-bottom pt-3 pb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex position-relative">
                                    <!-- Custom Checkbox -->
                                    <label class="custom-checkbox">
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <!-- End Custom Checkbox -->

                                    <!-- Todo Text -->
                                    <div class="todo-text">
                                        <p class="card-text mb-1">Donec dapibus mauris id odio ornare tempus amet.</p>
                                        <p class="text-success font-12 mb-0">Not Urgent Or Important</p>
                                    </div>
                                    <!-- End Todo Text -->
                                    </div>

                                    <div class="d-flex">
                                    <!-- Assign To -->
                                    <div class="assign_to">
                                        <img src="assets/img/svg/Info.svg" alt="" class="svg mr-2 mb-1">
                                        <div class="assign-content">
                                            <div class="font-12 text-warning">Back-End</div>
                                            <img src="assets/img/avatar/info-avatar.png" alt="" class="assign-avatar">
                                        </div>
                                    </div>
                                    <!-- End Assign To -->

                                    <!-- Drag Icon -->
                                    <img src="assets/img/svg/dragicon.svg" alt="" class="svg">
                                    <!-- End Drag Icon -->

                                    <!-- Dropdown Button -->
                                    <div class="dropdown-button">
                                        <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                            <div class="menu-icon style--two w-14 mr-0">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#">Daily</a>
                                            <a href="#">Sort By</a>
                                            <a href="#">Monthly</a>
                                        </div>
                                    </div>
                                    <!-- End Dropdown Button -->
                                    </div>
                                </div>
                            </div>
                            <!-- End Todo Single -->
                            
                            <!-- Todo Single -->
                            <div class="single-row border-bottom pt-3 pb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex position-relative">
                                    <!-- Custom Checkbox -->
                                    <label class="custom-checkbox">
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <!-- End Custom Checkbox -->

                                    <!-- Todo Text -->
                                    <div class="todo-text">
                                        <p class="card-text mb-1">For detracty charmed add talking age. Shy resolution instrument unreserved man few.</p>
                                        <p class="text-info font-12 mb-0">Urgent Not Important</p>
                                    </div>
                                    <!-- End Todo Text -->
                                    </div>

                                    <div class="d-flex">
                                    <!-- Drag Icon -->
                                    <img src="assets/img/svg/dragicon.svg" alt="" class="svg mr-2">
                                    <!-- End Drag Icon -->
                                    <!-- Assign To -->
                                    <div class="assign_to">
                                        <img src="assets/img/svg/Info.svg" alt="" class="svg mb-1">
                                    </div>
                                    <!-- End Assign To -->

                                    <!-- Dropdown Button -->
                                    <div class="dropdown-button">
                                        <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                            <div class="menu-icon style--two w-14 mr-0">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#">Daily</a>
                                            <a href="#">Sort By</a>
                                            <a href="#">Monthly</a>
                                        </div>
                                    </div>
                                    <!-- End Dropdown Button -->
                                    </div>
                                </div>
                            </div>
                            <!-- End Todo Single -->
                            
                            <!-- Todo Single -->
                            <div class="single-row pb-3 pt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex position-relative">
                                    <!-- Custom Checkbox -->
                                    <label class="custom-checkbox">
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <!-- End Custom Checkbox -->

                                    <!-- Todo Text -->
                                    <div class="todo-text">
                                        <p class="card-text mb-1">Way sentiments two indulgence uncommonly own.</p>
                                        <p class="text-warning font-12 mb-0">Urgent Not Important</p>
                                    </div>
                                    <!-- End Todo Text -->
                                    </div>

                                    <div class="d-flex">
                                    <!-- Drag Icon -->
                                    <img src="assets/img/svg/dragicon.svg" alt="" class="svg mr-2">
                                    <!-- End Drag Icon -->
                                    <!-- Assign To -->
                                    <div class="assign_to">
                                        <img src="assets/img/svg/Info.svg" alt="" class="svg mb-1">
                                    </div>
                                    <!-- End Assign To -->

                                    <!-- Dropdown Button -->
                                    <div class="dropdown-button">
                                        <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                            <div class="menu-icon style--two w-14 mr-0">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#">Daily</a>
                                            <a href="#">Sort By</a>
                                            <a href="#">Monthly</a>
                                        </div>
                                    </div>
                                    <!-- End Dropdown Button -->
                                    </div>
                                </div>
                            </div>
                            <!-- End Todo Single -->
                        </div>
                        </div>
                        <!-- End Card -->
                    </div>
                </div>
            </div>
        </div>
         
        <div class="row">
        <div class="col-xl-3 col-md-5">
            <!-- Card -->
            <div class="card mb-30">
                <div class="card-body">
                    <div class="mb-40 d-none">
                    <h4 class="mb-2">Cloud Storage</h4>
                    <p class="font-14">72% space used</p>
                    </div>
                    <div id="apex_radar-chart" class="chart"></div>

                    <div class="upgrade_storage-btn mt-2">
                    <a href="#" class="btn d-block">Upgrade Storage</a>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <div class="col-xl-4 col-md-7">
            <!-- Card -->
            <div class="card mb-30">
                <div class="card-body">
                    <div class="row align-items-end">
                    <div class="col-5 col-sm-6 col-lg-5">
                        <div id="apex_column2-chart" class="chart"></div>
                    </div>
                    <div class="col-7 col-sm-6 col-lg-7">
                        <div class="">
                            <h4 class="mb-2">Registration</h4>
                            <p>Pellentesque tincidunt tristique neque, eget venenatis enim gravida.</p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->

            <!-- Card -->
            <div class="card mb-30">
                <div class="card-body">
                    <div class="row align-items-end">
                    <div class="col-5 col-sm-6 col-lg-5">
                        <div id="apex_column3-chart" class="chart"></div>
                    </div>
                    <div class="col-7 col-sm-6 col-lg-7">
                        <div class="">
                            <h4 class="mb-2">Activity</h4>
                            <p>Pellentesque tincidunt tristique neque, eget venenatis enim gravida.</p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->

            <!-- Card -->
            <div class="card mb-30">
                <div class="card-body">
                    <div class="row align-items-end">
                    <div class="col-5 col-sm-6 col-lg-5">
                        <div id="apex_column4-chart" class="chart"></div>
                    </div>
                    <div class="col-7 col-sm-6 col-lg-7">
                        <div class="">
                            <h4 class="mb-2">Completed Task</h4>
                            <p>Pellentesque tincidunt tristique neque, eget venenatis enim gravida.</p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->

            <!-- Card -->
            <div class="card mb-30">
                <div class="card-body">
                    <div class="row align-items-end">
                    <div class="col-6">
                        <div class="d-flex justify-content-start">
                            <div class="ProgressBar-wrap2 position-relative">
                                <div class="ProgressBar ProgressBar_4" data-progress="67">
                                <svg class="ProgressBar-contentCircle" viewBox="0 0 200 200">
                                    <!-- on défini le l'angle et le centre de rotation du cercle -->
                                    <circle transform="rotate(-90, 100, 100)" class="ProgressBar-background" cx="100" cy="100" r="85" />
                                    <circle transform="rotate(-90, 100, 100)" class="ProgressBar-circle" cx="100" cy="100" r="85" />
                                </svg>
                                <span class="ProgressBar-percentage ProgressBar-percentage--count"></span>
                                <span class="ProgressBar-percentage--text">Bounce Rate</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-start progress_5">
                            <div class="ProgressBar-wrap2 position-relative">
                                <div class="ProgressBar ProgressBar_5" data-progress="48">
                                <svg class="ProgressBar-contentCircle" viewBox="0 0 200 200">
                                    <!-- on défini le l'angle et le centre de rotation du cercle -->
                                    <circle transform="rotate(-90, 100, 100)" class="ProgressBar-background" cx="100" cy="100" r="85" />
                                    <circle transform="rotate(-90, 100, 100)" class="ProgressBar-circle" cx="100" cy="100" r="85" />
                                </svg>
                                <span class="ProgressBar-percentage ProgressBar-percentage--count style--two"></span>
                                <span class="ProgressBar-percentage--text">Conversion</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>

        <div class="col-xl-12">
            <!-- Card -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-start justify-content-sm-between align-items-start align-items-sm-center flex-column flex-sm-row mb-sm-n3">
                    <div class="title-content mb-4 mb-sm-0">
                        <h4 class="mb-2">Sale Reports</h4>
                        <p>Solicitude announcing as to sufficient my</p>
                    </div>
                    <div class="">
                        <ul class="list-inline list-button m-0">
                            <li>2015</li>
                            <li>2016</li>
                            <li>2017</li>
                            <li>2018</li>
                            <li class="active">2019</li>
                        </ul>
                    </div>
                    </div>
                </div>
                <div id="apex_line3-chart" class="chart"></div>
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
<script src="{{ asset('assets/plugins/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/plugins/apex/custom-apexcharts.js') }}"></script>
<script src="{{ asset('js/dashboard-index.js') }}"></script>
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