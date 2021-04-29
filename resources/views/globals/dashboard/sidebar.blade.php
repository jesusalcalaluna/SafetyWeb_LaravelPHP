



 <!-- Sidebar -->
 <nav class="sidebar" data-trigger="scrollbar">
    <!-- Sidebar Header -->
    <div class="sidebar-header d-none d-lg-block">
       <!-- Sidebar Toggle Pin Button -->
       <div class="sidebar-toogle-pin">
          <i class="icofont-tack-pin"></i>
       </div>
       <!-- End Sidebar Toggle Pin Button -->
    </div>
    <!-- End Sidebar Header -->

    <!-- Sidebar Body -->
    <div class="sidebar-body">
       <!-- Nav -->
       
       <ul class="nav">
         <li class="nav-category">Principal</li>
         <li class="@if(Route::current()->getName() == 'dashboard') active @endif">
            <a href="{{ route('dashboard') }}">
               <i class="icofont-pie-chart"></i>
               <span class="link-title">Dashboard</span>
            </a>
         </li>

         <li class="has-sub-item @if(Route::current()->getName() == 'unsafeConditionsForm' || Route::current()->getName() == 'getUnsafeConditions') active sub-menu-opened @endif">
            <a href="#">
                <i class="icofont-exclamation-tringle"></i>
                <span class="link-title">Condiciones Inseguras</span>
            </a>
            <!-- Sub Menu -->
            <ul class="nav sub-menu" style="display: none;">
                <li class="@if(Route::current()->getName() == 'unsafeConditionsForm') active @endif"><a href="{{route('unsafeConditionsForm')}}">Formulario</a></li>
                <li class="@if(Route::current()->getName() == 'getUnsafeConditions') active @endif"><a href="{{route('getUnsafeConditions')}}">Registros</a></li>
            </ul>
            <!-- End Sub Menu -->
         </li> 

         <li class="has-sub-item @if(Route::current()->getName() == 'getCompanionCare' || Route::current()->getName() == 'companionCareForm') active sub-menu-opened @endif">
            <a href="#">
                  <i class="icofont-exclamation-circle "></i>
                <span class="link-title">Cuidado del Compañero</span>
            </a>
            <!-- Sub Menu -->
            <ul class="nav sub-menu" style="display: none;">
                <li class="@if(Route::current()->getName() == 'companionCareForm') active @endif"><a href="{{route('companionCareForm')}}">Formulario</a></li>
                <li class="@if(Route::current()->getName() == 'getCompanionCare') active @endif"><a href="{{route('getCompanionCare')}}">Registros</a></li>
            </ul>
            <!-- End Sub Menu -->
         </li>

         <li class="nav-category">Trabajadores</li>
         <li class="">
            <a href="{{route('registerUsers')}}">
                <i class="icofont-ui-user"></i>
                <span class="link-title">Administrar Usuarios</span>
            </a>
         </li>
         @if (Auth::user()->role->role_name == "ADMINISTRADOR")
         <li class="@if(Route::current()->getName() == 'pepleTableIntern') active  @endif">
            <a href="{{ route('pepleTableIntern') }}">
                <i class="icofont-people"></i>
                <span class="link-title">Personal Interno</span>
            </a>
         </li>
         <li class="@if(Route::current()->getName() == 'pepleTableExtern') active  @endif">
            <a href="{{ route('pepleTableExtern') }}">
                <i class="icofont-people"></i>
                <span class="link-title">Personal Externo</span>
            </a>
         </li>
         @else
         <li class="@if(Route::current()->getName() == 'pepleTable') active  @endif">
            <a href="{{ route('pepleTable') }}">
                <i class="icofont-people"></i>
                <span class="link-title">Personal</span>
            </a>
         </li>
         @endif
         
         
         
       </ul>
       <!-- End Nav -->
    </div>
    <!-- End Sidebar Body -->
 </nav>
 <!-- End Sidebar -->