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
                     @if (Auth::user())
                     <a href="{{ route('updateperson', [Auth::user()->id]) }}">My Profile</a>
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
                  <ul class="nav">
                     <li class="d-none d-lg-flex">
                        Jesus Alcala
                     </li>
                  </ul>
                  
                  <!-- End Main Header Menu -->
               </div>
               
               <!-- End Header Left -->
            </div>
            <div class="col-9 col-lg-11 col-xl-8">
               <!-- Header Right -->
               <div class="main-header-right d-flex justify-content-end">
                  <ul class="nav">
                     
                     
                     <li class="d-none d-lg-flex">
                        <!-- Main Header Time -->
                        <div class="main-header-date-time text-right">
                           <h3 class="time">
                              <span id="hours">21</span>
                              <span id="point">:</span>
                              <span id="min">06</span>
                           </h3>
                           <span class="date"><span id="date">Tue, 12 October 2019</span></span>
                        </div>
                        <!-- End Main Header Time -->
                     </li>
                     
                     <li class="order-2 order-sm-0">
                        <!-- Main Header Search -->
                        <div class="main-header-search">
                           <form action="#" class="search-form">
                              <div class="theme-input-group header-search">
                                 <input type="text" class="theme-input-style" placeholder="Search Here">

                                 <button type="submit"><img src="{{ asset('assets/img/svg/search-icon.svg') }}" alt=""
                                       class="svg"></button>
                              </div>
                           </form>
                        </div>
                        <!-- End Main Header Search -->
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