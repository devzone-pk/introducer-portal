@extends('outer.layouts.master')
@section('title')
    Forgot Password
@endsection
@section('content')


    <section>
        <div class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center gx-0 min-vh-100">
                <div class="col-12 col-md-6 col-lg-4 py-8 py-md-11">

                    <!-- Heading -->
                    <h1 class="mb-0 fw-bold">
                        Reset Password
                    </h1>

                    <!-- Text -->
                    <p class="mb-6 text-muted">
                        Secure & Reliable Money Transfers
                    </p>
                @livewire('forgot-password',['token' => $token])
                <!-- Form -->
                    <!-- Form -->


                </div>
                <div class="col-lg-7 offset-lg-1 align-self-stretch d-none d-lg-block">

                    <!-- Image -->
                    <div class="h-100 w-cover bg-cover"
                         style="background-image: url(/assets/img/covers/xmg-login.png);"></div>

                    <!-- Shape -->
                    <div class="shape shape-start shape-fluid-y text-white">
                        <svg viewBox="0 0 100 1544" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0h100v386l-50 772v386H0V0z" fill="currentColor"></path>
                        </svg>
                    </div>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>




@endsection

