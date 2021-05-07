@extends('layouts.app_dashboard')

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
                        <h4 class="font-20">Registros de Incidentes</h4>

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
                                <th>Estado</th>
                                <th>Tipo</th>
                                <th>Incidente </th>
                                <th>Fecha </th>
                                <th>Departamento </th>
                                <th>Accion </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @isset($incidents)
                            @foreach ($incidents as $item)
                            @if (Auth::user()->role->role_name == 'ADMINISTRADOR')
                                <tr>
                                    <td>
                                        <div class="priority">
                                            <a href="#" id="status" class="assign-menu bold font-14 @if($item->status == 0) bg-danger @endif @if($item->status == 1) bg-success @endif " data-toggle="dropdown" aria-expanded="false">@if($item->status == 1) APROBADO @else DESAPROBADO @endif</a>
                                            <div id="exept" class="dropdown-menu style--five optionsForm" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(115px, 35px, 0px);">
                                                @if ($item->status == 0)
                                                <form method="POST" action="{{route('updateIncident')}}"> <input hidden="true" value="1" name="status"><input hidden="true" value="{{$item->id}}" name="id"> <a onclick="submitForm(this);" ><span class="tag_color bg-success"></span>APROBADO</a></form>
                                                @else
                                                <form method="POST" action="{{route('updateIncident')}}"> <input hidden="true" value="0" name="status"><input hidden="true" value="{{$item->id}}" name="id"><a onclick="submitForm(this);" ><span class="tag_color bg-danger"></span>DESAPROBADO</a></form>    
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$item->incident->incident_type->type_name}}</td>
                                    <td>{{$item->incident->incident_name}}</td>
                                    <td>{{$item->event_date}}</td>
                                    <td>{{$item->department->name}}</td>
                                    <td><a href="{{ route('incidentDetails', [$item->id]) }}" class="details-btn">Ver Detalles <i class="icofont-arrow-right"></i></a></td>
                                </tr>
                            @else
                                @if (Auth::user()->person->company_and_department->name == $item->department->name)
                                <tr>
                                    <td>
                                        <div class="priority">
                                            <a href="#" id="status" class="assign-menu bold font-14 @if($item->status == 0) bg-danger @endif @if($item->status == 1) bg-success @endif " data-toggle="dropdown" aria-expanded="false">@if($item->status == 1) APROBADO @else DESAPROBADO @endif</a>
                                            <div id="exept" class="dropdown-menu style--five optionsForm" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(115px, 35px, 0px);">
                                                @if ($item->status == 0)
                                                <form method="POST" action="{{route('updateIncident')}}"> <input hidden="true" value="1" name="status"><input hidden="true" value="{{$item->id}}" name="id"> <a onclick="submitForm(this);" ><span class="tag_color bg-success"></span>APROBADO</a></form>
                                                @else
                                                <form method="POST" action="{{route('updateIncident')}}"> <input hidden="true" value="0" name="status"><input hidden="true" value="{{$item->id}}" name="id"><a onclick="submitForm(this);" ><span class="tag_color bg-danger"></span>DESAPROBADO</a></form>    
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$item->incident->incident_type->type_name}}</td>
                                    <td>{{$item->incident->incident_name}}</td>
                                    <td>{{$item->event_date}}</td>
                                    <td>{{$item->department->name}}</td>
                                    <td><a href="{{ route('incidentDetails', [$item->id]) }}" class="details-btn">Ver Detalles <i class="icofont-arrow-right"></i></a></td>
                                </tr>
                                @endif
                            @endif
                            
                            
                            
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
        console.log($(item).parent().find('input[name="_token"]').val());
        console.log($(item).parent().find('input[name="id"]').val());
        console.log($(item).parent().find('input[name="status"]').val());
        console.log(item.parentNode.children);
        
        $.ajax({
            type: "POST",
            url: item.parentNode.action,
            data: { "_token" : "{{ csrf_token() }}",
                    "status" : $(item).parent().find('input[name="status"]').val(),
                    "id" : $(item).parent().find('input[name="id"]').val()},
            success:  function(data){
                
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