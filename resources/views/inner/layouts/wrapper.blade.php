<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1,user-scalable=no, minimum-scale=1.0, shrink-to-fit=no">
    <link href="{{asset(env('COMPANY_ICON'))}}" rel="icon"/>
    <title>@yield('title') - {{ config('app.name') }}</title>


    <!-- Web Fonts
    ============================================= -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Stylesheet
    ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ url('vendor/bootstrap/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ url('vendor/font-awesome/css/all.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ url('vendor/currency-flags/css/currency-flags.min.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/pickadate/themes/default.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/pickadate/themes/default.date.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/stylesheet.css') }}"/>
    <!-- Colors Css -->
    @yield('css')

    <link rel="stylesheet" type="text/css" href="{{ url('css/custom.css') }}?id="{{ rand(0,99999999) }}>
    <link rel="stylesheet" type="text/css" href="{{asset('css/lamika.css')}}">
    @livewireStyles


</head>
<body>
<div id="preloader">
    <div data-loader="dual-ring"></div>
</div>
@yield('content')


<!-- Script -->
<script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ url('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('vendor/pickadate/picker.js') }}"></script>
<script src="{{ url('vendor/pickadate/picker.date.js') }}"></script>

<script src="{{ url('js/theme.js') }}"></script>

@livewireScripts

@yield('js')
<script>


    window.addEventListener('open-modal', event => {
        $('#' + event.detail.model).modal('show');
    });

    window.addEventListener('close-modal', event => {
        $('#' + event.detail.model).modal('hide');

    });

    window.addEventListener('goUp', event => {
        window.scrollTo({top: 0});
    });

    //$('.datepicker').pickadate();

    function changeTypePassword() {
        var x = document.getElementById("password");
        var text = document.getElementById("password-text");
        if (x.type === "password") {
            x.type = "text";
            text.innerHTML = "Hide";
        } else {
            x.type = "password";
            text.innerHTML = "Show";
        }
    }

</script>
</body>
</html>
