@extends('layouts.app_dashboard')

@section('css')
    <!-- ======= BEGIN PAGE LEVEL PLUGINS STYLES ======= -->
    <link rel="stylesheet" href="assets/plugins/datepicker/datepicker.min.css">
    <!-- ======= END BEGIN PAGE LEVEL PLUGINS STYLES ======= -->
@endsection

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
                <h4 class="font-20 mb-4">Condiciones Inseguras</h4>

                <!-- Form -->
                <form action="{{ route('getUpdateUnsafeC')}}" method="POST">
                @csrf
                <!-- Form Group -->
                    <div class="form-group mb-4">
                        <label for="condition_detected" class="mb-2 bold">Condicion Detectada</label>
                        <input type="text" class="theme-input-style" id="condition_detected" placeholder="" name="condition_detected" value="{{ old('condition_detected') }}">
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="form-group mb-4">
                        <label for="condition_groups" class="mb-2 bold d-block">Tipo de Condicion</label>
                        <div class="custom-select style--two">
                            <select class="theme-input-style" onChange="changeConditionGroup(this);" id="condition_groups" name="condition_groups">
                                @isset($condition_groups)
                                    @foreach ($condition_groups as $item)
                                        <option  value="{{$item->id}}" {{ old('condition_groups') == $item->id ? 'selected' : '' }}>{{$item->group_name}}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="form-group mb-4">
                        <label for="type_condition_id" class="mb-2 bold d-block">Accion</label>
                        <div class="custom-select style--two">
                            <select class="theme-input-style" id="type_condition_id" name="type_condition_id">
                                @isset($type_conditions)
                                    @foreach ($type_conditions as $item)
                                        <option class="conditionGroupId_{{$item->condition_group_id}}" value="{{$item->id}}" {{ old('type_condition_id') == $item->condition_group_id ? 'selected' : '' }}>{{$item->action_name}}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="form-group mb-4">
                        <label class="mb-3 d-block font-14 bold">Origen de Detección</label>

                        <div class="d-flex align-items-center mb-3">
                            <!-- Custom Radio -->
                            <div class="custom-radio mr-3">
                                <input type="radio" id="Rutina" name="detection_origin" value="Rutina" {{ old('detection_origin') == "Rutina" ? 'checked' : '' }}>
                                <label for="Rutina"></label>
                            </div>
                            <!-- End Custom Radio -->

                            <label for="Rutina">Rutina</label>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <!-- Custom Radio -->
                            <div class="custom-radio mr-3">
                                <input type="radio" id="LOTOTO" name="detection_origin" value="Aud. LOTOTO" {{ old('detection_origin') == "Aud. LOTOTO" ? 'checked' : '' }}>
                                <label for="LOTOTO"></label>
                            </div>
                            <!-- End Custom Radio -->

                            <label for="LOTOTO">Aud. LOTOTO</label>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <!-- Custom Radio -->
                            <div class="custom-radio mr-3">
                                <input type="radio" id="DTO" name="detection_origin" value="DTO (OWD)" {{ old('detection_origin') == "DTO (OWD)" ? 'checked' : '' }}>
                                <label for="DTO"></label>
                            </div>
                            <!-- End Custom Radio -->

                            <label for="DTO">DTO (OWD)</label>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <!-- Custom Radio -->
                            <div class="custom-radio mr-3">
                                <input type="radio" id="DPA" name="detection_origin" value="DPA" {{ old('detection_origin') == "DPA" ? 'checked' : '' }}>
                                <label for="DPA"></label>
                            </div>
                            <!-- End Custom Radio -->

                            <label for="DPA">DPA</label>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <!-- Custom Radio -->
                            <div class="custom-radio mr-3">
                                <input type="radio" id="Monitoreo" name="detection_origin" value="Monitoreo de Seguridad" {{ old('detection_origin') == "Monitoreo de Seguridad" ? 'checked' : '' }}>
                                <label for="Monitoreo"></label>
                            </div>
                            <!-- End Custom Radio -->

                            <label for="Monitoreo">Monitoreo de Seguridad</label>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="form-group mb-4">
                        <label class="mb-2 font-14 bold">Fecha Limite</label>

                        <!-- Date Picker -->
                        <div class="dashboard-date style--four">
                       <span class="input-group-addon">
                          <img src="../../../assets/img/svg/calender.svg" alt="" class="svg">
                        </span>

                            <input type="text" id="default-date" placeholder="Select Date" name="deadline" value="{{ old('deadline') }}"/>
                        </div>
                        <!-- End Date Picker -->
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group Department -->
                    <div class="form-group mb-4">
                        <label for="department_id" class="mb-2 bold d-block">Departamento</label>
                        <div class="custom-select style--two">
                            <select class="theme-input-style" id="department_id" onChange="changeDepartment(this);" name="department_id">
                                @isset($departments)
                                    @foreach ($departments as $item)
                                        @if ($item->origin == "INTERNO")
                                            @if (!str_contains($item->name, 'LÍNEA'))
                                                <option value="{{$item->id}}" {{ old('department_id') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
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
                        <label for="responsable_id" class="mb-2 bold d-block">Responsable</label>
                        <div class="custom-select style--two">
                            <select class="theme-input-style" id="responsable_id" name="responsable_id">
                                @isset($peopleSupervisores)
                                    @foreach ($peopleSupervisores as $item)
                                        <option class="departmentId-{{$item->companie_and_department_id}}" value="{{$item->id}}" {{ old('responsable_id') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group Area -->
                    <div class="form-group mb-4">
                        <label for="area" class="mb-2 bold">Area</label>
                        <input type="text" class="theme-input-style" id="area" placeholder="Nombre del area..." name="area" value="{{ old('area') }}">
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group Probability -->
                    <div class="form-group mb-4">
                        <label for="probability" class="mb-2 bold d-block">Probabilidad de Incidencia</label>
                        <div class="custom-select style--two">
                            <select class="theme-input-style" id="probability" onChange="getRisk()" name="probability">
                                <option value="10" {{ old('probability') == "10" ? 'selected' : '' }}>Esperado</option>
                                <option value="6"  {{ old('probability') == "6" ? 'selected' : '' }}>Posible</option>
                                <option value="3"  {{ old('probability') == "3" ? 'selected' : '' }}>Raro</option>
                                <option value="1"  {{ old('probability') == "1" ? 'selected' : '' }}>Improbable pero posible</option>
                                <option value="0.5"  {{ old('probability') == "0.5" ? 'selected' : '' }}>Concebible pero improbable</option>
                                <option value="0.1"  {{ old('probability') == "0.1" ? 'selected' : '' }}>Casi inconcebible</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group Impact -->
                    <div class="form-group mb-4">
                        <label for="impact" class="mb-2 bold d-block">Impacto Potencial </label>
                        <div class="custom-select style--two">
                            <select class="theme-input-style" id="impact" onChange="getRisk()" name="impact">
                                <option value="40" >Catastrofico - Muertes</option>
                                <option value="15" >Muy serio - Una muerte</option>
                                <option value="7" >Serio - Discapacidad</option>
                                <option value="3" >Importante - Lesion con ausencia</option>
                                <option value="1" >Menor - Lesion sin ausencia</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group frequency -->
                    <div class="form-group mb-4">
                        <label for="frequency" class="mb-2 bold d-block">Frecuancia </label>
                        <div class="custom-select style--two">
                            <select class="theme-input-style" id="frequency" onChange="getRisk()" name="frequency">
                                <option value="10" >Continuamente</option>
                                <option value="6" >Regularmente</option>
                                <option value="3" >Ahora y despues</option>
                                <option value="2" >Algunas veces</option>
                                <option value="1" >Rara vez</option>
                                <option value="0.5" >Muy rara vez</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Alert -->
                    <div class="mb-4" id="risk">
                    </div>
                    <!-- End Alert -->

                    <!-- Form Group -->
                    <div class="form-group mb-4">
                        <label class="mb-3 d-block font-14 bold">Alcance de la atencion de la CI</label>

                        <div class="d-flex align-items-center mb-3">
                            <!-- Custom Radio -->
                            <div class="custom-radio mr-3">
                                <input type="radio" id="DEPARTAMENTO" name="scope" value="DEPARTAMENTO" {{ old('scope') == "DEPARTAMENTO" ? 'checked' : '' }}>
                                <label for="DEPARTAMENTO"></label>
                            </div>
                            <!-- End Custom Radio -->

                            <label for="DEPARTAMENTO">DEPARTAMENTO</label>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <!-- Custom Radio -->
                            <div class="custom-radio mr-3">
                                <input type="radio" id="MANTENIMIENTO" name="scope" value="MANTENIMIENTO" {{ old('scope') == "MANTENIMIENTO" ? 'checked' : '' }}>
                                <label for="MANTENIMIENTO"></label>
                            </div>
                            <!-- End Custom Radio -->

                            <label for="MANTENIMIENTO">MANTENIMIENTO</label>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <!-- Custom Radio -->
                            <div class="custom-radio mr-3">
                                <input type="radio" id="CAPEX" name="scope" value="CAPEX" {{ old('scope') == "CAPEX" ? 'checked' : '' }}>
                                <label for="CAPEX"></label>
                            </div>
                            <!-- End Custom Radio -->

                            <label for="CAPEX">CAPEX</label>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group status -->
                    <div class="form-group mb-4">
                        <label for="status" class="mb-2 bold d-block">Estado de la Condicion </label>
                        <div class="custom-select style--two">
                            <select class="theme-input-style" id="status" name="status">
                                <option value="NO INICIADA" >NO INICIADA</option>
                                <option value="EN PROCESO" >EN PROCESO</option>
                                <option value="COMPLETA" >COMPLETA</option>
                                <option value="RETRASADA" >RETRASADA</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="form-group mb-4">
                        <label for="notice_number" class="mb-2 bold"># de aviso SAP</label>
                        <input type="text" class="theme-input-style" id="notice_number" placeholder="No." name="notice_number" value="{{ old('notice_number') }}">
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="form-group mb-20 ">

                        <label for="sap" class="mb-2 font-14 bold">SAP (320XXXXX, 32XXXXXX) ó ID de quien reporta</label>
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <input type="search"  oninput="selectPerson(this)" onkeyup="this.value = this.value.toUpperCase();" style="text-transform:uppercase" class="theme-input-style " id="sap" autocomplete="off" placeholder="ingresa el SAP" name="sap" value="{{ old('sap') }}">
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
                    <!-- End Form Group -->


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

        $(document).ready(function(){
            console.log(document.referrer);
            console.log(window.location.host);
            $("#responsable_id").val("0");
            $("#probability").val("0");
            $("#impact").val("0");
            $("#frequency").val("0");
            $("#type_condition_id").val("0");
            $("#department_id").val("0");

            $("#type_condition_id").children().each(function (i) {
                count = 0;
                if ($(this).hasClass("conditionGroupId_"+$("#condition_groups").val())){

                    $(this).show(1);
                    if (count == 0) {
                        count+1;
                        $("#type_condition_id").val($(this).val());
                    }
                } else {
                    $(this).hide(1);
                }
            });


        });

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

        function changeConditionGroup(selected) {
            $("#type_condition_id").val("0");
            $("#type_condition_id").children().each(function (i) {
                count = 0;
                if ($(this).hasClass("conditionGroupId_"+selected.value)) {
                    $(this).show(1);

                    if (count == 0) {
                        count+1;
                        $("#type_condition_id").val($(this).val());
                    }

                } else{
                    $(this).hide(1);
                }
            });
        }

        function changeDepartment(selected) {
            $("#responsable_id").val("0");
            $("#responsable_id").children().each(function (i) {
                count = 0;
                if ($(this).hasClass("departmentId-"+selected.value)) {
                    $(this).show(1);

                    if (count == 0) {
                        count+1;
                        $("#responsable_id").val($(this).val());
                    }

                } else{
                    $(this).hide(1);
                }
            });
        }

        function getRisk() {

            risk = $("#probability").val() * $("#impact").val() * $("#frequency").val()

            if (risk > 0 && risk <= 20) {

                $("#risk").children().remove();
                $("#risk").append('<div class="priority"><p class="assign-menu bold font-14 text-center bg-success">Riesgo aceptable</p></div>');
            }
            if (risk > 20 && risk <= 70) {

                $("#risk").children().remove();
                $("#risk").append('<div class="priority"><p class="assign-menu bold font-14 text-center bg-success">Requiere atención</p></div>');
            }
            if (risk > 70 && risk <= 200) {

                $("#risk").children().remove();
                $("#risk").append('<div class="priority"><p class="assign-menu bold font-14 text-center bg-warning">Corrección requerida</p></div>');
            }
            if (risk > 200 && risk <= 400) {

                $("#risk").children().remove();
                $("#risk").append('<div class="priority"><p class="assign-menu bold font-14 text-center bg-warning">Atender de forma inmediata</p></div>');
            }
            if (risk > 400) {

                $("#risk").children().remove();
                $("#risk").append('<div class="priority"><p class="assign-menu bold font-14 text-center bg-danger">Detener actividad hasta su corrección</p></div>');
            }

        }

    </script>
@endsection
