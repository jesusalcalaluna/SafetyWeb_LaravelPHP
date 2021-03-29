@extends('layouts.app_dashboard')

@section('navbar')
    @include('globals.dashboard.navbar')
    @include('globals.dashboard.sidebar')
@endsection
@section('content')

    @isset($person)
    <!-- Main Content -->
    <div class="main-content d-flex flex-column flex-md-row">
        <div class="mb-4 mb-md-0">
            <!-- Tasks Aside -->
            <div class="aside">
                <!-- Aside Body -->
                <nav class="aside-body">
                    <div class="d-flex align-items-center mb-3">
                        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="mr-2"><img src="../../../assets/img/svg/angle-left.svg" alt="" class="svg"></a>
                        <h4 class="regular mr-3 font-20 ">Informacion</h4>
                     </div>
                    
                    <ul class="nav flex-column">
                        <li><a class="active" data-toggle="tab" href="#personal">Personal</a></li>
                        @if ($person->user)
                        <li><a data-toggle="tab" href="#usuario">Usuario</a></li>
                        <li><a data-toggle="tab" href="#c_pass">Change Password</a></li>
                        @endif
                        
                    </ul>
                </nav>
                <!-- End Aside Body -->
            </div>
            <!-- End Tasks Aside -->
        </div>
        <div class="container-fluid">
            <div class="row">
            <div class="col-xl-12 mb-30 mb-xl-0">
                <!-- Card -->
                <div class="card h-100">
                    <div class="card-body p-30">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="personal">
                                <h4 class="mb-4">Informacion Personal</h4>

                                <form action="#">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-6">
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="name" class="mb-2 font-14 bold">Name</label>
                                                <input type="text" id="name" class="theme-input-style" placeholder="Type Here" value="{{ $person->name }}">
                                            </div>
                                            <!-- End Form Group -->
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="sap" class="mb-2 font-14 bold">SAP</label>
                                                <input type="text" id="sap" class="theme-input-style" placeholder="Type Here" value="{{ $person->sap }}">
                                            </div>
                                            <!-- End Form Group -->
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="company" class="mb-2 font-14 bold">Departamento</label>
                                                <input type="text" id="company" class="theme-input-style" placeholder="Type Here" value="{{ $person->company_and_department->name }}">
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="button-group mt-30 mt-xl-n5">
                                                <button type="submit" class="btn">Guardar Cambios</button>
                                                <button type="reset" class="link-btn bg-transparent ml-3 soft-pink">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @if ($person->user)
                            <div class="tab-pane fade" id="usuario">
                                <h4 class="mb-4">Informacion de Usuario</h4>

                                <form action="#">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-6">
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="email" class="mb-2 font-14 bold">Email</label>
                                                <input type="email" id="email" class="theme-input-style" placeholder="Type Here" value="{{ $person->user->email }}">
                                            </div>
                                            <!-- End Form Group -->

                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="company" class="mb-2 font-14 bold">Rol</label>
                                                <input type="text" id="company" class="theme-input-style" placeholder="Type Here">
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="button-group mt-30 mt-xl-n5">
                                                <button type="submit" class="btn">Save Changes</button>
                                                <button type="button" class="link-btn bg-transparent ml-3 soft-pink">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="c_pass">
                                <h4 class="mb-4">Actualizar Contraseña</h4>

                                <form action="#">
                                    <!-- Form Group -->
                                    <div class="form-group mb-20">
                                        <label for="oldPassword" class="mb-2 font-14 bold">Contraseña Actual</label>
                                        <input type="password" id="oldPassword" class="theme-input-style" placeholder="Type Here">
                                    </div>
                                    <!-- End Form Group -->

                                    <!-- Form Group -->
                                    <div class="form-group mb-20">
                                        <label for="newPassword" class="mb-2 font-14 bold">Nueva Contraseña</label>
                                        <input type="password" id="newPassword" class="theme-input-style" placeholder="Type Here">
                                    </div>
                                    <!-- End Form Group -->

                                    <!-- Form Group -->
                                    <div class="form-group mb-20">
                                        <label for="retypePassword" class="mb-2 font-14 bold">Confirmar Contraseña</label>
                                        <input type="password" id="retypePassword" class="theme-input-style" placeholder="Type Here">
                                    </div>
                                    <!-- End Form Group -->

                                    <div class="button-group mt-30">
                                        <button type="submit" class="btn">Save Changes</button>
                                        <button type="button" class="link-btn bg-transparent ml-3 soft-pink">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- End Card -->
            </div>

            </div>
        </div>
    </div>
    <!-- End Main Content -->
    @endisset

@endsection
@section('footer')
    
@endsection
@section('js')
<script type="text/JavaScript">

</script>

@endsection