@extends('layouts.app_dashboard')
@section('css')
@endsection

@section('navbar')
    @include('globals.dashboard.navbar')
    @include('globals.dashboard.sidebar')
@endsection
@section('content')
<div class="main-content">
    <div class="container-fluid">

        <div class="mn-vh-100 d-flex align-items-center">
            <div class="container">
                <!-- Card -->
                <div class="card justify-content-center form-element">
                    <div class="row justify-content-center">
                        <div class="col-xl-10">
                            
                            <h4 class="mb-2 font-20">Registrar Usuario</h4>
                            <ul class="list-inline list-button m-0 mb-3">
                                <li id="user" class="active" onclick="changue(this);">Usuario</li>
                                <li id="userPerson" class="" onclick="changue(this);">Usuario y Persona</li>
                             </ul>
                             <div id="soloUsuario">
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
    
                                        <div class="col-lg-6">
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="role" class="mb-2 bold d-block">Rol</label>
                                                <div class="custom-select style--two">
                                                    <select class="theme-input-style" id="role" name="role_id">
                                                        @isset($roles)
                                                        @foreach ($roles as $item)
                                                                <option value="{{$item->id}}" >{{$item->role_name}}</option>
                                                        @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
        
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
                                        
                                    </div>
                                </form>
                             </div>
                             <div id="usuarioYPersona" style="display: none;">
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
                                                <label for="sap" class="mb-2 font-14 bold">SAP</label>
                                                <input type="text" id="sap" class="theme-input-style" placeholder="ingresa el SAP" name="sap">
                                            </div>
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
                                                            @if ($item->origin == "INTERNO")
                                                                <option class="{{$item->origin}}" value="{{$item->id}}" >{{$item->name}}</option>
                                                            @endif
                                                        @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
    
                                        <div class="col-lg-6">
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="role" class="mb-2 bold d-block">Rol</label>
                                                <div class="custom-select style--two">
                                                    <select class="theme-input-style" id="role" name="role_id">
                                                        @isset($roles)
                                                        @foreach ($roles as $item)
                                                                <option value="{{$item->id}}" >{{$item->role_name}}</option>
                                                        @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
        
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
                                        
                                    </div>
                                </form>
                             </div>
                            
                        </div>                                    
                    </div>
                </div>
                <!-- End Card -->
            </div>
        </div>
        
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