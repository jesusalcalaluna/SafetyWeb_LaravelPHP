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
                        <h4 class="font-20">Lista del Personal Externo</h4>
                        
                        <div class="d-flex flex-wrap">
                            <div class="add-new-contact mr-20">
                                <a href="{{ route('newPersonForm') }}" class="btn-circle">
                                   <img src="../../../assets/img/svg/plus_white.svg" class="svg">
                                </a>
                            </div>
                            <!-- search -->
                            <div class="mr-20 mt-3 mt-sm-0">
                                <div  class="search-form">
                                    <div class="theme-input-group">
                                       <input type="text" class="theme-input-style" id="search"  placeholder="Busca aqui..." >

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
                                <th>Id</th>
                                <th>Nombre </th>
                                <th>Departamento</th>
                                <th>Puesto</th>
                                <th>PCC</th>
                                <th>PCI</th>
                                <th>Accion </th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($people)
                            @foreach ($people as $item)
                            
                            <tr>
                                <td>{{$item->sap}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->company_and_department->name}}</td>
                                <td>{{$item->position}}</td>

                                @if (count($item->companion_care_records) )
                                <td class="bg-success">{{count($item->companion_care_records)}}</td>
                                @else
                                <td class="bg-danger">{{count($item->companion_care_records)}}</td>
                                @endif 

                                @if (count($item->unsafe_condition_records) )
                                <td class="bg-success">{{count($item->unsafe_condition_records)}}</td>
                                @else
                                <td class="bg-danger">{{count($item->unsafe_condition_records)}}</td>
                                @endif

                                <td>
                                    <!-- Edit Invoice Button -->
                                    <div class="invoice-header-right d-flex align-items-start justify-content-around justify-content-sm-start mt-3 mt-sm-0">
                
                                        <!-- Edit Invoice Button -->
                                        <div class="edit-invoice-btn pr-1">
                                        <a href="{{ route('updateperson', [$item->id]) }}" class="btn-circle">
                                            <img src="{{ asset('assets/img/svg/writing.svg') }}" alt="" class="svg">
                                        </a>
                                        </div>
                                        <div>
                                            <form method="POST" action="{{route('deactivatePerson')}}">
                                                <input hidden="true" value="{{$item->id}}" name="id">
                                                <a onclick="deactivatePersonAlert(this);" class="btn-circle ">
                                                <img src="{{ asset('assets/img/svg/delete.svg') }}" alt="" class="svg">
                                            </a>
                                            </form>
                                        </div>
                                        <!-- End Edit Invoice Button -->
                                    </div>
                                </td>
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
    function deactivatePersonAlert(selected){
        
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
                Swal.fire({ type: "success", title: "¡Eliminado!", text: "Persona eliminada. :(", confirmButtonClass: "btn btn-success" })
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