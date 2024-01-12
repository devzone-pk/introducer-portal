<!doctype html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="keywords" content=""/>
    <link rel="icon" type="image/png" href="#" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="#">
    <link rel="stylesheet" href="{{asset('mobile/assets/css/style.css')}}?id=20">
    <link rel="stylesheet" href="{{asset('mobile/assets/css/picker.css')}}">
    <link rel="stylesheet" href="{{asset('mobile/assets/css/custom.css')}}?id=20">

    @livewireStyles
    @stack('css')

</head>
<body>


<!-- loader -->
{{--<div id="loader">--}}
{{--    <div class="d-flex justify-content-center  align-items-center" style=" height: 100%;">--}}
{{--        <img style="width: 180px;" src="{{ asset('assets/img/ogr-loading.gif') }}" alt="icon"--}}
{{--             class="loading-icon">--}}
{{--    </div>--}}
{{--</div>--}}
<!-- * loader -->


@yield('content')

@include('mobile.include.sidebar')

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>

<script src="{{ asset('mobile/assets/js/lib/bootstrap.min.js') }}"></script>
<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- Splide -->
<script src="{{ asset('mobile/assets/js/plugins/splide/splide.min.js') }}"></script>
<!-- ProgressBar js -->
<script src="{{ asset('mobile/assets/js/plugins/progressbar-js/progressbar.min.js') }}"></script>
<!-- Base Js File -->
<script src="{{ asset('mobile/assets/js/base.js') }}?id=992"></script>
<script src="{{ asset('mobile/assets/js/picker.js') }}"></script>

@livewireScripts
<script>
    window.livewire.onError(statusCode => {
        return false;
    })

    function hideMe() {


        $("#have-coupon").addClass('d-none');
        $("#have-coupon-input").removeClass('d-none');

    }

    function showHidePassword() {
        var x = document.getElementById("signup-password");
        var btn = document.getElementById("signup-password-btn");

        if (x.type === "password") {
            x.type = "text";

            $("#eye-hide").addClass('d-none');
            $("#eye-show").removeClass('d-none');

        } else {
            x.type = "password";
            $("#eye-show").addClass('d-none');
            $("#eye-hide").removeClass('d-none');
        }
    }


    var profile_dob = document.getElementById('profile_dob');
    if (profile_dob) {
        new Picker(profile_dob, {
            format: 'DD-MM-YYYY',
            headers: true,
            text: {
                title: 'Pick a Date of Birth',
            },
        });
    }


    var issuance_date = document.getElementById('issuance_date');
    if (issuance_date) {
        new Picker(issuance_date, {
            format: 'DD-MM-YYYY',
            headers: true,
            text: {
                title: 'Pick a Issuance Date',
            },
        });
    }


    var expiry_date = document.getElementById('expiry_date');
    if (expiry_date) {
        new Picker(expiry_date, {
            headers: true,
            format: 'DD-MM-YYYY',
            text: {
                title: 'Pick a Expiry Date',
            },
        });
    }

    window.addEventListener('focus-out', event => {
        $('#' + event.detail.id).blur();
    });

    window.addEventListener('open-modal', event => {
        $('#' + event.detail.model).modal('show');

    });

    window.addEventListener('close-modal', event => {
        $('#' + event.detail.model).modal('hide');
    });

    window.addEventListener('show-tab', event => {

        $('.nav-tabs a[href="#' + event.detail.tab + '"]').tab('show');
    });

    //

    $(document).on('show.bs.modal', '#error-dialog', function () {
        // run your validation... ( or shown.bs.modal )

    });


    $("#signup-toast-btn").click(function () {
        $("#signup-toast").removeClass('bottom-0')
    });


    function handleBackNavigation(data) {


        Livewire.emit('handleBackNavigation');


    }

    $(document).ready(function () {


        $(document).on('keyup', '.only-name', function () {
            this.value = this.value.replace(/[^a-z ]/gi, '');
        });

        $(document).on('keyup', '.leading-zero', function () {
            this.value = this.value.replace(/^0+/, '');
        });

        $(document).on('keyup', '.only-alphanum', function () {
            this.value = this.value.replace(/[^a-z0-9 ]/gi, '');
        });

        $(document).on('keyup', '.only-numbers', function () {
            this.value = this.value.replace(/[^0-9.,]/gi, '');
        });
        $(document).on('keyup', '.only-just-numbers', function () {
            this.value = this.value.replace(/[^0-9,]/gi, '');
        });


        $(document).on('keyup', '.only-alpha', function () {
            this.value = this.value.replace(/[^0-9,.]/gi, '');
        });


        $('#exchangeActionSheet').on('shown.bs.modal', function () {
            const input = document.getElementById("youSend");
            input.focus();
            input.select();
        });


    });

    function resetError() {
        $(".validation-error").removeClass("show");

        //Livewire.emit('resetErrors');
    }


</script>

@yield('js')
@stack('scripts')

</body>
</html>
