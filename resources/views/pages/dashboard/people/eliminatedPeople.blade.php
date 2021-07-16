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
                            <h4 class="font-20">Lista del Personal Eliminado</h4>
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
                                            <input type="text" class="theme-input-style" id="search"  placeholder="Busca aqui...">

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
                                <th>SAP/ID</th>
                                <th>Nombre </th>
                                <th>Puesto</th>
                                <th>Estado</th>
                                <th>Accion </th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($people)
                                @foreach ($people as $item)
                                        <tr>
                                            <td>{{$item->sap}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->position}}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                <!-- Edit Invoice Button -->
                                                <div class="invoice-header-right d-flex align-items-start justify-content-around justify-content-sm-start mt-3 mt-sm-0">

                                                    <!-- Edit Invoice Button -->
                                                    <div class="edit-invoice-btn pr-1">
                                                        <a href="{{ route('updateperson', [$item->id]) }}" class="btn-circle">
                                                            <img src="{{ asset('assets/img/svg/writing.svg') }}" alt="" class="svg">
                                                        </a>
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
