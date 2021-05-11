<nav id="navbar" class="collapse navbar-collapse main-menu">
    <div class="container">
        <ul class="main-menu">
            <li class="@if(Route::current()->getName() == 'index') active @endif"> <a href="{{route("index")}}"> Home </a></li>
            <li class="@if(Route::current()->getName() == 'dashboard') active @endif"> <a href="{{route('dashboard')}}"> Panel de Administrador </a></li>

            <li class="dropdown"> <a href="#" data-toggle="dropdown"> Reportes
                <i class="fa fa-chevron-down dropdown-toggle"> </i>  </a>
                <ul>
                    <li> <a href="{{route('unsafeConditionsForm')}}"> Condiciones Inseguras </a> </li>
                    <li> <a href="{{route('companionCareForm')}}"> Cuidado del Compañero </a> </li>
                </ul>
            </li>

            <li class="dropdown"> <a href="#" data-toggle="dropdown"> Juntas
                <i class="fa fa-chevron-down dropdown-toggle"> </i>  </a>
                <ul>
                    <li> <a href="https://ab-inbev.zoom.us/j/99227948477?pwd=dUpwbEFwMVdBeCsxL1RaM2dnQnhWQT09" target="_blank"> General </a> </li>
                    <li> <a href="https://ab-inbev.zoom.us/j/92085289363?pwd=ZVlqU2swR0VtekoxOWRsbkJCbHh0dz09" target="_blank"> Calidad </a> </li>
                    <li> <a href="https://ab-inbev.zoom.us/j/93099576788?pwd=MjZDRVVBMFRvOE9BWEpWUkVoY1hmUT09" target="_blank"> Envasado</a> </li>
                    <li> <a href="https://ab-inbev.zoom.us/j/92369007836?pwd=RjYrbDhzRWs3U2xMaW1qYXhTWmQzQT09" target="_blank"> Logistica </a> </li>
                    <li> <a href="https://ab-inbev.zoom.us/j/98308534313?pwd=b2FXWmF5N0ExTjFWSVlybGNSQ1Nydz09" target="_blank"> MA/E&F </a> </li>
                    <li> <a href="https://ab-inbev.zoom.us/j/94310132394?pwd=RkNKeTM0T1YvWDA3Q2U3QmIwMytGdz09" target="_blank"> People </a> </li>
                </ul>
            </li>

            <li class="dropdown"> <a href="#" data-toggle="dropdown"> Equipo de Respuesta
                <i class="fa fa-chevron-down dropdown-toggle"> </i>  </a>
                <ul class="main-menu">

                    <li class="dropdown"> <a href="#" data-toggle="dropdown"> Extintores
                        <i class="fa fa-chevron-down dropdown-toggle"> </i>  </a>
                        <ul>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUM1gwT1dHRTdJMDRNNjlDUUFYN1FFODJERC4u" target="_blank"> Mantenimiento </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUQ0hHVEMzNUpJVFJKVjZTVU0wRU00OUVUOS4u" target="_blank"> Medio Ambiente </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUM1FRRTJEVTlXNDhJMlo1UFNUNFlMODk3RS4u" target="_blank"> Cuarto Fríos </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUNThLNFlEUTRaMzBEWEVaSDZVWFpaOEdUNi4u" target="_blank"> Cocimientos </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUQU9WQThUSzRTU1pMUDI0S0cyVTczREo3Ui4u" target="_blank"> Envasado </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBURDFLSzRYM1RHQ0szS0ZQNzg4UFVSNzRXWS4u" target="_blank"> Oficinas Generales </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nn6Mp9w8-NRGpg1SBI8bhHNURTBTT0tONFIzT0tNMjEwTVJPOVRIQjEyTCQlQCN0PWcu" target="_blank"> Laboratorio Calidad </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUN00yWDlOWThIWE4ySkExUzJVQUc5REtVNy4u" target="_blank"> Montacargas Vehículos </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUN00yWDlOWThIWE4ySkExUzJVQUc5REtVNy4u" target="_blank"> Comedor </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUM0RUT0Y3VVJVSFRDSzZRVkRITk9QNUNIRS4u" target="_blank"> Logística </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUOFpVOE9TRDk2MjBJSFVDWjk5OFZXM1YyUy4u" target="_blank"> CAR </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUNlJWVzBPOEs1NUs0MzFJQVI4MUpBQ1BTRS4u" target="_blank"> Servicios y energía </a> </li>
                        </ul>
                    </li>

                    <li class="dropdown"> <a href="#" data-toggle="dropdown"> Hidrantes
                        <i class="fa fa-chevron-down dropdown-toggle"> </i>  </a>
                        <ul>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUM1gwT1dHRTdJMDRNNjlDUUFYN1FFODJERC4u" target="_blank"> Mantenimiento </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUQ0hHVEMzNUpJVFJKVjZTVU0wRU00OUVUOS4u" target="_blank"> Medio Ambiente </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUM1FRRTJEVTlXNDhJMlo1UFNUNFlMODk3RS4u" target="_blank"> Cuarto Fríos </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUNThLNFlEUTRaMzBEWEVaSDZVWFpaOEdUNi4u" target="_blank"> Cocimientos </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUQU9WQThUSzRTU1pMUDI0S0cyVTczREo3Ui4u" target="_blank"> Envasado </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBURDFLSzRYM1RHQ0szS0ZQNzg4UFVSNzRXWS4u" target="_blank"> Oficinas Generales </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nn6Mp9w8-NRGpg1SBI8bhHNURTBTT0tONFIzT0tNMjEwTVJPOVRIQjEyTCQlQCN0PWcu" target="_blank"> Laboratorio Calidad </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUN00yWDlOWThIWE4ySkExUzJVQUc5REtVNy4u" target="_blank"> Montacargas Vehículos </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUN00yWDlOWThIWE4ySkExUzJVQUc5REtVNy4u" target="_blank"> Comedor </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUM0RUT0Y3VVJVSFRDSzZRVkRITk9QNUNIRS4u" target="_blank"> Logística </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUOFpVOE9TRDk2MjBJSFVDWjk5OFZXM1YyUy4u" target="_blank"> CAR </a> </li>
                            <li> <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=GUvwznZ3lEq4mzdcd6j5Nv9-k5D9rLhFr4TAq2FPrQBUNlJWVzBPOEs1NUs0MzFJQVI4MUpBQ1BTRS4u" target="_blank"> Servicios y energía </a> </li>
                        </ul>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>