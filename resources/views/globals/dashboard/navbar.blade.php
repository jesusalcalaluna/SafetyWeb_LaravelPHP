<!-- Header -->
<header class="header fixed-top d-flex align-content-center flex-wrap">
   <!-- Logo -->
   <div class="logo">
      <a href="{{ route('index') }}" class="default-logo"><img src="{{ asset('assets/img/logo.png') }}" alt=""></a>
      <a href="{{ route('index') }}" class="mobile-logo"><img src="{{ asset('assets/img/mobile-logo.png')}}" alt=""></a>
   </div>
   <!-- End Logo -->

   <!-- Main Header -->
   <div class="main-header">
      <div class="container-fluid">
         <div class="row justify-content-between">
            <div class="col-3 col-lg-1 col-xl-4">
               <!-- Header Left -->
               <div class="main-header-left h-100 d-flex align-items-center">
               
               <!-- Main Header User -->
               <div class="main-header-user">
                  <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                     <div class="menu-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                     </div>
                  </a>
                  
                  <div class="dropdown-menu">
                     <a href="{{ route('index') }}">Inicio</a>
                     @if (Auth::user())
                     <a href="{{ route('updateperson', [Auth::user()->id]) }}">Mi Perfil</a>
                     <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">Cerrar sesión</a>
                     </form>
                     @else
                     <a href="{{ route('login') }}">Iniciar sesión</a>
                     @endif
                     
                  </div>
               </div>
               <!-- End Main Header User -->

                  

                  <!-- Main Header Menu -->
                  @if (Auth::user())
                     @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                     <div class="main-header-menu d-block d-lg-none">
                        <div class="header-toogle-menu">
                           <!-- <i class="icofont-navigation-menu"></i> -->
                           <img src="{{ asset('assets/img/menu.png') }}" alt="">
                        </div>
                     </div>
                     @endif
                  @endif
                  
                  <!-- End Main Header Menu -->
               </div>
               
               <!-- End Header Left -->
            </div>
            <div class="col-9 col-lg-11 col-xl-8">
               <!-- Header Right -->
               <div class="main-header-right d-flex justify-content-end">
                  <ul class="nav">
                     
                     <li class="order-2 order-sm-0">
                        @auth
                        {{ Auth::user()->person->name }}
                        @endauth
                     </li>
                     
                  </ul>
               </div>
               <!-- End Header Right -->
            </div>
         </div>
      </div>
   </div>
   <!-- End Main Header -->
</header>
<!-- End Header -->