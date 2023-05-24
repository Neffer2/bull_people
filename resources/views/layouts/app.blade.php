<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Empleo - Bull Marketing</title>
    <link rel="icon" href="{{ asset('img/core-img/favicon.ico') }}">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive/responsive.css') }}" rel="stylesheet">
    <!--<link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>-->
    <script src="https://kit.fontawesome.com/15bc5276a1.js" crossorigin="anonymous"></script>  
    <body>        
    <div id="app">
        <!-- Preloader Start -->
        <div id="preloader">
            <div class="loader">
                <span class="inner1"></span> 
                <span class="inner2"></span>
                <span class="inner3"></span>
            </div>
        </div>
        @include('layouts/recursos/menu') 
        @include('layouts/recursos/banner')
        @include('layouts/recursos/empleos')
        @include('layouts/recursos/permanente')

        {{-- <main class="py-4">
            @yield('content')
        </main> --}}  
        
        @include('layouts/recursos/contenidoHome')
        @include('layouts/recursos/footer')
    </div>

    <script type="text/javascript" src="{{ asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/others/plugins.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/active.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ mix('js/app.js') }}"></script> --}}
</body>
</html>
