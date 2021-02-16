<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <!-- Basic Page Needs -->
        @include('globals.metas')
        
        <title>{{ config('app.name') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="favicon.png">

        @include('globals.css')

    </head>
    <body class="homepage">
        <h2 class="color-title-red text-center">¡PAGINA EN DESARROLLO!</h2>
            
        <!-- Preloader -->
        @include('globals.preloader')

        

        <!-- Page Wrapper -->
        <div class="wrapper">

            <!-- Page Heading -->
            <header>
                <div class="header-area">

                    <!-- Top Contact Info -->
                    @include('globals.contact-info')
    
                    <!-- Main Navigation Section -->
                    @include('globals.navbar')
                </div>
            </header>

            <!-- Page Content -->
            <main class="main">

                @yield('content')
                
            </main>
            <!-- Main Content Section -->

            <!-- Footer Section -->
            @include('globals.footer')
            <!-- Footer Section -->

            <!-- back-to-top link -->
            <a href="#0" class="cd-top"> Top </a>
        </div>
        <!-- Page Wrapper
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <!-- Javascripts
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        @include('globals.js')
    </body>
</html>
