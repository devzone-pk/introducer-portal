<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no, minimum-scale=1.0, shrink-to-fit=no">
    <link href="{{asset(env('COMPANY_ICON'))}}" rel="icon"/>
    <title>@yield('title') - {{ config('app.name') }}</title>


    <!-- Web Fonts
    ============================================= -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

    <!-- Stylesheet
    ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ url('vendor/bootstrap/css/bootstrap.min.css') }}"/>

    <!-- Colors Css -->

    <link rel="stylesheet" type="text/css" href="{{ url('css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/lamika.css')}}">



</head>
<body>
<div id="preloader">
    <div data-loader="dual-ring"></div>
</div>


@yield('content')


<!-- Script -->
<script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ url('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('js/theme.js') }}"></script>
</body>
</html>
