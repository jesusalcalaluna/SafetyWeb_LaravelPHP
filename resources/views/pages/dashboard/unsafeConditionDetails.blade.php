@extends('layouts.app_dashboard')

@section('navbar')
    @include('globals.dashboard.navbar')
    @include('globals.dashboard.sidebar')
@endsection
@section('content')
<div class="main-content">
    <div class="container-fluid">

        <div class="row">
            @isset($unsafeConditionRecord)
            @foreach ($unsafeConditionRecord as $item)
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
                        <form method="POST" id="deleteForm" action="{{route('deleteUC')}}">
                           @csrf
                           <input hidden="true" value="{{$item->id}}" name="id">
                           <a onclick="deleteUCAlert();" class="btn-circle ">
                           <img src="{{ asset('assets/img/svg/delete.svg') }}" alt="" class="svg">
                           </a>
                       </form>
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
                           <h3 class="white font-20 mb-3">Condicion Insegura</h3>

                           <ul class="status-list">
                              <li><span class="key font-14">No. de aviso:</span> <span class="white bold font-17">#{{ $item->notice_number }}</span></li>
                              <li><span class="key font-14">Detectado:</span> <span class="white bold font-17">{{ $item->created_at }}</span></li>
                              <li><span class="key font-14">Limite:</span> <span class="white bold font-17">{{ $item->deadline }}</span></li>
                              <li><span class="key font-14">Origen:</span> <span class="white bold font-17">{{ $item->detection_origin }}</span></li>
                              <li><span class="key font-14">Estado:</span> <span class="white status-btn  @if($item->status == "RETRASADA") bg-danger @endif @if($item->status == "NO INICIADA") bg-dark @endif @if($item->status == "EN PROCESO") bg-warning @endif @if($item->status == "COMPLETA") bg-success @endif ">{{ $item->status }}</span></li>
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
                                <div class="invoice-title c4 bold font-14 mb-3">Detalles:</div>

                                <ul class="status-list">
                                    <li><span class="key">Tipo:</span> <span class="font-17 bold">{{ $item->type_condition->condition_group->group_name }}</span></li>
                                    <li><span class="key">Accion:</span> <span>{{ $item->type_condition->action_name }}</span></li>
                                    <li><span class="key">Condición:</span> <span>{{ $item->condition_detected }} </span></li>

                                </ul>
                            </div>
                            <!-- End Invoice Payment Details -->
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <!-- Invoice Form -->
                            <div class="invoice invoice-form">
                            <div class="invoice-title c4 bold font-14 mb-3">Responsable</div>

                            <ul class="list-invoice">
                                <li class="user bold font-17">{{ $item->responsable->name }}</li>
                                <li class="location">{{ $item->department->name }}<br>
                                    {{ $item->area }}</li>
                            </ul>
                            </div>
                            <!-- End Invoice Form -->
                        </div>
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
               <!-- End Invois Wrapper -->

               <!-- Invoice Details List Wrapper -->
               <div class="card_color-bg details-list-wrap">

                  <!-- Cart Collaterals -->
                  <div class="cart-collaterals">
                     <div class="cart_totals calculated_shipping">
                        <table class="shop_table style-two">
                           <tbody>
                              <tr class="cart-subtotal">
                                 <th>Probabilidad</th>
                                 <th>
                                    <span class="Price-amount amount">
                                       <span class="Price-currencySymbol"> </span>{{ $item->probability }}</span>
                                 </th>
                              </tr>
                              <tr class="cart-tax">
                                 <td>Frecuencia</td>
                                 <td>
                                    <span class="Price-amount amount">
                                       <span class="Price-currencySymbol">x </span>{{ $item->frequency }}</span>
                                 </td>
                              </tr>
                              <tr class="cart-tax">
                                 <td>Impacto</td>
                                 <td>
                                    <span class="Price-amount amount">
                                       <span class="Price-currencySymbol">x </span>{{ $item->impact }}
                                       </span>
                                 </td>
                              </tr>
               
                              <tr class="order-total">
                                 <td>Riesgo</td>
                                 <td>
                                    <strong>
                                        <span class="Price-amount amount"><span class="Price-currencySymbol"></span>{{ $item->risk }} <p>
                                            {{ $item->risk_type }}
                                        </span>
                                    </strong> 
                                 </td>
                              </tr>
                           </tbody>
                        </table>
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
<script>
   function deleteUCAlert(){
        
        Swal.fire({
            title: "¿Estas seguro?",
            text: "¡No podras revertirlo!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Si, eliminalo!",
            confirmButtonClass: "btn long",
            cancelButtonClass: "btn long bg-danger ml-1",
            cancelButtonText: "Cancelar",
            buttonsStyling: !1,
        }).then(function (t) {

            if (t.value) {
                $("#deleteForm").submit();
                
            }else{
                t.dismiss === Swal.DismissReason.cancel && Swal.fire({ title: "Cancelado", text: "El usuario esta a salvo :)", type: "error", confirmButtonClass: "btn btn-success" });
            }
        });
        
    }
</script>
@endsection