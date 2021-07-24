@extends('layouts.app_dashboard')
@section('css')
@endsection

@section('navbar')
    @include('globals.dashboard.navbar')
    @include('globals.dashboard.sidebar')
@endsection
@section('content')

<div class="main-content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card mb-30">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="font-20">Condiciones Inseguras</h4>

                        <div class="assign-tag back-end bg-success pl-2">

                            <a href="@if(Request::url() === route('unsafeConditionByStatus',['COMPLETA'])) {{ route('getUnsafeConditions') }} @else {{ route('unsafeConditionByStatus',['COMPLETA']) }} @endif">
                                <div class="tag-text font-12 text-dark"><span class="pr-3" id="porcentCom">{{ $porcentCom }}%</span>COMPLETA</div>
                            </a>
                         </div>
                         <div class="assign-tag back-end bg-warning pl-2">
                            <a href="@if(Request::url() === route('unsafeConditionByStatus',['EN PROCESO'])) {{ route('getUnsafeConditions') }} @else {{ route('unsafeConditionByStatus',['EN PROCESO'])}} @endif">
                                <div class="tag-text font-12 text-dark"><span class="pr-3" id="porcentProc">{{ $porcentProc }}%</span>EN PROCESO</div>
                            </a>

                         </div>
                        <div class="assign-tag back-end bg-danger pl-2">
                            <a href="@if(Request::url() === route('unsafeConditionByStatus',['RETRASADA'])) {{ route('getUnsafeConditions') }} @else {{ route('unsafeConditionByStatus',['RETRASADA']) }} @endif">
                                <div class="tag-text font-12 text-light"><span class="pr-3" id="porcentRetr">{{ $porcentRetr }}%</span>RETRASADA</div>
                            </a>
                         </div>

                         <div class="assign-tag back-end bg-dark pl-2" >
                            <a href="@if(Request::url() === route('unsafeConditionByStatus',['NO INICIADA'])) {{ route('getUnsafeConditions') }} @else {{ route( 'unsafeConditionByStatus',['NO INICIADA']) }} @endif">
                                <div class="tag-text font-12 text-light"><span class="pr-3" id="porcentInic">{{ $porcentInic }}%</span>NO INICIADA</div>
                            </a>
                         </div>
                            @if (Auth::user()->role->hierarchy <= 1)
                            <!-- Dropdown Button -->
                            <div class="dropdown-button">
                                <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                    <img src="../../../assets/img/svg/download.svg" alt="" class="svg">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{route('UCAll')}}" >Todo</a>
                                    <a href="{{route('UCYesterday')}}" >Ayer</a>
                                    <a href="{{route('UCMonth')}}" >Mes</a>
                                    <a href="{{route('UCYear')}}" >Año</a>
                                </div>
                            </div>
                            <!-- End Dropdown Button -->
                            @endif

                        <div class="d-flex flex-wrap">
                            <!-- search -->
                            <div class="mr-20 mt-3 mt-sm-0">
                                <div action="#" class="search-form">
                                    <div class="theme-input-group">
                                       <input type="text" class="theme-input-style" id="search" placeholder="Busca aqui..." name="word" :value="old('word')">

                                       <button id="btnSearch" type="button" onclick="search();"><img src="../../../assets/img/svg/search-icon.svg" alt="" class="svg"></button>
                                    </div>
                                </div>
                            </div>
                            <!-- End search -->
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Invoice List Table -->
                    <table class="text-nowrap dh-table" id="table">
                        <thead>
                            <tr>
                                <th>Fecha de Detección </th>
                                <th>Estado </th>
                                <th>Fecha limite </th>
                                <th class="w-1\/2">Condicion</th>
                                <th>Tipo de condicion </th>
                                <th>Departamento </th>
                                <th>Prioridad de atención </th>
                                <th>Quien detecta</th>
                                <th>Accion </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><p>dñkgndsl{fknñds adgsdfgfd fgdfgdsfgdfdfsg dfgdfgdsfgdfg dfg   dfgdsfgsdfgdfg df fgdsgdfgdsfg fgsdfgdsg kfgñkjdsbg kjfsd{kj bfdskjgñkdjb fgkbjdfskjbgdk fbgkbjdsfgkjbdfkj gbñdfkb fvdfkh uasdkjb sdkjsakj bdkjabs dfkjba sdkfjbasd </p>     </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                           </tr>
                            @isset($unsafeConditionRecord)
                            @foreach ($unsafeConditionRecord as $item)
                                <tr>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <div class="priority">
                                            <a href="#" id="status" class="assign-menu bold font-14 @if($item->status == "RETRASADA") bg-danger @endif @if($item->status == "NO INICIADA") bg-dark @endif @if($item->status == "EN PROCESO") bg-warning @endif @if($item->status == "COMPLETA") bg-success @endif " data-toggle="dropdown" aria-expanded="false">{{$item->status}}</a>
                                            <div id="exept" class="dropdown-menu style--five optionsForm" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(115px, 35px, 0px);">
                                                <form method="POST" action="{{route('updateUnsafeCondition')}}"> <input hidden="true" value="RETRASADA" name="status"><input hidden="true" value="{{$item->id}}" name="id"><a onclick="submitForm(this);" ><span class="tag_color bg-danger"></span>RETRASADA</a></form>
                                                <form method="POST" action="{{route('updateUnsafeCondition')}}"> <input hidden="true" value="NO INICIADA" name="status"><input hidden="true" value="{{$item->id}}" name="id"> <a onclick="submitForm(this);" ><span class="tag_color bg-dark"></span>NO INICIADA</a></form>
                                                <form method="POST" action="{{route('updateUnsafeCondition')}}"> <input hidden="true" value="EN PROCESO" name="status"><input hidden="true" value="{{$item->id}}" name="id"> <a onclick="submitForm(this);" ><span class="tag_color bg-warning"></span>EN PROCESO</a></form>
                                                <form method="POST" action="{{route('updateUnsafeCondition')}}"> <input hidden="true" value="COMPLETA" name="status"><input hidden="true" value="{{$item->id}}" name="id"> <a onclick="submitForm(this);" ><span class="tag_color bg-success"></span>COMPLETA</a></form>
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{$item->deadline}}</td>
                                    <td class="celda"><p> {{ $item->condition_detected }}</p></td>
                                    <td>{{$item->type_condition->condition_group->group_name}}</td>
                                    <td>{{$item->department->name}}</td>
                                    <td class="@if($item->attention_priority == "CRÍTICA" || $item->attention_priority == "ALTA") bg-danger @endif @if($item->attention_priority == "MEDIA") bg-warning @endif @if($item->attention_priority == "BAJA") bg-success @endif">{{$item->attention_priority}}</td>
                                    <td>{{$item->reporter->name}}</td>
                                    <td><a href="{{ route('unsafeConditionDetails', [$item->id]) }}" class="details-btn">Ver Detalles <i class="icofont-arrow-right"></i></a></td>
                                </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                    <!-- End Invoice List Table -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')

@endsection
@section('js')


<script type="text/JavaScript">

    $("#search").keyup(function(){

        if (event.keyCode === 13) {


            $("#btnSearch").click();
        }
    });
    function search(){

        _this = $("#search");
        // Show only matching TR, hide rest of them
        $.each($("#table tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
            $(this).hide();
            else
            $(this).show();
        });
    }
    function submitForm(item){
        //console.log($(item).parent().find('input[name="_token"]').val());
        //console.log($(item).parent().find('input[name="id"]').val());
        //console.log($(item).parent().find('input[name="status"]').val());
        //console.log(item.parentNode.children);

        $.ajax({
            type: "POST",
            url: item.parentNode.action,
            data: { "_token" : "{{ csrf_token() }}",
                    "status" : $(item).parent().find('input[name="status"]').val(),
                    "id" : $(item).parent().find('input[name="id"]').val()},
            success:  function(data){

                //Porcentajes por estado de la CI
                $('#porcentCom').text(data.porcentCom+"%");
                $('#porcentProc').text(data.porcentProc+"%");
                $('#porcentRetr').text(data.porcentRetr+"%");
                $('#porcentInic').text(data.porcentInic+"%");

                if ($(item).parent().find('input[name="status"]').val() == "NO INICIADA") {
                    $(item).parent().parent().parent().find('#status').removeClass("bg-danger")
                    $(item).parent().parent().parent().find('#status').addClass("bg-dark")
                    $(item).parent().parent().parent().find('#status').removeClass("bg-warning")
                    $(item).parent().parent().parent().find('#status').removeClass("bg-success")
                }
                if ($(item).parent().find('input[name="status"]').val() == "RETRASADA") {
                    $(item).parent().parent().parent().find('#status').addClass("bg-danger")
                    $(item).parent().parent().parent().find('#status').removeClass("bg-dark")
                    $(item).parent().parent().parent().find('#status').removeClass("bg-warning")
                    $(item).parent().parent().parent().find('#status').removeClass("bg-success")
                }
                if ($(item).parent().find('input[name="status"]').val() == "EN PROCESO") {
                    $(item).parent().parent().parent().find('#status').removeClass("bg-danger")
                    $(item).parent().parent().parent().find('#status').removeClass("bg-dark")
                    $(item).parent().parent().parent().find('#status').addClass("bg-warning")
                    $(item).parent().parent().parent().find('#status').removeClass("bg-success")
                }
                if ($(item).parent().find('input[name="status"]').val() == "COMPLETA") {
                    $(item).parent().parent().parent().find('#status').removeClass("bg-danger")
                    $(item).parent().parent().parent().find('#status').removeClass("bg-dark")
                    $(item).parent().parent().parent().find('#status').removeClass("bg-warning")
                    $(item).parent().parent().parent().find('#status').addClass("bg-success")
                }
                $(item).parent().parent().parent().find('#status').text($(item).parent().find('input[name="status"]').val());



            }
        }).done(function() {
            Swal.fire({ title: "Good job!", text: "You clicked the button!", type: "success", confirmButtonClass: "btn long", buttonsStyling: !1 });
        }).fail(function(err) {
            Swal.fire({ title: "Error!", text: " You clicked the button!", type: "error", confirmButtonClass: "btn long", buttonsStyling: !1 });
        });
    }

</script>

@endsection
