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

                
        <div class="col-12">
            <!-- Card -->
            <div class="card mb-30 justify-content-center form-element">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        
                        <h4 class="mb-2 font-20">Registrar Usuario</h4>
                        <ul class="list-inline list-button m-0 mb-3">
                            <li id="user" class="active" onclick="changue(this);">Usuario</li>
                            <li id="userPerson" class="" onclick="changue(this);">Usuario y Persona</li>
                         </ul>
                         <div id="soloUsuario">
                            <form method="POST" action="{{ route('registerUsers') }}">
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
                            <form method="POST" action="{{ route('registerUsers') }}">
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
                                            <label for="position" class="mb-2 font-14 bold">Puesto</label>
                                            <input type="text" id="position" class="theme-input-style" placeholder="Ej. Operador" name="position" required autofocus>
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
            <div class="card mb-30">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="font-20">Lista del Personal</h4>
                        
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
                                <th>SAP</th>
                                <th>Nombre </th>
                                <th>Posicion</th>
                                <th>Rol</th>
                                <th>Accion </th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($users)
                            @foreach ($users as $item)
                            
                            <tr>
                                <td>{{$item->person->sap}}</td>
                                <td>{{$item->person->name}}</td>
                                <td>{{$item->person->position}}</td>
                                <td>{{$item->role->role_name}}</td>
                                <td>
                                    <!-- Edit Invoice Button -->
                                    <div class="invoice-header-right d-flex align-items-start justify-content-around justify-content-sm-start mt-3 mt-sm-0">
                   
                                        <!-- Edit Invoice Button -->
                                        <div class="edit-invoice-btn pr-1 ">
                                            <a href="{{ route('updateperson', [$item->person->id]) }}" class="btn-circle">
                                                <img src="{{ asset('assets/img/svg/writing.svg') }}" alt="" class="svg">
                                            </a>
                                        </div>
                                        <div>
                                            <form method="POST" action="{{route('deleteUser')}}">
                                                <input hidden="true" value="{{$item->id}}" name="id">
                                                <a onclick="deleteUserAlert(this);" class="btn-circle ">
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
<script>
    function deleteUserAlert(selected){
        
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
                Swal.fire({ type: "success", title: "¡Eliminado!", text: "Usuario eliminado.", confirmButtonClass: "btn btn-success" })
            }).fail(function(err) {
                Swal.fire({ title: "Error!", text: " ¡Algo salio mal! intentalo nuevamente", type: "error", confirmButtonClass: "btn long", buttonsStyling: !1 });
            });
                
            }else{
                t.dismiss === Swal.DismissReason.cancel && Swal.fire({ title: "Cancelado", text: "El usuario esta a salvo :)", type: "error", confirmButtonClass: "btn btn-success" });
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