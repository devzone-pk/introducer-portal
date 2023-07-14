<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <link href="{{asset(env('COMPANY_ICON'))}}" rel="icon"/>
    <title>{{env('APP_NAME')}}</title>


    <!-- Web Fonts
    ============================================= -->
    <link rel='stylesheet'
          href='https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i'
          type='text/css'>

    <!-- Stylesheet
    ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{asset('outer/vendor/bootstrap/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('outer/vendor/font-awesome/css/all.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('outer/vendor/bootstrap-select/css/bootstrap-select.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('outer/vendor/currency-flags/css/currency-flags.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('outer/vendor/owl.carousel/assets/owl.carousel.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('outer/css/stylesheet.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('outer/css/custom.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/lamika.css')}}">

    @livewireStyles

</head>
<body class="bg-white">

<!-- Preloader -->
<div id="preloader">
    <div data-loader="dual-ring"></div>
</div>
<!-- Preloader End -->

        @yield('content')

<!-- Document Wrapper end -->

<!-- Script -->
<script src="{{asset('outer/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('outer/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('outer/vendor/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('outer/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('outer/js/theme.js')}}"></script>

<script>
    window.addEventListener('open-modal', event => {
        $('#' + event.detail.model).modal('show');
        //window.scrollTo({ top: 0 });
    });

    window.addEventListener('close-modal', event => {
        $('#' + event.detail.model).modal('hide');
    });

    window.addEventListener('goUp', event => {
        window.scrollTo({top: 0});
    });

</script>
@livewireScripts
</body>
</html>
