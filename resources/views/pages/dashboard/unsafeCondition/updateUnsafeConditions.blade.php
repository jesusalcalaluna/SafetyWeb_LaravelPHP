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
                <h4 class="font-20 mb-4">Actualizar Condicion Insegura</h4>

                <!-- Form -->
                <form action="{{ route('getUpdateUnsafeC', [$unsafeCondition->id])}}" method="POST">
                @csrf
                    <input hidden name="id" value="{{$unsafeCondition->id}}">
                <!-- Form Group -->
                    <div class="form-group mb-4">
                        <label for="condition_detected" class="mb-2 bold">Condicion Detectada</label>
                        <input disabled type="text" class="theme-input-style" id="condition_detected" placeholder="{{ $unsafeCondition->condition_detected }}" name="condition_detected" value="{{ $unsafeCondition->condition_detected }}">
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="form-group mb-4">
                        <label for="condition_groups" class="mb-2 bold d-block">Tipo de Condicion</label>
                        <div class="custom-select style--two">
                            <select disabled class="theme-input-style" onChange="changeConditionGroup(this);" id="condition_groups" name="condition_groups">
                                @isset($condition_groups)
                                    @foreach ($condition_groups as $item)
                                        <option  value="{{$item->id}}" {{ $unsafeCondition->condition_groups == $item->id ? 'selected' : '' }}>{{$item->group_name}}</option>
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
                            <select disabled class="theme-input-style" id="type_condition_id" name="type_condition_id">
                                @isset($type_conditions)
                                    @foreach ($type_conditions as $item)
                                        <option class="conditionGroupId_{{$item->condition_group_id}}" value="{{$item->id}}" {{ $unsafeCondition->type_condition_id == $item->condition_group_id ? 'selected' : '' }}>{{$item->action_name}}</option>
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
                                <input disabled type="radio" id="Rutina" name="detection_origin" value="Rutina" {{ $unsafeCondition->detection_origin == "Rutina" ? 'checked' : '' }}>
                                <label for="Rutina"></label>
                            </div>
                            <!-- End Custom Radio -->

                            <label for="Rutina">Rutina</label>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <!-- Custom Radio -->
                            <div class="custom-radio mr-3">
                                <input disabled type="radio" id="LOTOTO" name="detection_origin" value="Aud. LOTOTO" {{ $unsafeCondition->detection_origin == "Aud. LOTOTO" ? 'checked' : '' }}>
                                <label for="LOTOTO"></label>
                            </div>
                            <!-- End Custom Radio -->

                            <label for="LOTOTO">Aud. LOTOTO</label>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <!-- Custom Radio -->
                            <div class="custom-radio mr-3">
                                <input disabled type="radio" id="DTO" name="detection_origin" value="DTO (OWD)" {{ $unsafeCondition->detection_origin == "DTO (OWD)" ? 'checked' : '' }}>
                                <label for="DTO"></label>
                            </div>
                            <!-- End Custom Radio -->

                            <label for="DTO">DTO (OWD)</label>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <!-- Custom Radio -->
                            <div class="custom-radio mr-3">
                                <input disabled type="radio" id="DPA" name="detection_origin" value="DPA" {{ $unsafeCondition->detection_origin == "DPA" ? 'checked' : '' }}>
                                <label for="DPA"></label>
                            </div>
                            <!-- End Custom Radio -->

                            <label for="DPA">DPA</label>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <!-- Custom Radio -->
                            <div class="custom-radio mr-3">
                                <input disabled type="radio" id="Monitoreo" name="detection_origin" value="Monitoreo de Seguridad" {{ $unsafeCondition->detection_origin == "Monitoreo de Seguridad" ? 'checked' : '' }}>
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

                            <input disabled type="text" id="default-date" placeholder="Select Date" name="deadline" value="{{ $unsafeCondition->deadline }}"/>
                        </div>
                        <!-- End Date Picker -->
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group Department -->
                    <div class="form-group mb-4">
                        <label for="department_id" class="mb-2 bold d-block">Departamento</label>
                        <div class="custom-select style--two">
                            <select disabled class="theme-input-style" id="department_id" onChange="changeDepartment(this);" name="department_id">
                                @isset($departments)
                                    @foreach ($departments as $item)
                                        @if ($item->origin == "INTERNO")
                                            @if (!str_contains($item->name, 'LÍNEA'))
                                                <option value="{{$item->id}}" {{ $unsafeCondition->department_id == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
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
                            <select disabled class="theme-input-style" id="responsable_id" name="responsable_id">
                                @isset($peopleSupervisores)
                                    @foreach ($peopleSupervisores as $item)
                                        <option class="departmentId-{{$item->companie_and_department_id}}" value="{{$item->id}}" {{ $unsafeCondition->responsable_id == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group Area -->
                    <div class="form-group mb-4">
                        <label for="area" class="mb-2 bold">Area</label>
                        <input disabled type="text" class="theme-input-style" id="area" placeholder="Nombre del area..." name="area" value="{{ $unsafeCondition->area }}">
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group Probability -->
                    <div class="form-group mb-4">
                        <label for="probability" class="mb-2 bold d-block">Probabilidad de Incidencia</label>
                        <div class="custom-select style--two">
                            <select disabled class="theme-input-style" id="probability" onChange="getRisk()" name="probability">
                                <option value="10" {{ $unsafeCondition->probability == "10" ? 'selected' : '' }}>Esperado</option>
                                <option value="6"  {{ $unsafeCondition->probability == "6" ? 'selected' : '' }}>Posible</option>
                                <option value="3"  {{ $unsafeCondition->probability == "3" ? 'selected' : '' }}>Raro</option>
                                <option value="1"  {{ $unsafeCondition->probability == "1" ? 'selected' : '' }}>Improbable pero posible</option>
                                <option value="0.5"  {{ $unsafeCondition->probability == "0.5" ? 'selected' : '' }}>Concebible pero improbable</option>
                                <option value="0.1"  {{ $unsafeCondition->probability == "0.1" ? 'selected' : '' }}>Casi inconcebible</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group Impact -->
                    <div class="form-group mb-4">
                        <label for="impact" class="mb-2 bold d-block">Impacto Potencial </label>
                        <div class="custom-select style--two">
                            <select disabled class="theme-input-style" id="impact" onChange="getRisk()" name="impact">
                                <option value="40" {{ $unsafeCondition->impact == "40" ? 'selected' : '' }}>Catastrofico - Muertes</option>
                                <option value="15" {{ $unsafeCondition->impact == "15" ? 'selected' : '' }}>Muy serio - Una muerte</option>
                                <option value="7" {{ $unsafeCondition->impact == "7" ? 'selected' : '' }}>Serio - Discapacidad</option>
                                <option value="3" {{ $unsafeCondition->impact == "3" ? 'selected' : '' }}>Importante - Lesion con ausencia</option>
                                <option value="1" {{ $unsafeCondition->impact == "1" ? 'selected' : '' }}>Menor - Lesion sin ausencia</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group frequency -->
                    <div class="form-group mb-4">
                        <label for="frequency" class="mb-2 bold d-block">Frecuancia </label>
                        <div class="custom-select style--two">
                            <select disabled class="theme-input-style" id="frequency" onChange="getRisk()" name="frequency">
                                <option value="10" {{ $unsafeCondition->frequency == "10" ? 'selected' : '' }}>Continuamente</option>
                                <option value="6" {{ $unsafeCondition->frequency == "6" ? 'selected' : '' }}>Regularmente</option>
                                <option value="3" {{ $unsafeCondition->frequency == "3" ? 'selected' : '' }}>Ahora y despues</option>
                                <option value="2" {{ $unsafeCondition->frequency == "2" ? 'selected' : '' }}>Algunas veces</option>
                                <option value="1" {{ $unsafeCondition->frequency == "1" ? 'selected' : '' }}>Rara vez</option>
                                <option value="0.5" {{ $unsafeCondition->frequency == "0.5" ? 'selected' : '' }}>Muy rara vez</option>
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
                                <input disabled type="radio" id="DEPARTAMENTO" name="scope" value="DEPARTAMENTO" {{ $unsafeCondition->scope == "DEPARTAMENTO" ? 'checked' : '' }}>
                                <label for="DEPARTAMENTO"></label>
                            </div>
                            <!-- End Custom Radio -->

                            <label for="DEPARTAMENTO">DEPARTAMENTO</label>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <!-- Custom Radio -->
                            <div class="custom-radio mr-3">
                                <input disabled type="radio" id="MANTENIMIENTO" name="scope" value="MANTENIMIENTO" {{ $unsafeCondition->scope == "MANTENIMIENTO" ? 'checked' : '' }}>
                                <label for="MANTENIMIENTO"></label>
                            </div>
                            <!-- End Custom Radio -->

                            <label for="MANTENIMIENTO">MANTENIMIENTO</label>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <!-- Custom Radio -->
                            <div class="custom-radio mr-3">
                                <input disabled type="radio" id="CAPEX" name="scope" value="CAPEX" {{ $unsafeCondition->scope == "CAPEX" ? 'checked' : '' }}>
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
                            <select disabled class="theme-input-style" id="status" name="status">
                                <option value="NO INICIADA" {{ $unsafeCondition->status == "NO INICIADA" ? 'selected' : '' }}>NO INICIADA</option>
                                <option value="EN PROCESO" {{ $unsafeCondition->status == "EN PROCESO" ? 'selected' : '' }}>EN PROCESO</option>
                                <option value="COMPLETA" {{ $unsafeCondition->status == "COMPLETA" ? 'selected' : '' }}>COMPLETA</option>
                                <option value="RETRASADA" {{ $unsafeCondition->status == "RETRASADA" ? 'selected' : '' }}>RETRASADA</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="form-group mb-4">
                        <label for="notice_number" class="mb-2 bold"># de aviso SAP</label>
                        <input type="text" class="theme-input-style" id="notice_number" placeholder="No." name="notice_number" value="{{ $unsafeCondition->notice_number }}">
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="form-group mb-20 ">

                        <label for="sap" class="mb-2 font-14 bold">SAP (320XXXXX, 32XXXXXX) ó ID de quien reporta</label>
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <input disabled type="search"  oninput="selectPerson(this)" onkeyup="this.value = this.value.toUpperCase();" style="text-transform:uppercase" class="theme-input-style " id="sap" autocomplete="off" placeholder="ingresa el SAP" name="sap" value="{{ $unsafeCondition->reporter->sap }}">
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
                        <button type="submit" class="btn long">Actualizar</button>
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
            //$("#responsable_id").val("0");
            //$("#probability").val("0");
            //$("#impact").val("0");
            //$("#frequency").val("0");
            //$("#type_condition_id").val("0");
            //$("#department_id").val("0");

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
