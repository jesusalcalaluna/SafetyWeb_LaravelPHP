@extends('layouts.app_dashboard')

@section('navbar')
    @include('globals.dashboard.navbar')
    @include('globals.dashboard.sidebar')
@endsection
@section('content')
<div class="main-content">
    <div class="container-fluid">

        <div class="row">
            @isset($IDatails)
            @foreach ($IDatails as $item)
            <div class="col-12">
               <!-- Invoice Header -->
               <div class="invoice-details-header card_color-bg d-flex align-items-sm-center flex-column flex-sm-row mb-30 justify-content-sm-between">
                  <div class="d-flex align-items-center">
                     <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="mr-2"><img src="../../../assets/img/svg/angle-left.svg" alt="" class="svg"></a>
                     <h2 class="regular mr-3 font-30">Registro</h2>
                     <h4 class="c4">#{{ $item->id }}</h4>
                  </div>

                  <div class="invoice-header-right d-flex align-items-center justify-content-around justify-content-sm-end mt-3 mt-sm-0">

                     <!-- Delete Condition -->
                     <div class="delete_mail mr-20">
                        <a href="#"><img src="{{ asset('assets/img/svg/delete.svg') }}" alt="" class="svg"></a>
                     </div>
                     <!-- End Delete Mail -->

                     <!-- Edit Invoice Button -->
                     <div class="edit-invoice-btn pr-1">
                        <a href="invoice-add-new.html" class="btn-circle">
                           <img src="{{ asset('assets/img/svg/writing.svg') }}" alt="" class="svg">
                        </a>
                     </div>
                     <!-- End Edit Invoice Button -->
                  </div>
               </div>
               <!-- End Invoice Header -->

               <!-- Invoice Top -->
               <div class="invoice-pd c2-bg bg-img" style="background-image: url(&quot;{{ asset('/assets/img/media/invoice-pattern.png') }}&quot;);">
                  <div class="row">
                     <div class="col-md-4">
                        <!-- Invoice Right -->
                        <div class="invoice-right  mt-md-0">
                           <h3 class="white font-20 mb-3">INCIDENTE</h3>

                           <ul class="status-list">
                              <li><span class="key font-14">Fecha:</span> <span class="white bold font-17">{{ $item->event_date }}</span></li>
                              <li><span class="key font-14">Incidente:</span> <span class="white bold font-17">{{ $item->incident->incident_type->type_name }}</span></li>
                              <li><span class="key font-14">Departamento:</span> <span class="white bold font-17">{{ $item->department->name }}</span></li>
                              <li><span class="key font-14">Estado:</span> <span class="white status-btn  @if($item->status == 0) bg-danger @endif @if($item->status == 1) bg-success @endif ">@if($item->status == 1) APROBADO @else DESAPROBADO @endif</span></li>
                           </ul>
                        </div>
                        <!-- End Invoice Right -->
                     </div>
                  </div>
               </div>
               <!-- End Invoice Top -->

               <!-- Invois Wrapper -->
               <div class="card_color-bg invoice-pd">
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <!-- Invoice Payment Details -->
                            <div class="invoice payment-details">
                                <div class="invoice-title c4 bold font-14 mb-3">Incidente</div>

                                <ul class="status-list">
                                    <li><span class="key">Descripcion:</span> <span class="font-17 bold">{{ $item->description }}</span></li>
                                    <li><span class="key">Solucion:</span> <span>{{ $item->solution_description }}</span></li>
                                </ul>
                            </div>
                            <!-- End Invoice Payment Details -->
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <!-- Invoice Payment Details -->
                            <div class="invoice payment-details">
                                <div class="invoice-title c4 bold font-14 mb-3">Detalles</div>

                                <ul class="status-list">
                                    <li><span class="key">Rason:</span> <span class="font-17 bold">{{ $item->incident_reason }}</span></li>
                                    <li><span class="key">Descripcion:</span> <span>{{ $item->reason_description }}</span></li>

                                </ul>
                            </div>
                            <!-- End Invoice Payment Details -->
                        </div>

                        <div class="col-xl-4 col-md-6 mt-5">
                            <!-- Invoice Form -->
                            <div class="invoice invoice-form">
                            <div class="invoice-title c4 bold font-14 mb-3">Involucrados</div>

                            <ul class="list-invoice">
                                <li class="user bold font-17">{{ $item->involbed_people_names }}</li>

                            </ul>
                            </div>
                            <!-- End Invoice Form -->
                        </div>

                    </div>
               </div>
               <!-- End Invois Wrapper -->

               <!-- Invoice Details List Wrapper -->
               <div class="card_color-bg details-list-wrap">

                  <!-- Cart Collaterals -->
                  <div class="cart-collaterals">
                     <div class="cart_totals calculated_shipping">
                        <div class="col-xl-4 col-md-6">
                           <!-- Invoice To -->
                           <div class="invoice invoice-to mt-5 mt-xl-0">
                           <div class="invoice-title c4 bold font-14 mb-3">Quien reporta</div>

                           <ul class="list-invoice">
                               <li class="user bold font-17">{{ $item->reporter->name }}</li>
                               <li class="location">{{ $item->reporter->company_and_department->name }}<br>
                                   </li>
                           </ul>
                           </div>
                           <!-- End Invoice To -->
                       </div>
                     </div>
                  </div>
                  <!-- End Cart Collaterals -->
               </div>
               <!-- End Invoice Details List Wrapper -->
            </div>
            @endforeach
            @endisset
        </div>
        
    </div>
</div>
@endsection
@section('footer')
    
@endsection
@section('js')

@endsection