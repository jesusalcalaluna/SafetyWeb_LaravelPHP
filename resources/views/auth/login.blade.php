@extends('layouts.app_dashboard')
@section('clear.content')
<div class="mn-vh-100 d-flex align-items-center">
    <div class="container">
        <!-- Card -->
        <div class="card justify-content-center auth-card">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-9">
                    <h4 class="mb-5 font-20">Bienvenido a SafetyWeb</h4>

                    <form method="POST" action="{{route('login') }}">
                        @csrf
                        <!-- Form Group -->
                        <div class="form-group mb-20">
                            <label for="email" class="mb-2 font-14 bold">Correo electronico</label>
                            <input type="email" id="email" class="theme-input-style" placeholder="Correo" name="email">
                        </div>
                        <!-- End Form Group -->
                        
                        <!-- Form Group -->
                        <div class="form-group mb-20">
                            <label for="password" class="mb-2 font-14 bold">Contraseña</label>
                            <input type="password" id="password" class="theme-input-style" placeholder="********" name="password">
                        </div>
                        <!-- End Form Group -->

                        <div class="d-flex justify-content-between mb-20">
                            <div class="d-flex align-items-center">
                                <!-- Custom Checkbox -->
                                <label class="custom-checkbox position-relative mr-2">
                                    <input name="remember" type="checkbox" id="remember_me">
                                    <span class="checkmark"></span>
                                </label>
                                <!-- End Custom Checkbox -->
                                
                                <label for="remember_me" class="font-14">Recordarme</label>
                            </div>
                            
                            <a href="{{ route('register') }}" class="font-12 text_color">¿Aun no estas registrado?</a>
                            
                        </div>

                        <div class="d-flex align-items-center">
                            <button type="submit" class="btn long mr-20">Iniciar Sesión</button>
                        </div>
                    </form>
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

@endsection