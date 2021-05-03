@extends('layouts.app_dashboard')

@section('css')
   <!-- ======= BEGIN PAGE LEVEL PLUGINS STYLES ======= -->
   <link rel="stylesheet" href="assets/plugins/datepicker/datepicker.min.css">
   <!-- ======= END BEGIN PAGE LEVEL PLUGINS STYLES ======= -->
@endsection

@section('navbar')
    
    @include('globals.dashboard.navbar')
    @auth
    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        @include('globals.dashboard.sidebar')
    @endif
    @endauth
    
    
    
@endsection
@section('content')

<div class="main-content">
   
    <div class="container-fluid">
    
        <div class="form-element input-sizing">
            <h4 class="font-20 mb-4">Reporte de Incidentes</h4>

            <!-- Form -->
            <form action="{{ route('setIncident')}}" method="POST">
                @csrf

                <!-- Form Group -->
                <div class="form-group mb-4"> 
                    <label class="mb-2 font-14 bold">Fecha del Incidente</label>
                    
                    <!-- Date Picker -->
                    <div class="dashboard-date style--four">
                       <span class="input-group-addon">
                          <img src="../../../assets/img/svg/calender.svg" alt="" class="svg">
                        </span>

                       <input type="text" id="default-date" placeholder="Select Date" name="event_date"/>
                    </div>
                    <!-- End Date Picker -->
                </div>
                <!-- End Form Group -->
                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="condition_detected" class="mb-2 bold">Descripcion del Incidente</label>
                    <textarea type="text" class="theme-input-style" id="condition_detected" placeholder="Describe como ocurrio..." name="description"></textarea>
                </div>
                <!-- End Form Group -->

                <!-- Form Group Department -->
                <div class="form-group mb-4">
                    <label for="department_id" class="mb-2 bold d-block">Departamento Donde Ocurrio</label>
                    <div class="custom-select style--two">
                        <select class="theme-input-style" id="department_id" name="department_id">
                            @isset($departments)
                            @foreach ($departments as $item)
                            @if ($item->origin == "INTERNO")
                            @if (!str_contains($item->name, 'LÍNEA'))
                            <option value="{{$item->id}}" >{{$item->name}}</option>
                            @endif
                            @endif
                            @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <!-- End Form Group -->
                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="specific_area" class="mb-2 bold">Área Especifica</label>
                    <input type="text" class="theme-input-style" id="specific_area" placeholder="Here is default input field size" name="spesific_area">
                </div>
                <!-- End Form Group -->
                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="condition_groups" class="mb-2 bold d-block">Tipo de Incidente</label>
                    <div class="custom-select style--two">
                        <select class="theme-input-style" onChange="changeConditionGroup(this);" id="condition_groups">
                            @isset($incidentType)
                            @foreach ($incidentType as $item)
                                <option value="{{$item->id}}" >{{$item->type_name}}</option>   
                            @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <!-- End Form Group -->
                
                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="type_condition_id" class="mb-2 bold d-block">Incidente</label>
                    <div class="custom-select style--two">
                        <select class="theme-input-style" id="type_condition_id" name="incident_id">
                            @isset($incident)
                            @foreach ($incident as $item)
                                <option class="conditionGroupId_{{$item->incident_type_id}}" value="{{$item->id}}" >{{$item->incident_name}}</option>   
                            @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <!-- End Form Group -->
                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label class="mb-3 d-block font-14 bold">Razón del Incidente</label>

                    <div class="d-flex align-items-center mb-3">
                        <!-- Custom Radio -->
                        <div class="custom-radio mr-3">
                            <input type="radio" id="Rutina" name="incident_reason" value="Condicion Insegura">
                            <label for="Rutina"></label>
                        </div>
                        <!-- End Custom Radio -->
                        
                        <label for="Rutina">Condicion Insegura</label>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <!-- Custom Radio -->
                        <div class="custom-radio mr-3">
                            <input type="radio" id="LOTOTO" name="incident_reason" value="Comportamiento Inseguro">
                            <label for="LOTOTO"></label>
                        </div>
                        <!-- End Custom Radio -->
                        
                        <label for="LOTOTO">Comportamiento Inseguro</label>
                    </div>
                </div>
                <!-- End Form Group -->
                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="condition_detected" class="mb-2 bold">Descripcion de la Razón</label>
                    <textarea type="text" class="theme-input-style" id="condition_detected" placeholder="Describe como ocurrio..." name="reason_description"></textarea>
                </div>
                <!-- End Form Group -->
                <!-- Form Group Area -->
                <div class="form-group mb-4">
                    <label for="area" class="mb-2 bold">Nombre de las Personas Involucradas</label>
                    <textarea type="text" class="theme-input-style" id="area" placeholder="Solo si hay involucrados..." name="involbed_people_names"></textarea>
                </div>
                <!-- End Form Group -->
                <!-- Form Group Area -->
                <div class="form-group mb-4">
                    <label for="area" class="mb-2 bold">Describe la Acción de Respuesta</label>
                    <textarea type="text" class="theme-input-style" id="area" placeholder="Como atendiron el incidente..." name="solution_description"></textarea>
                </div>
                <!-- End Form Group -->
                <!-- Form Group -->
                <div class="form-group mb-20 ">
                    
                    <label for="sap" class="mb-2 font-14 bold">SAP de quien reporta</label>
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <input type="search"  oninput="selectPerson(this)" class="theme-input-style " id="sap" autocomplete="off" placeholder="ingresa el SAP" name="sap">
                            <div class="valid-feedback" id="personName"></div>
                        </div>
                    </div>
                    
                </div>
                <datalist id="peopleList">
                    @isset($people)
                    @foreach ($people as $item)
                    <option value="{{$item->sap}}" data-name ="{{$item->name}}">
                    @endforeach
                    @endisset
                </datalist>
                <div class="mb-4">
                    
                </div>
                <!-- End Form Group -->
                <!-- Button Group -->
                <div class="button-group pt-2">
                    <button type="submit" class="btn long">Registrar</button>
                    <a href="{{ url()->previous() }}"  class="link-btn bg-transparent ml-3 soft-pink">Cancelar</a>
                </div>
                <!-- End Button Group -->
            </form>
            <!-- End Form -->
        </div>

    
    </div>

</div>

@endsection
@section('footer')
    
@endsection

@section('js')
    <!-- ======= BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
    <script src="../../../assets/plugins/datepicker/datepicker.min.js"></script>
    <script src="../../../assets/plugins/datepicker/i18n/datepicker.es.js"></script>
    
    <script src="../../../assets/plugins/datepicker/custom-form-datepicker.js"></script>
    <!-- ======= End BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->

    <script type="text/JavaScript">
    function selectPerson() {
            
            
            var val=$('#sap').val();
            var name = $('#peopleList').find('option[value="'+val+'"]').data('name');
            if (name === undefined) {
                $('#sap').removeClass('is-valid')
                $('#sap').addClass('is-invalid')
                $("#personName").text("");
            }else{
                $('#sap').removeClass('is-invalid')
                $('#sap').addClass('is-valid')
                $("#personName").text(name);
            }
            
        }
    </script>

@endsection
