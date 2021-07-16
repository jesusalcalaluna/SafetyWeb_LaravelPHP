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
                <div class="card-body pt-30">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="font-20 ">Registros Cuidado del compañero</h4>
                        @if (Auth::user()->role->hierarchy <= 1)
                            <!-- Dropdown Button -->
                            <div class="dropdown-button">
                                <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                    <img src="../../../assets/img/svg/download.svg" alt="" class="svg">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{route('CCAll')}}" >Todo</a>
                                    <a href="{{route('CCYesterday')}}" >Ayer</a>
                                    <a href="{{route('CCMonth')}}" >Mes</a>
                                    <a href="{{route('CCYear')}}" >Año</a>
                                </div>
                            </div>
                            <!-- End Dropdown Button -->
                        @endif
                        <div class="d-flex flex-wrap">
                            <!-- search -->
                            <div class="mr-20 mt-3 mt-sm-0">
                                <div  class="search-form">
                                    <div class="theme-input-group">
                                       <input type="text" class="theme-input-style" id="search"  placeholder="Busca aqui..." ">

                                       <button id="btnSearch" type="button" onclick="search();"> <img src="../../../assets/img/svg/search-icon.svg" alt=""  class="svg"></button>
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
                                <th>Nombre</th>
                                <th>Compañia/Departamento</th>
                                <th>Puesto</th>
                                <th>Turno</th>
                                <th>Sup. en turno</th>
                                <th>Descripción</th>
                                <th>Tipo</th>
                                <th>Grp. Comportamiento</th>
                                <th>Tipo de acto</th>
                                <th>SIF</th>
                                <th>Regla de Oro</th>
                                <th>Origen</th>
                                <th>Departamento</th>
                                <th>Area Especifica</th>
                                <th>Nom. del Observador</th>
                                <th>Dep/Comp. del Observador </th>
                                <th>Fecha de Registro</th>
                                @if(Auth::user()->role->hierarchy <=  1)
                                    <th>Acciones </th>
                                @endif

                            </tr>
                        </thead>
                        <tbody>
                            @isset($companion_care_record)
                            @foreach ($companion_care_record as $item)
                            <tr>
                                <td>{{$item->companion_to_care_name}}</td>
                                <td>{{$item->company_department_name}}</td>
                                <td>{{$item->position_name}}</td>
                                <td>{{$item->turn}}</td>
                                <td>{{$item->shift_supervisor}}</td>

                                <td>{{$item->description}}</td>
                                <td class="@if($item->corr_prev_pos == "COMPORTAMIENTO INSEGURO") bg-danger @endif @if($item->corr_prev_pos == "COMPORTAMIENTO SEGURO") bg-success @endif">{{$item->corr_prev_pos}}</td>

                                <td>{{$item->behavior_group[0]->group_name}}</td>

                                @if (isset($item->acts_types[0]->type_name))
                                <td>{{$item->acts_types[0]->type_name}}</td>
                                @else
                                <td>N/A</td>
                                @endif
                                @if (isset($item->sif))
                                <td>{{$item->sif}}</td>
                                @else
                                <td>N/A</td>
                                @endif
                                @if (isset($item->gold_rules[0]->rule_name))
                                <td>{{$item->gold_rules[0]->rule_name}}</td>
                                @else
                                <td>N/A</td>
                                @endif

                                <td>{{$item->detection_source}}</td>
                                <td>{{$item->department_where_happens[0]->name}}</td>
                                <td>{{$item->specific_area}}</td>
                                <td>{{$item->people[0]->name}}</td>
                                <td>{{$item->people[0]->company_and_department->name}}</td>
                                <td>{{$item->created_at}}</td>
                                @if(Auth::user()->role->hierarchy <=  1)
                                    <td>
                                        <!-- Edit Invoice Button -->
                                        <div class="invoice-header-right d-flex align-items-start justify-content-around justify-content-sm-start mt-3 mt-sm-0">

                                            <!-- Edit Invoice Button -->
                                            <!--<div class="edit-invoice-btn pr-1">
                                                <a href="{{ route('updateperson', [$item->id]) }}" class="btn-circle">
                                                    <img src="{{ asset('assets/img/svg/writing.svg') }}" alt="" class="svg">
                                                </a>
                                            </div>-->
                                            <div>
                                                <form method="POST" action="{{route('deleteCompanionCare')}}">
                                                    <input hidden="true" value="{{$item->id}}" name="id">
                                                    <a onclick="eliminarCuidado(this);" class="btn-circle ">
                                                        <img src="{{ asset('assets/img/svg/delete.svg') }}" alt="" class="svg">
                                                    </a>
                                                </form>
                                            </div>
                                            <!-- End Edit Invoice Button -->
                                        </div>
                                    </td>
                                @endif
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
    function eliminarCuidado(selected){

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
                $.ajax({
                    type: "POST",
                    url: selected.parentNode.action,
                    data: { "_token" : "{{ csrf_token() }}",
                        "id" : $(selected).parent().find('input[name="id"]').val()},
                    success:  function(data){

                        $(selected).parent().parent().parent().parent().parent().remove()

                    }
                }).done(function() {
                    Swal.fire({ type: "success", title: "¡Eliminado!", text: "Cuidado eliminado. :(", confirmButtonClass: "btn btn-success" })
                }).fail(function(err) {
                    Swal.fire({ title: "Error!", text: " ¡Algo salio mal! intentalo nuevamente", type: "error", confirmButtonClass: "btn long", buttonsStyling: !1 });
                });

            }else{
                t.dismiss === Swal.DismissReason.cancel && Swal.fire({ title: "Cancelado", text: "¡Eso estuvo cerca! ;)", type: "error", confirmButtonClass: "btn btn-success" });
            }
        });

    }
    $("#search").keyup(function(){

        if (event.keyCode === 13) {


            $("#btnSearch").click();
        }
    });
    function search(){

        _this = $("#search");
        console.log($("#search"));
        console.log(_this);
        // Show only matching TR, hide rest of them
            $.each($("#table tbody tr"), function() {


            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
            $(this).hide();
            else
            $(this).show();
        });
    }
</script>

@endsection
