@extends('layouts.app_dashboard')
@section('css')
@endsection

@section('navbar')
@endsection
@section('clear.content')

        <div class="mn-vh-100 d-flex align-items-center">
            <div class="container">
                <!-- Card -->
                <div id="start" class="card justify-content-center auth-card">
                    <div  class="row justify-content-center">
                        <div class="col-xl-10">
                            
                            <h4 class="mb-2 font-20">Registrar Usuario</h4>
                             <div id="soloUsuario" style="display: none;">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
    
                                    <div class="row">
                                        <div class="col-lg-6">

                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="sap" class="mb-2 font-14 bold">SAP</label>
                                                <input type="search"  oninput="selectPerson(this)" class="theme-input-style " id="sap" autocomplete="off" placeholder="ingresa el SAP" name="sap">
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
                                            
                                        </div>
    
                                        
                                        <!-- Form Group -->
                                        <input type="hidden" value="3" name="role_id">
                                        <!-- End Form Group -->
                                        
        
                                        <div class="col-lg-6">
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="email" class="mb-2 font-14 bold">Correo Electronico</label>
                                                <input type="email" id="email" class="theme-input-style" placeholder="Email Address" name="email">
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
        
                                        <div class="col-lg-6">
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="password" class="mb-2 font-14 bold">Contraseña</label>
                                                <input type="password" id="password" class="theme-input-style" placeholder="Password" name="password" required autocomplete="new-password">
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
        
                                        <div class="col-lg-6">
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="r_password" class="mb-2 font-14 bold">Confirmar contraseña</label>
                                                <input type="password" id="r_password" class="theme-input-style" placeholder="Password" name="password_confirmation" required>
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                    </div>
                                    @error('email', 'sap')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
        
                                    <div class="d-flex align-items-center pt-4">
                                        <button type="submit" class="btn long mr-20">Registrar</button>
                                        <a href="#start" id="userPerson" class="font-12 text_color" onclick="changue(this);">¿No se encuentra tu SAP o ID?</a>
                                    </div>
                                </form>
                             </div>
                             <div id="usuarioYPersona">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
    
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="f_name" class="mb-2 font-14 bold">Nombre</label>
                                                <input type="text" id="f_name" class="theme-input-style" placeholder="Nombre completo" name="name" required autofocus>
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
        
                                        <div class="col-lg-6">
                                            
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="sap2" class="mb-2 font-14 bold">SAP</label>
                                                <input type="search"  oninput="selectPerson2(this)" class="theme-input-style " id="sap2" autocomplete="off" placeholder="ingresa el SAP" name="sap">
                                                <div class="invalid-feedback" id="personName2"></div>
                                                
                                            </div>
                                            <datalist id="peopleList2">
                                                @isset($people)
                                                @foreach ($people as $item)
                                                <option value="{{$item->sap}}" data-name ="{{$item->name}}">
                                                @endforeach
                                                @endisset
                                            </datalist>
                                            <!-- End Form Group -->
                                        </div>
    
                                        <div class="col-lg-6">
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="companie_and_department_id" class="mb-2 bold d-block">Departamento</label>
                                                <div class="custom-select style--two">
                                                    <select class="theme-input-style" id="companie_and_department_id" name="companie_and_department_id">
                                                        @isset($companies_departments)
                                                        @foreach ($companies_departments as $item)
                                                            <option class="{{$item->origin}}" value="{{$item->id}}" >{{$item->name}}</option>
                                                        @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
    
                                        <!-- Form Group -->
                                        <input type="hidden" value="3" name="role_id">
                                        <!-- End Form Group -->
        
                                        <div class="col-lg-6">
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="email" class="mb-2 font-14 bold">Correo Electronico</label>
                                                <input type="email" id="email" class="theme-input-style" placeholder="Email Address" name="email">
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
        
                                        <div class="col-lg-6">
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="password" class="mb-2 font-14 bold">Contraseña</label>
                                                <input type="password" id="password" class="theme-input-style" placeholder="Password" name="password" required autocomplete="new-password">
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
        
                                        <div class="col-lg-6">
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="r_password" class="mb-2 font-14 bold">Confirmar contraseña</label>
                                                <input type="password" id="r_password" class="theme-input-style" placeholder="Password" name="password_confirmation" required>
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                    </div>
                                    @error('email', 'sap')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
        
                                    <div class="d-flex align-items-center pt-4">
                                        <button type="submit" class="btn long mr-20">Registrar</button>
                                        <a href="#start" id="user" class="font-12 text_color" onclick="changue(this);">¿Tu SAP o ID ya esta registrado?</a>
                                    </div>
                                </form>
                             </div>
                            
                        </div>                                    
                    </div>
                </div>
                <!-- End Card -->
            </div>
        </div>

@endsection
@section('footer')
    
@endsection
@section('js')
<script>
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
        function selectPerson2() {
            
            
            var val=$('#sap2').val();
            var name = $('#peopleList2').find('option[value="'+val+'"]').data('name');
            if (name === undefined) {
                $('#sap2').removeClass('is-invalid')
                $('#sap2').addClass('is-valid')
                $("#personName2").text("");
            }else{
                $('#sap2').removeClass('is-valid')
                $('#sap2').addClass('is-invalid')
                $("#personName2").text("El sap pertenece a "+name);
            }
            
        }
    function changue(selected) {
        
        if (selected.id == 'user') {
            $('#userPerson').removeClass('active')
            $('#usuarioYPersona').hide(0);
            $(selected).addClass('active')
            $('#soloUsuario').show(0);
        }
        if (selected.id == 'userPerson') {
            $('#user').removeClass('active')
            $('#soloUsuario').hide(0);
            $(selected).addClass('active')
            $('#usuarioYPersona').show(0);
        }
    }

</script>
@endsection