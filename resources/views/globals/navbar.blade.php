<nav id="navbar" class="collapse navbar-collapse main-menu">
    <div class="container">
        <ul class="main-menu">
            <li class="@if(Route::current()->getName() == 'index') active @endif"> <a href="{{route("index")}}"> Home </a></li>
            <li class="dropdown"> <a href="#" data-toggle="dropdown"> Juntas
                <i class="fa fa-chevron-down dropdown-toggle"> </i>  </a>
                <ul>
                    <li> <a href="#"> Ambiental </a> </li>
                    <li> <a href="#"> Calidad </a> </li>
                    <li> <a href="#"> Cuartos Frios</a> </li>
                    <li> <a href="#"> Cocimientos </a> </li>
                </ul>
            </li>
            <li class="@if(Route::current()->getName() == 'dashboard') active @endif"> <a href="{{route('dashboard')}}"> Panel de Administrador </a></li>

        </ul>
    </div>
</nav>