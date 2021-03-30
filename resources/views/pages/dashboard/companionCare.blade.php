@extends('layouts.app_dashboard')

@section('navbar')
    @include('globals.dashboard.navbar')
    @include('globals.dashboard.sidebar')
@endsection
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="form-element input-sizing">
            <h4 class="font-20 mb-4">Cuidado del Compañero</h4>

            <!-- Form -->
            <form action="{{ route('companionCare')}}" method="POST">
                @csrf
                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="default1" class="mb-2 bold">Compañero Cuidado</label>
                    <input type="text" class="theme-input-style" id="default1" placeholder="Nombre del Compañero cuidado" name="companion_to_care">
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="exampleSelect3" class="mb-2 bold d-block">Tipo de Trabajador</label>
                    <div class="custom-select style--two">
                        <select class="theme-input-style" onChange="selectChange(this);" id="exampleSelect3">
                            <option value="01">INTERNO</option>
                            <option value="02">EXTERNO</option>
                        </select>
                    </div>
                </div>
                <!-- End Form Group -->
                
                <!-- Form Group -->
                <div class="form-group mb-4" id="EXTERNO">
                    <label for="companies_and_departments_id" class="mb-2 bold d-block">Compañia</label>
                    <div class="custom-select style--two">
                        <select class="theme-input-style" id="companies_and_departments_id" name="company_department_id">
                            @isset($companies_departments)
                            @foreach ($companies_departments as $item)
                                <option class="{{$item->origin}}" value="{{$item->id}}" >{{$item->name}}</option>   
                            @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <!-- End Form Group -->                

                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="positions" class="mb-2 bold d-block">Posición</label>
                    <div class="custom-select style--two">
                        <select class="theme-input-style" id="positions" name="position_id">
                            @isset($positions)
                            @foreach ($positions as $item)
                                <option value="{{$item->id}}" >{{$item->name}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="turn" class="mb-2 bold d-block">Turno</label>
                    <div class="custom-select style--two">
                        <select class="theme-input-style" id="turn" name="turn">
                            <option value="1° Mañana" >1° Mañana</option>
                            <option value="2° Tarde" >2° Tarde</option>
                            <option value="3° Noche" >3° Noche</option>
                        </select>
                    </div>
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="shift_supervisor" class="mb-2 bold">Supervisor en Turno</label>
                    <input type="text" class="theme-input-style" id="shift_supervisor" placeholder="Here is default input field size" name="shift_supervisor">
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="description" class="mb-2 bold d-block">Descripcion</label>
                    <textarea id="description" class="theme-input-style" placeholder="Type Here" name="description"></textarea>
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="corr_prev_pos" class="mb-2 bold d-block">Tipo de Comportamiento</label>
                    <div class="custom-select style--two">
                        <select class="theme-input-style" onChange="selectChangeComportamiento(this);" id="corr_prev_pos" name="corr_prev_pos">
                            <option value="CORRECTIVO" >CORRECTIVO</option>
                            <option value="PREVENTIVO" >PREVENTIVO</option>
                            <option value="POSITIVO" >POSITIVO</option>
                        </select>
                    </div>
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="behavior_group_id" class="mb-2 bold d-block">Grupo de Comportamiento</label>
                    <div class="custom-select style--two">
                        <select class="theme-input-style" id="behavior_group_id" onChange="selectChangeBehaviorGroup(this);" name="behavior_group_id">
                            @isset($behaviors_group)
                            @foreach ($behaviors_group as $item)
                            <option value="{{$item->id}}" >{{$item->group_name}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <!-- End Form Group -->

                
                    <!-- Form Group -->
                    <div class="form-group mb-4 NoCorrectivo">
                        <label for="acts_types_id" class="mb-2 bold d-block">Comportamiento</label>
                        <div class="custom-select style--two">
                            <select class="theme-input-style" id="acts_types_id" name="acts_types_id">
                                @isset($act_types)
                                @foreach ($act_types as $item)
                                <option class="{{$item->behavior_group_id}}" value="{{$item->id}}" >{{$item->type_name}}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="form-group mb-4 NoCorrectivo">
                        <label for="sif" class="mb-2 bold d-block">¿Es un Precursor SIF?</label>
                        <div class="custom-select style--two">
                            <select class="theme-input-style" id="sif" name="sif">
                                <option value="SI" >Si</option>
                                <option value="NO" >No</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="form-group mb-4 NoCorrectivo">
                        <label for="gold_rules_id" class="mb-2 bold d-block">¿El Comportamiento infringe una Regla de Oro?</label>
                        <div class="custom-select style--two">
                            <select class="theme-input-style" id="gold_rules_id" name="gold_rules_id">
                                @isset($gold_rules)
                                @foreach ($gold_rules as $item)
                                <option value="{{$item->id}}" >{{$item->rule_name}}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                    <!-- End Form Group -->
                

                <div class="form-group mb-4">
                    <label class="mb-3 d-block font-14 bold">Origen de Detección</label>

                    <div class="d-flex align-items-center mb-3">
                        <!-- Custom Radio -->
                        <div class="custom-radio mr-3">
                            <input type="radio" id="Rutina" name="detection_source" value="Rutina">
                            <label for="Rutina"></label>
                        </div>
                        <!-- End Custom Radio -->
                        
                        <label for="Rutina">Rutina</label>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <!-- Custom Radio -->
                        <div class="custom-radio mr-3">
                            <input type="radio" id="LOTOTO" name="detection_source" value="Aud. LOTOTO">
                            <label for="LOTOTO"></label>
                        </div>
                        <!-- End Custom Radio -->
                        
                        <label for="LOTOTO">Aud. LOTOTO</label>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <!-- Custom Radio -->
                        <div class="custom-radio mr-3">
                            <input type="radio" id="DTO" name="detection_source" value="DTO (OWD)">
                            <label for="DTO"></label>
                        </div>
                        <!-- End Custom Radio -->
                        
                        <label for="DTO">DTO (OWD)</label>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <!-- Custom Radio -->
                        <div class="custom-radio mr-3">
                            <input type="radio" id="DPA" name="detection_source" value="">
                            <label for="DPA"></label>
                        </div>
                        <!-- End Custom Radio -->
                        
                        <label for="DPA">DPA</label>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <!-- Custom Radio -->
                        <div class="custom-radio mr-3">
                            <input type="radio" id="Monitoreo" name="detection_source" value="Monitoreo de Seguridad">
                            <label for="Monitoreo"></label>
                        </div>
                        <!-- End Custom Radio -->
                        
                        <label for="Monitoreo">Monitoreo de Seguridad</label>
                    </div>
                </div>

                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="department_where_happens_id" class="mb-2 bold d-block">Departamento donde ocurre el comportamiento</label>
                    <div class="custom-select style--two">
                        <select class="theme-input-style" id="department_where_happens_id" name="department_where_happens_id">
                            @isset($companies_departments)
                            @foreach ($companies_departments as $item)
                            @if ($item->origin == "INTERNO")
                                <option value="{{$item->id}}" >{{$item->name}}</option> 
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
                    <input type="text" class="theme-input-style" id="specific_area" placeholder="Here is default input field size" name="specific_area">
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="exampleSelect3" class="mb-2 bold d-block">Personal que Reporta</label>
                    <div class="custom-select style--two">
                        <select class="theme-input-style" onChange="selectChangeInformantDepartment(this);" id="exampleSelect3">
                            <option value="01">INTERNO</option>
                            <option value="02">EXTERNO</option>
                        </select>
                    </div>
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="informant_department_company_id" class="mb-2 bold d-block">Departamento de quien reporta</label>
                    <div class="custom-select style--two">
                        <select class="theme-input-style" onChange="selectChangeInformantName(this);" id="informant_department_company_id" name="informant_department_company_id">
                            @isset($companies_departments)
                            @foreach ($companies_departments as $item)
                                <option class="report{{$item->origin}}" value="{{$item->id}}" >{{$item->name}}</option>   
                            @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <!-- End Form Group -->  

                <!-- Form Group -->
                <div class="form-group mb-20">
                    <label for="sap" class="mb-2 font-14 bold">SAP de quien reporta</label>
                    <input type="search"  oninput="selectPerson(this)" class="theme-input-style " id="sap" autocomplete="off" placeholder="ingresa el SAP" name="people_id">
                    <div class="valid-feedback" id="personName">
                        
                    </div>
                    
                </div>
                <datalist id="peopleList">
                    @isset($people)
                    @foreach ($people as $item)
                    <option value="{{$item->sap}}" data-name ="{{$item->name}}">
                    @endforeach
                    @endisset
                </datalist>
                <!-- End Form Group -->


                <div class="mb-4">
                    
                </div>
                <!-- End Form Group -->

                <!-- Button Group -->
                <div class="button-group pt-2">
                    <button type="submit" class="btn long">Registrar</button>
                    <button type="reset" class="link-btn bg-transparent ml-3 soft-pink">Cancelar</button>
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
    <script type="text/JavaScript">
        $(document).ready(function(){
            $(".EXTERNO").hide(1000);
            
        });

        function selectChange(selected){
            if("INTERNO" == selected.options[selected.selectedIndex].text){
                $(".EXTERNO").hide(1);
                $(".INTERNO").show(1);
                $("#positions").parent().parent().show(1000);
            }
            if("EXTERNO" == selected.options[selected.selectedIndex].text){
                $(".INTERNO").hide(1);
                $(".EXTERNO").show(1);
                $("#positions").val("3");
                $("#positions").parent().parent().hide(1000);
                

            }
        }

        function selectChangeComportamiento(selected){
            
            $(".NoCorrectivo").hide(1000);
            $("#acts_types_id").val("");
            $("#sif").val("");
            $("#gold_rules_id").val("");

            if ("Correctivo" == selected.options[selected.selectedIndex].text) {
                console.log("yes");
                
                $(".NoCorrectivo").show(1000);
            }
            
        }

        function selectChangeInformantDepartment(selected){
            if("INTERNO" == selected.options[selected.selectedIndex].text){
                $(".reportEXTERNO").hide(1);
                $(".reportINTERNO").show(1);
            }
            if("EXTERNO" == selected.options[selected.selectedIndex].text){
                $(".reportINTERNO").hide(1);
                $(".reportEXTERNO").show(1);

            }
        }

        function selectChangeInformantName(selected) {
            console.log(selected.value);
            $("#people_id").val("0");
            $("#people_id").children().each(function (i) {
                count = 0;
                if ($(this).hasClass("departmentOrCompanyId-"+selected.value)) {
                    $(this).show(1);

                    if (count == 0) {
                        console.log("entra");
                        count+1;
                        console.log($(this).val())
                        $("#people_id").val($(this).val());
                    }
                    
                } else {
                    $(this).hide(1);
                }

             });
            
        }
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