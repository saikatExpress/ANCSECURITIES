<!DOCTYPE html>
<html lang="en">
    <head>

    <meta charset="utf-8">
    <title>Home - ANC Securities</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name=author content="Themefisher">
    <meta name=generator content="Themefisher Constra HTML Template v1.0">

    <link rel="icon" type="image/png" href="{{ asset('user/assets/logos/8022322.png') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('user/assets/plugins/bootstrap/bootstrap.min.css') }}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ asset('user/assets/plugins/fontawesome/css/all.min.css') }}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{ asset('user/assets/plugins/animate-css/animate.css') }}">
    <!-- slick Carousel -->
    <link rel="stylesheet" href="{{ asset('user/assets/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/plugins/slick/slick-theme.css') }}">
    <!-- Colorbox -->
    <link rel="stylesheet" href="{{ asset('user/assets/plugins/colorbox/colorbox.css') }}">
    <!-- Template styles-->
    <link rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/bo.css') }}">

    </head>

    <body>
        <div class="body-inner">

            <x-main-top-bar/>
            <!--/ Topbar end -->
            <!-- Header start -->
            <header id="header" class="header-one">
                <x-top-bar/>
                <x-side-bar/>
            </header>
            <!--/ Header end -->
            @yield('content')


            <x-footer/>
            <!-- Footer end -->

            <!-- initialize jQuery Library -->
            <script src="{{ asset('user/assets/plugins/jQuery/jquery.min.js') }}"></script>
            <!-- Bootstrap jQuery -->
            <script src="{{ asset('user/assets/plugins/bootstrap/bootstrap.min.js') }}" defer></script>
            <!-- Slick Carousel -->
            <script src="{{ asset('user/assets/plugins/slick/slick.min.js') }}"></script>
            <script src="{{ asset('user/assets/plugins/slick/slick-animation.min.js') }}"></script>
            <!-- Color box -->
            <script src="{{ asset('user/assets/plugins/colorbox/jquery.colorbox.js') }}"></script>
            <!-- shuffle -->
            <script src="{{ asset('user/assets/plugins/shuffle/shuffle.min.js') }}" defer></script>


            <!-- Google Map API Key-->
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>
            <!-- Google Map Plugin-->
            <script src="{{ asset('user/assets/plugins/google-map/map.js') }}" defer></script>

            <!-- Template custom -->
            <script src="{{ asset('user/assets/js/script.js') }}"></script>

        </div>
    <!-- Body inner end -->
    </body>

</html>
