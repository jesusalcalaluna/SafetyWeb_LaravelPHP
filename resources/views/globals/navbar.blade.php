<nav id="navbar" class="collapse navbar-collapse main-menu">
    <div class="container">
        <ul class="main-menu">
            <li class="@if(Route::current()->getName() == 'index') active @endif"> <a href="{{route("index")}}"> Home </a></li>
            <li class="dropdown"> <a href="#" data-toggle="dropdown"> Juntas
                <i class="fa fa-chevron-down dropdown-toggle"> </i>  </a>
                <ul>
                    <li> <a href="https://ab-inbev.zoom.us/j/99227948477?pwd=dUpwbEFwMVdBeCsxL1RaM2dnQnhWQT09"> General </a> </li>
                    <li> <a href="https://ab-inbev.zoom.us/j/92085289363?pwd=ZVlqU2swR0VtekoxOWRsbkJCbHh0dz09"> Calidad </a> </li>
                    <li> <a href="https://ab-inbev.zoom.us/j/93099576788?pwd=MjZDRVVBMFRvOE9BWEpWUkVoY1hmUT09"> Envasado</a> </li>
                    <li> <a href="https://ab-inbev.zoom.us/j/92369007836?pwd=RjYrbDhzRWs3U2xMaW1qYXhTWmQzQT09"> Logistica </a> </li>
                    <li> <a href="https://ab-inbev.zoom.us/j/98308534313?pwd=b2FXWmF5N0ExTjFWSVlybGNSQ1Nydz09 "> MA/E&F </a> </li>
                    <li> <a href="https://ab-inbev.zoom.us/j/94310132394?pwd=RkNKeTM0T1YvWDA3Q2U3QmIwMytGdz09"> People </a> </li>
                </ul>
            </li>
            <li class="@if(Route::current()->getName() == 'dashboard') active @endif"> <a href="{{route('dashboard')}}"> Panel de Administrador </a></li>

        </ul>
    </div>
</nav>