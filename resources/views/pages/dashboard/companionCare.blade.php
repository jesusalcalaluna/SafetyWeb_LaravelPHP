@extends('layouts.app_dashboard')

@section('navbar')

    @include('globals.dashboard.navbar')
    @auth
    @if (Auth::user()->role->hierarchy <= 2)
        @include('globals.dashboard.sidebar')
    @endif
    @endauth

@endsection
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="form-element input-sizing">
            <h4 class="font-20 mb-4">Cuidado del Compañero</h4>

            <!-- Form -->
            <form action="{{ route('companionCare')}}" method="POST">
                @csrf

                <!-- Form Group
                    <div class="form-group mb-20">
                        <label for="companionCareSAP" class="mb-2 font-14 bold">Compañero cuidado</label>
                        <input type="search"  oninput="selectCompanionCare(this)" class="theme-input-style " id="companionCareSAP" autocomplete="off" placeholder="SAP/ID del Compañero cuidado" name="companion_to_care_id">
                        <div class="valid-feedback" id="companionCareName">
                        </div>
                    </div>
                    <datalist id="peopleList1">
                        @isset($people)
                        @foreach ($people as $item)
                        <option value="{{$item->sap}}" data-name ="{{$item->name}}">
                        @endforeach
                        @endisset
                    </datalist>
                End Form Group -->

                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="companion_to_care_name" class="mb-2 bold">Compañero Cuidado</label>
                    <input type="text" class="theme-input-style" id="companion_to_care_name" placeholder="Nombre del Compañero cuidado" name="companion_to_care_name" value="{{ old('companion_to_care_name') }}">
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="exampleSelect3" class="mb-2 bold d-block">Tipo de Trabajador</label>
                    <div class="custom-select style--two">
                        <select class="theme-input-style" onChange="selectChangeOrigin(this);" id="exampleSelect3" name="workerType">
                            <option value="INTERNO" {{ old('workerType') == "INTERNO" ? 'selected' : '' }}>INTERNO</option>
                            <option value="EXTERNO" {{ old('workerType') == "EXTERNO" ? 'selected' : '' }}>EXTERNO</option>
                        </select>
                    </div>
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="form-group mb-4" id="EXTERNO">
                    <label for="company_department_name" class="mb-2 bold d-block">Compañia</label>
                    <div class="custom-select style--two">
                        <select class="theme-input-style" id="company_department_name" name="company_department_name">
                            @isset($companies_departments)
                            @foreach ($companies_departments as $item)
                            @if (!str_contains($item->name, 'LÍNEA'))
                            <option class="{{$item->origin}}" value="{{$item->name}}" {{ old('company_department_name') == $item->name ? 'selected' : '' }}>{{$item->name}}</option>
                            @endif
                            @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <!-- End Form Group -->
                <!-- Form Group -->
                <div id="puesto_interno" class="form-group mb-4">
                    <label class="mb-3 d-block font-14 bold">Puesto</label>

                    <div class="d-flex align-items-center mb-3">
                        <!-- Custom Radio -->
                        <div class="custom-radio mr-3">
                            <input type="radio" id="Empleado" name="position_name" value="EMPLEADO" {{ old('position_name') == "EMPLEADO" ? 'checked' : '' }}>
                            <label for="Empleado"></label>
                        </div>
                        <!-- End Custom Radio -->

                        <label for="Empleado">Empleado</label>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <!-- Custom Radio -->
                        <div class="custom-radio mr-3">
                            <input type="radio" id="Trabajador" name="position_name" value="TRABAJADOR" {{ old('position_name') == "TRABAJADOR" ? 'checked' : '' }}>
                            <label for="Trabajador"></label>
                        </div>
                        <!-- End Custom Radio -->

                        <label for="Trabajador">Trabajador</label>
                    </div>
                </div>
                <!-- End Form Group -->


                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="turn" class="mb-2 bold d-block">Turno</label>
                    <div class="custom-select style--two">
                        <select class="theme-input-style" id="turn" name="turn">
                            <option value="1° Mañana" {{ old('turn') == "1° Mañana" ? 'selected' : '' }}>1° Mañana</option>
                            <option value="2° Tarde" {{ old('turn') == "2° Mañana" ? 'selected' : '' }}>2° Tarde</option>
                            <option value="3° Noche" {{ old('turn') == "3° Mañana" ? 'selected' : '' }}>3° Noche</option>
                        </select>
                    </div>
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="shift_supervisor" class="mb-2 bold">Supervisor en Turno</label>
                    <input type="text" class="theme-input-style" id="shift_supervisor" placeholder="Here is default input field size" name="shift_supervisor" value="{{ old('shift_supervisor') }}">
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="description" class="mb-2 bold d-block">Descripcion</label>
                    <textarea id="description" class="theme-input-style" placeholder="Type Here" name="description" value="{{ old('description') }}"></textarea>
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="corr_prev_pos" class="mb-2 bold d-block">Tipo de Comportamiento</label>
                    <div class="custom-select style--two">
                        <select class="theme-input-style" onChange="selectChangeComportamiento(this);" id="corr_prev_pos" name="corr_prev_pos">
                            <option value="COMPORTAMIENTO INSEGURO" {{ old('corr_prev_pos') == "COMPORTAMIENTO INSEGURO" ? 'selected' : '' }}>COMPORTAMIENTO INSEGURO</option>
                            <option value="COMPORTAMIENTO SEGURO" {{ old('corr_prev_pos') == "COMPORTAMIENTO SEGURO" ? 'selected' : '' }}>COMPORTAMIENTO SEGURO</option>
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
                            <option value="{{$item->id}}" {{ old('behavior_group_id') == $item->id ? 'selected' : '' }}>{{$item->group_name}}</option>
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
                                <option class="behaviorGroupId_{{$item->behavior_group_id}}" value="{{$item->id}}" {{ old('acts_types_id') == $item->id ? 'selected' : '' }}>{{$item->type_name}}</option>
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
                                <option value="SI" {{ old('sif') == "SI" ? 'selected' : '' }}>Si</option>
                                <option value="NO" {{ old('sif') == "NO" ? 'selected' : '' }}>No</option>
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
                                <option value="{{$item->id}}" {{ old('gold_rules_id') == $item->id ? 'selected' : '' }}>{{$item->rule_name}}</option>
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
                            <input type="radio" id="Rutina" name="detection_source" value="Rutina" {{ old('detection_source') == "Rutina" ? 'checked' : '' }}>
                            <label for="Rutina"></label>
                        </div>
                        <!-- End Custom Radio -->

                        <label for="Rutina">Rutina</label>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <!-- Custom Radio -->
                        <div class="custom-radio mr-3">
                            <input type="radio" id="LOTOTO" name="detection_source" value="Aud. LOTOTO" {{ old('detection_source') == "Aud. LOTOTO" ? 'checked' : '' }}>
                            <label for="LOTOTO"></label>
                        </div>
                        <!-- End Custom Radio -->

                        <label for="LOTOTO">Aud. LOTOTO</label>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <!-- Custom Radio -->
                        <div class="custom-radio mr-3">
                            <input type="radio" id="DTO" name="detection_source" value="DTO (OWD)" {{ old('detection_source') == "DTO (OWD)" ? 'checked' : '' }}>
                            <label for="DTO"></label>
                        </div>
                        <!-- End Custom Radio -->

                        <label for="DTO">DTO (OWD)</label>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <!-- Custom Radio -->
                        <div class="custom-radio mr-3">
                            <input type="radio" id="DPA" name="detection_source" value="DPA" {{ old('detection_source') == "DPA" ? 'checked' : '' }}>
                            <label for="DPA"></label>
                        </div>
                        <!-- End Custom Radio -->

                        <label for="DPA">DPA</label>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <!-- Custom Radio -->
                        <div class="custom-radio mr-3">
                            <input type="radio" id="Monitoreo" name="detection_source" value="Monitoreo de Seguridad" {{ old('detection_source') == "Monitoreo de Seguridad" ? 'checked' : '' }}>
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
                                <option value="{{$item->id}}" {{ old('department_where_happens_id') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
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
                    <input type="text" class="theme-input-style" id="specific_area" placeholder="Here is default input field size" name="specific_area" value="{{ old('specific_area') }}">
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div class="form-group mb-20">
                    <label for="sap" class="mb-2 font-14 bold">SAP (320XXXXX, 32XXXXXX) ó ID de quien reporta</label>
                    <input type="search"  oninput="selectPerson(this)" onkeyup="this.value = this.value.toUpperCase();" style="text-transform:uppercase" class="theme-input-style " id="sap" autocomplete="off" placeholder="ingresa tu SAP ó ID" name="people_sap" value="{{ old('people_sap') }}">
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
    <script type="text/JavaScript">
        $(document).ready(function(){
            $(".EXTERNO").hide(1);
            $(".INTERNO").show(1);
            $("#positions").parent().parent().show(1000);
        });

        function selectChangeBehaviorGroup(selected) {
            $('#acts_types_id').val("0");
            $("#acts_types_id").children().each(function(i) {
                cont = 0;
                if ($(this).hasClass("behaviorGroupId_"+selected.value)) {
                    $(this).show(1);

                    if (cont == 0) {
                        cont+1;
                        $("#acts_types_id").val($(this).val());

                    }

                } else {
                    $(this).hide(1);
                }

            });
        }

        function selectChangeOrigin(selected){
            $("#company_department_name").val("0");
            if (selected.value == "EXTERNO") {
                $('#puesto_interno').hide(1);
            } else {
                $('#puesto_interno').show(1);
            }

            $("#company_department_name").children().each(function(i) {

                count = 0;
                if ($(this).hasClass(selected.value)) {
                    $(this).show(1);

                    if (count == 0) {
                        count + 1;

                        $("#company_department_name").val($(this).val());
                    }

                } else {
                    $(this).hide(1);
                }

            });
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

        function selectChangeComportamiento(selected){

            $(".NoCorrectivo").hide(1000);
            $("#acts_types_id").val("");
            $("#sif").val("");
            $("#gold_rules_id").val("");

            if ("COMPORTAMIENTO INSEGURO" == selected.options[selected.selectedIndex].text) {
                console.log("yes");

                $(".NoCorrectivo").show(1000);
            }

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

        function selectCompanionCare() {


            var val=$('#companionCareSAP').val();
            var name = $('#peopleList1').find('option[value="'+val+'"]').data('name');
            if (name === undefined) {
                $('#companionCareSAP').removeClass('is-valid')
                $('#companionCareSAP').addClass('is-invalid')
                $("#companionCareName").text("");
            }else{
                $('#companionCareSAP').removeClass('is-invalid')
                $('#companionCareSAP').addClass('is-valid')
                $("#companionCareName").text(name);
            }

        }


    </script>
@endsection
