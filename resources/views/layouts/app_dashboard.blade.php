<!DOCTYPE html>
<html lang="zxx">

<head>
   <!-- Page Title -->
   <title>{{ config('app.name') }}</title>

   <!-- Meta Data -->
   @include('globals.metas')

   <!-- Favicon -->
   <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

   <!-- Web Fonts -->
   <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&display=swap" rel="stylesheet">
   
   @include('globals.dashboard.css')
   @yield('css')

</head>

<body>
   @yield('clear.content')

   <!-- Offcanval Overlay -->
   <div class="offcanvas-overlay"></div>
   <!-- Offcanval Overlay -->
   
   <!-- Wrapper -->
   <div class="wrapper">

      @yield('navbar')
      
      <!-- Main Wrapper -->
      <div class="main-wrapper">

         @yield('content')

      </div>
      <!-- End Main Wrapper -->
      

      <!-- Footer -->
      @yield('footer')
      <!-- End Footer -->
   </div>
   <!-- End wrapper -->

   @include('globals.dashboard.alerts')

   @include('globals.dashboard.js')
   @yield('js')
</body>

</html>