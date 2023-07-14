@extends('inner.layouts.wrapper')


@section('title') Login @endsection


@section('content')


    <div id="main-wrapper">
        <div class="container-fluid px-0">
            <div class="row g-0 min-vh-100">
                <!-- Welcome Text
                ============================================= -->
                <div class="col-md-6">
                    <div class="hero-wrap d-flex align-items-center h-100">
                        <div class="hero-mask opacity-8 bg-primary"></div>
                        <div class="hero-bg hero-bg-scroll"
                             style="background-image:url('./images/bg/image-3.jpg');"></div>
                        <div class="hero-content mx-auto w-100 h-100 d-flex flex-column">
                            <div class="row g-0">
                                <div class="col-10 col-lg-9 mx-auto">
                                    <div class="logo mt-5 mb-5 mb-md-0"><a class="d-flex" href="{{ url('/') }}"
                                        ><img
                                                src="{{ env('COMPANY_LOGO') }}" alt="{{ env('APP_NAME') }}"></a></div>
                                </div>
                            </div>
                            <div class="row g-0 my-auto">
                                <div class="col-10 col-lg-9 mx-auto">
                                    <h1 class="text-11 text-white mb-4">Welcome back!</h1>
                                    <p class="text-4 text-white lh-base mb-5">We are glad to see you again! Instant
                                        deposits, withdrawals & payouts trusted by millions worldwide.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Welcome Text End -->

                <!-- Login Form
                ============================================= -->
                <div class="col-md-6 d-flex align-items-center">
                    <div class="container my-4">
                        <div class="row g-0">
                            <div class="col-11 col-lg-9 col-xl-8 mx-auto">
                                <h3 class="fw-400 mb-4">Log In</h3>

                                @livewire('login')


                                <p class="text-3 text-center text-muted">Don't have an account? <a class="btn-link"
                                                                                                   href="{{ url('register') }}">Sign
                                        Up</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Login Form End -->
            </div>
        </div>
    </div>

@endsection
