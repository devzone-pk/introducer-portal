<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <link href="{{ asset(env('COMPANY_ICON')) }}" rel="icon" />
    <title>@yield('title') - {{ env('APP_NAME') }}</title>


    <!-- Web Fonts
    ============================================= -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <!-- Stylesheet
    ============================================= -->


    <link rel="stylesheet" href="{{ asset('assets/css/libs.bundle.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/theme.bundle.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?id=2" />
    @livewireStyles

</head>

<body>

    {{-- <div id="preloader1">
        <div class="d-flex justify-content-center  align-items-center" style="height: 100%;">

            <img src="{{ asset('assets/img/ogr-loading.gif') }}" alt="icon" class="loading-icon"
                style="width: 180px;">


        </div>
    </div> --}}

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container">

            <!-- Brand -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ env('COMPANY_LOGO') }}" style="width: 90px;" alt="...">
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="navbarCollapse">

                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fe fe-x"></i>
                </button>

                <!-- Navigation -->
                <ul class="navbar-nav   ms-auto ">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ url('/') }}">
                            Home
                        </a>
                    </li>


                    <li class="nav-item ms-3">
                        <a class="nav-link" href="{{ url('how-it-works') }}">
                            How it Works
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="{{ url('about') }}">
                            About Us
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="{{ url('faqs') }}">
                            Help
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="{{ url('sign-in') }}">
                            Login
                        </a>
                    </li>

                </ul>


                <!-- Button -->
                <a class="navbar-btn btn btn-sm btn-primary  " href="{{ url('sign-up') }}">
                    Register
                </a>

            </div>

        </div>
    </nav>

    @yield('content')






    @livewire('forgot-password-request')

    <!-- Cookie Banner -->
    <div id="cb-cookie-banner" class="alert alert-dark text-center mb-0" role="alert">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-12 col-md-8">
                    <p class="text-start fs-10">
                        We use cookies to improve your experience on our site and to show you relevant information. To
                        find
                        out more, read our Updated
                        <a class="text-secondary fw-bold text-decoration-underline"
                            href="{{ url('privacy-policy') }}">Privacy
                            Policy</a> and <a class="text-secondary fw-bold text-decoration-underline"
                            href="{{ url('terms-and-conditions') }}">Terms & Conditions</a>.

                    </p>
                </div>
                <div class="col-12 col-md-4  d-flex justify-content-end">
                    <button type="button" class="btn btn-primary btn-sm " onclick="window.cb_hideCookieBanner()">
                        Okay
                    </button>
                    {{--                <a href=""> --}}
                    {{--                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"> --}}
                    {{--                        <path d="M20 1L1 20" stroke="#161C2D" stroke-width="2" stroke-linecap="round" --}}
                    {{--                              stroke-linejoin="round"/> --}}
                    {{--                        <path d="M1 1L20 20" stroke="#161C2D" stroke-width="2" stroke-linecap="round" --}}
                    {{--                              stroke-linejoin="round"/> --}}
                    {{--                    </svg> --}}

                    {{--                </a> --}}

                </div>
            </div>


        </div>
    </div>
    <!-- End of Cookie Banner -->

    <section class="py-8 py-md-11 " style="background-image: url(/assets/img/pattern.webp);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 text-center">


                    <!-- Heading -->
                    <h1 class="display-4  ">
                        Need Assistance?
                    </h1>

                    <!-- Text -->
                    <p class="fs-lg  mb-6 mb-md-8">
                        Providing reliable assistance for all your needs.
                    </p>

                    <!-- Button -->
                    <a href="{{ url('contact-us') }}" class="btn btn-primary lift">
                        Contact Us <i class="fe fe-arrow-right ms-2"></i>
                    </a>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>

    <footer class="py-8 py-md-11" style="background-color: #002f6c">
        <div class="container">
            <div class="row" data-aos="fade-up">
                <div class="col-12 col-md-5 text-white">

                    <!-- Brand -->
                    {{--                <img class="w-25" src="{{ env('COMPANY_LOGO') }}" alt="..." class="footer-brand img-fluid mb-2"> --}}
                    <h6 class="fw-bold mt-2 text-uppercase text-white">

                        About Orium Pay</h6>
                    <!-- Text -->
                    <p class="text-white fs-14px mb-2 my-2">
                        OriumPay is a trading name of Orium Global Resources Limited that is a company registered in
                        Scotland (registration number SC769545). Orium Global Resources Limited is registered with
                        Financial
                        Conduct Authority (FCA).
                        <br>
                        <br>
                        Registration details are as follows:
                        <br>
                        <br>
                        PSD FRN:998336<br>
                        HMRC:XXML00000152409<br>
                        ICO Registration # :ZB622346<br>
                        FCA FRN:927726<br>
                    </p>
                </div>

                <div class="col-12 col-md-2">

                    <!-- Heading -->
                    <h6 class="fw-bold mt-2 text-uppercase text-white">
                        Corporate
                    </h6>

                    <!-- List -->
                    <ul class="list-unstyled text-muted mb-6 fs-14px mb-md-8 mb-lg-0">
                        <li class="mb-1">
                            <a href="{{ url('/') }}" class="text-white">
                                Home
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="{{ url('about') }}" class="text-white">
                                About Us
                            </a>
                        </li>

                        <li class="mb-1">
                            <a href="{{ url('about') }}" class="text-white">
                                How it works
                            </a>
                        </li>

                        <li class="mb-1">
                            <a href="{{ url('faqs') }}" class="text-white">
                                Help
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="{{ url('contact-us') }}" class="text-white">
                                Contact Us
                            </a>
                        </li>
                        {{--                    <li class="mb-1"> --}}
                        {{--                        <a href="{{ url('sign-in') }}" class="text-white"> --}}
                        {{--                            Login --}}
                        {{--                        </a> --}}
                        {{--                    </li> --}}
                        {{--                    <li class="mb-1"> --}}
                        {{--                        <a href="{{ url('sign-up') }}" class="text-white"> --}}
                        {{--                            Register --}}
                        {{--                        </a> --}}
                        {{--                    </li> --}}
                    </ul>

                </div>
                <div class="col-12 col-md-2">

                    <!-- Heading -->
                    <h6 class="fw-bold mt-2 text-uppercase text-white">
                        Legal
                    </h6>

                    <!-- List -->
                    <ul class="list-unstyled text-muted mb-6 fs-14px mb-md-8 mb-lg-0">
                        <li class="mb-1">
                            <a href="{{ url('terms-and-conditions') }}" class="text-white">
                                Terms & Conditions
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="{{ url('privacy-policy') }}" class="text-white">
                                Privacy Notice
                            </a>
                        </li>

                        <li class="mb-1">
                            <a href="{{ url('faqs') }}" class="text-white">
                                FAQs
                            </a>
                        </li>

                        <li class="mb-1">
                            <a href="{{ url('anti-fraud-policy') }}" class="text-white">
                                Anti Fraud Policy
                            </a>
                        </li>


                        <li class="mb-1">
                            <a href="{{ url('gdpr-policy') }}" class="text-white">
                                GDPR Policy
                            </a>
                        </li>

                        <li class="mb-1">
                            <a href="{{ url('refer-friend') }}" class="text-white">
                                Refer a Friend
                            </a>
                        </li>

                        {{--                    <li class="mb-1"> --}}
                        {{--                        <a href="https://www.takefive-stopfraud.org.uk/" class="text-white"> --}}
                        {{--                            Scam Awareness --}}
                        {{--                        </a> --}}
                        {{--                    </li> --}}
                    </ul>

                </div>


                <div class="col-12 col-md-3">

                    <!-- Heading -->
                    <h6 class="fw-bold mt-2 text-uppercase text-white">

                        Address Info</h6>
                    <!-- Text -->
                    <p class="text-white fs-14px mb-2 my-2">
                        13 Smithfield Road, Aberdeen,<br>
                        Scotland, AB24 4NR<br>
                        Landline: +44(0)1224453978<br>
                        Phone: +44(0)7821662833<br>
                        Whatsapp: +44(0)7821662833<br>
                        Email: info@oriumpay.com
                    </p>

                    <!-- Social -->


                    <ul class="list-unstyled list-inline list-social mb-6 mb-md-3">
                        <li class="list-inline-item list-social-item me-3">
                            <a href="" class="text-decoration-none" target="_blank">
                                <img src="/assets/img/icons/social/instagram.svg" class="list-social-icon"
                                    alt="...">
                            </a>
                        </li>
                        <li class="list-inline-item list-social-item me-3">
                            <a href="" class="text-decoration-none" target="_blank">
                                <img src="/assets/img/icons/social/facebook.svg" class="list-social-icon"
                                    alt="...">
                            </a>
                        </li>
                        <li class="list-inline-item list-social-item me-3">
                            <a href="" class="text-decoration-none" target="_blank">
                                <img src="/assets/img/icons/social/twitter.svg" class="list-social-icon"
                                    alt="...">
                            </a>
                        </li>
                        <li class="list-inline-item list-social-item me-3">
                            <a href="" class="text-decoration-none" target="_blank">
                                <img src="/assets/img/icons/social/linkedin.svg" class="list-social-icon"
                                    alt="...">
                            </a>
                        </li>
                        {{--                    <li class="list-inline-item list-social-item"> --}}
                        {{--                        <a href="#!" class="text-decoration-none"> --}}
                        {{--                            <img src="/assets/img/icons/social/pinterest.svg" class="list-social-icon" alt="..."> --}}
                        {{--                        </a> --}}
                        {{--                    </li> --}}
                    </ul>

                    <ul class="list-unstyled list-inline list-social mb-md-0">

                        <li class="list-inline-item list-social-item">
                            <a href="#!" class="text-reset d-inline-block">
                                <img src="assets/img/buttons/button-play.png" class="img-fluid" alt="..."
                                    style="max-width: 97px;">
                            </a>
                        </li>
                        <li class="list-inline-item list-social-item me-3">
                            <a href="#!" class="text-reset d-inline-block me-1">
                                <img src="assets/img/buttons/button-app.png" class="img-fluid" alt="..."
                                    style="max-width: 97px;">
                            </a>
                        </li>
                    </ul>


                </div>


            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </footer>
    <section class="py-2 bg-black">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <p class="text-white fs-12px text-center p-0 m-0">
                        Copyright © {{ date('Y') }} {{ config('app.company_name') }}. All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="{{ asset('assets/js/vendor.bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/theme.bundle.js') }}"></script>

    <script>
        window.addEventListener('open-modal', event => {
            $('#' + event.detail.model).modal('show');
            //window.scrollTo({ top: 0 });
        });

        window.addEventListener('close-modal', event => {
            $('#' + event.detail.model).modal('hide');
        });

        window.addEventListener('focus-out', event => {
            $('#' + event.detail.id).blur();
        });


        window.addEventListener('refresh-select2', event => {

            $('.select-dropdown-rate').select2('destroy');
            $('.select-dropdown-simple').select2('destroy');


            $('.select-dropdown-simple').select2({
                theme: "bootstrap-5",

            });
            $('.select-dropdown-rate').select2({
                theme: "bootstrap-5",

                templateResult: function(value) {
                    if (value.element) {
                        return $("<div class='d-flex flex-column'><div>" + value.text +
                            "</div>  <div style='font-weight: bold;'>" + $(value.element).attr(
                                "data-rate") + "</div></div>");
                    }
                    return 'Choose';
                },
                templateSelection: function(value) {
                    if (value.element) {
                        return $("<div class='d-flex flex-column'><div>" + value.text + "</div></div>");
                    }
                    return 'Choose';
                }
            });

        });

        $(window).on('load', function() {
            const myTimeout = setTimeout(loader, 1000);
        });


        function loader() {
            var element = document.getElementById("preloader");
            element.style.display = "none";
        }

        $(document).ready(function() {
            // Preloader

            if (window.performance) {
                var navEntries = window.performance.getEntriesByType('navigation');
                if (navEntries.length > 0 && navEntries[0].type === 'back_forward') {
                    location.reload();
                } else if (window.performance.navigation &&
                    window.performance.navigation.type == window.performance.navigation.TYPE_BACK_FORWARD) {
                    location.reload();
                } else {
                    //console.log('This is normal page load');
                }
            } else {
                // console.log("Unfortunately, your browser doesn't support this API");
            }


            $(document).on('keyup', '.only-name', function() {
                this.value = this.value.replace(/[^a-z ]/gi, '');
            });


            $('.select-dropdown').select2({
                theme: "bootstrap-5",

                templateResult: function(value) {
                    if (value.element) {
                        return $(
                            "<div class='d-flex   align-items-center align-self-center'><img class='rounded-1' style='width:50px;' src='{{ url('assets/flags') }}/" +
                            $(value.element).attr("data-iso2") +
                            ".svg'/>  <div style='font-size:20px;' class='ps-2'>" + value.text +
                            "</div></div>");
                    }
                    return 'Choose';
                },
                templateSelection: function(value) {
                    if (value.element) {
                        return $(
                            "<div class='d-flex  align-items-center align-self-center'><img class='rounded-1' style='width:50px;' src='{{ url('assets/flags') }}/" +
                            $(value.element).attr("data-iso2") +
                            ".svg'/>  <div style='font-size:20px;font-weight:600;' class='ps-2'>" +
                            value.text + "</div></div>");
                    }
                    return 'Choose';
                }
            });
            $('.select-dropdown-rate').select2({
                theme: "bootstrap-5",

                templateResult: function(value) {
                    if (value.element) {

                        return $("<div class='d-flex flex-column'><div>" + value.text +
                            "</div>  <div style='font-weight: bold;'>" + $(value.element).attr(
                                "data-rate") + "</div></div>");
                    }
                    return 'Choose';
                },
                templateSelection: function(value) {
                    if (value.element) {
                        return $("<div class='d-flex flex-column'><div>" + value.text + "</div></div>");
                    }
                    return 'Choose';
                }
            });
            $('.select-dropdown-simple').select2({
                theme: "bootstrap-5",

            });

            $(document).on('keyup', '.only-numbers', function() {
                this.value = this.value.replace(/[^0-9.,]/gi, '');
            });
            $(document).on('keyup', '.only-just-numbers', function() {
                this.value = this.value.replace(/[^0-9,]/gi, '');
            });
            $(document).on('keyup', '.country-code', function() {
                this.value = this.value.replace(/[^0-9+,]/gi, '');
            });
            $(document).on('keyup', '.alphanumeric', function() {
                this.value = this.value.replace(/[^A-Za-z0-9\s]/g, '');
            });
            $(document).on('keyup', '.leading-zero', function() {
                this.value = this.value.replace(/^0+/, '');
            });
            $(document).on('keyup', '.only-alpha', function() {
                this.value = this.value.replace(/[^A-Za-z]/g, '');
            });

        });
    </script>
    <script>
        /*
         * Javascript to show and hide cookie banner using localstorage
         */

        <!--Start of Tawk.to Script-->
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/64d0e05e94cf5d49dc68eeea/1h77uot75';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();

        <!--End of Tawk.to Script -->

        /**
         * @description Shows the cookie banner
         */
        function showCookieBanner() {
            let cookieBanner = document.getElementById("cb-cookie-banner");
            cookieBanner.style.display = "block";
        }

        /**
         * @description Hides the Cookie banner and saves the value to localstorage
         */
        function hideCookieBanner() {
            localStorage.setItem("cb_isCookieAccepted", "yes");

            let cookieBanner = document.getElementById("cb-cookie-banner");
            cookieBanner.style.display = "none";
        }

        /**
         * @description Checks the localstorage and shows Cookie banner based on it.
         */
        function initializeCookieBanner() {
            let isCookieAccepted = localStorage.getItem("cb_isCookieAccepted");
            if (isCookieAccepted === null) {
                localStorage.setItem("cb_isCookieAccepted", "no");
                showCookieBanner();
            }
            if (isCookieAccepted === "no") {
                showCookieBanner();
            }
        }

        // Assigning values to window object
        window.onload = initializeCookieBanner();
        window.cb_hideCookieBanner = hideCookieBanner;
    </script>
    @livewireScripts
    @stack('scripts')
</body>

</html>
