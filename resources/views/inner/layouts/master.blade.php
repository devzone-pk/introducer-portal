<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <link href="{{asset(env('COMPANY_ICON'))}}" rel="icon"/>
    <title>@yield('title') - {{env('APP_NAME')}}</title>


    <!-- Web Fonts
    ============================================= -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700&display=swap"
          rel="stylesheet">
    <!-- Stylesheet
    ============================================= -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/libs.bundle.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/theme.bundle.css') }}"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"/>
    @yield('css')
    <link rel="stylesheet" href="{{ asset('assets/css/custom-inner.css') }}"/>
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>

</head>
<body class="">

<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="{{ url('/dashboard') }}">
            <img src="{{ env('COMPANY_LOGO') }}" class="navbar-brand-img" alt="">
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbarCollapse">

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fe fe-x"></i>
            </button>

            <!-- Navigation -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item ">
                    <a class="nav-link "   href="{{ url('dashboard') }}" >
                        Dashboard
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link "   href="{{ url('transfer/history') }}" >
                        Transactions
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link "   href="{{ url('customer-support') }}" >
                        Support
                    </a>
                </li>



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDocumentation" data-bs-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                        Settings
                    </a>
                    <div class="dropdown-menu dropdown-menu-md" aria-labelledby="navbarDocumentation">
                        <div class="list-group list-group-flush">
                            <a class="list-group-item" href="{{ url('recipients') }}">
                                <!-- Content -->
                                <div class="ms-4">

                                    <!-- Heading -->
                                    <h6 class="fw-bold text-uppercase text-primary mb-0">
                                        My Receivers
                                    </h6>

                                    <!-- Text -->
                                    <p class="fs-sm text-gray-700 mb-0">
                                        Manage your beloved receivers
                                    </p>

                                </div>
                            </a>
                            <a class="list-group-item" href="{{ url('user/documents') }}">
                                <!-- Icon -->
                                <!-- Content -->
                                <div class="ms-4">

                                    <!-- Heading -->
                                    <h6 class="fw-bold text-uppercase text-primary mb-0">
                                        My Documents
                                    </h6>

                                    <!-- Text -->
                                    <p class="fs-sm text-gray-700 mb-0">
                                        Upload your documents
                                    </p>

                                </div>

                            </a>
                            <a class="list-group-item" href="{{ url('profile') }}">

                                <!-- Icon -->
                                <!-- Content -->
                                <div class="ms-4">
                                    <!-- Heading -->
                                    <h6 class="fw-bold text-uppercase text-primary mb-0">
                                        Profile
                                    </h6>

                                    <!-- Text -->
                                    <p class="fs-sm text-gray-700 mb-0">
                                        Edit your profile and address
                                    </p>

                                </div>

                            </a>
                            <a class="list-group-item" href="{{ url('contact-preferences') }}">


                                <div class="ms-4">
                                    <!-- Heading -->
                                    <h6 class="fw-bold text-uppercase text-primary mb-0">
                                        Preferences
                                    </h6>

                                    <!-- Text -->
                                    <p class="fs-sm text-gray-700 mb-0">
                                        Set your preferences to receive notifications
                                    </p>

                                </div>

                            </a>
                            <a class="list-group-item" href="{{ url('refer-friend') }}">


                                <div class="ms-4">
                                    <!-- Heading -->
                                    <h6 class="fw-bold text-uppercase text-primary mb-0">
                                        Refer Friend
                                    </h6>

                                    <!-- Text -->
                                    <p class="fs-sm text-gray-700 mb-0">
                                        Refer your friends and earn benefits
                                    </p>

                                </div>

                            </a>
                            <a class="list-group-item" href="{{ url('logout') }}">


                                <div class="ms-4">
                                    <!-- Heading -->
                                    <h6 class="fw-bold text-uppercase text-primary mb-0">
                                        Logout
                                    </h6>

                                    <!-- Text -->
                                    <p class="fs-sm text-gray-700 mb-0">
                                        Before leaving, don't forget to log out
                                    </p>

                                </div>

                            </a>

                        </div>
                    </div>
                </li>
            </ul>

            <!-- Button -->
            <a class="navbar-btn btn btn-sm btn-primary " href="{{ url('send/money') }}" >
                Send Money
            </a>

        </div>

    </div>
</nav>






{{--<section class="pt-6  pb-6 pt-md-6 mb-md-6">--}}
{{--    <div class="container-md">--}}

{{--        <div class="row align-items-center">--}}
{{--            <div class="col-12 col-md">--}}

{{--                <div class="row">--}}
{{--                    <div class="col-auto">--}}


{{--                        <div class="icon-circle bg-primary text-white">--}}
{{--                            <i class="fe fe-users"></i>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <div class="col ms-n4">--}}

{{--                        <!-- Heading -->--}}
{{--                        <h2 class="fw-bold mb-0">--}}
{{--                            {{ session('name') }}--}}
{{--                        </h2>--}}

{{--                        <!-- Text -->--}}
{{--                        <p class="fs-lg text-gray-700 mb-0">--}}
{{--                            {{ session('email') }}--}}
{{--                        </p>--}}

{{--                    </div>--}}
{{--                </div> <!-- / .row -->--}}

{{--            </div>--}}

{{--            <div class="col-auto mt-md-0 mt-5">--}}

{{--                <a href="#!" class="text-reset d-inline-block me-1">--}}
{{--                    <img src="/assets/img/buttons/button-app.png" class="img-fluid" alt="..." style="max-width: 155px;">--}}
{{--                </a>--}}

{{--                <a href="#!" class="text-reset d-inline-block">--}}
{{--                    <img src="/assets/img/buttons/button-play.png" class="img-fluid" alt="..." style="max-width: 155px;">--}}
{{--                </a>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div> <!-- / .container -->--}}
{{--</section>--}}


@yield('content')

@livewire('inner.update-password')

<section class="py-2 bg-black">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <p class="text-gray fs-12px text-center p-0 m-0">
                    Copyright © {{ date('Y') }} {{ config('app.company_name') }}. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('assets/js/vendor.bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/js/theme.bundle.js') }}"></script>
@yield('js')

<script>


    window.addEventListener('open-modal', event => {
        $('#' + event.detail.model).modal('show');
        //window.scrollTo({ top: 0 });
    });


    window.addEventListener('focus-out', event => {
        $('#' + event.detail.id).blur();
    });

    //

    window.addEventListener('close-modal', event => {
        $('#' + event.detail.model).modal('hide');
    });

    window.addEventListener('goUp', event => {
        //  window.scrollTo({top: 0});
    });



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


        $(document).on('keyup', '.only-alpha', function () {
            this.value = this.value.replace(/[^0-9,.]/gi, '');
        });


        $('#exchangeActionSheet').on('shown.bs.modal', function () {
            const input = document.getElementById("youSend");
            input.focus();
            input.select();
        });


    });


</script>
@livewireScripts
<script>
    window.livewire.onError(statusCode => {
        //   return false;
    });
</script>


</body>
</html>
