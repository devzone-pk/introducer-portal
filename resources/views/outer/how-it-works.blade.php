@extends('outer.layouts.master')

@section('content')
    <!-- Testimonial
    ============================================= -->
    <section class="hero-wrap section shadow-md">
        <div class="hero-mask opacity-3 bg-dark"></div>
        <div class="hero-bg hero-bg-scroll"
             style="background-image:url({{asset('hero-p.svg')}});"></div>
        <div class="hero-content hero-content py-0 my-0 ">
            <div class="container text-center">
                <h2 class="text-9 text-white font-weight-400 text-uppercase">How to send money </h2>
                <p class="lead text-center text-white mb-5">Faster, Simpler, Safer </p>
{{--                <a class="video-btn d-flex" href="#" --}}
{{--                   data-src="{{asset('images/img/website.mp4')}}"--}}
{{--                   data-toggle="modal" data-target="#videoModal"> <span--}}
{{--                        class="btn-video-play bg-white shadow-md rounded-circle m-auto"><i--}}
{{--                            class="fas fa-play"></i></span> </a></div>--}}
        </div>
    </section>
    <!-- Testimonial end -->

    <!-- How it works
    ============================================= -->
    <section class="section">
        <div class="container">

            <div class="row mt-5">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="bg-white shadow-sm rounded h-100 p-3">
                        <div class="featured-box">
                            <div class="text-center text-primary mt-4 mb-4"><img style="width: 20%;"
                                    src="{{asset('images/img/how1.svg')}}"></div>
                            <h3 class="text-center">1. Register yourself</h3>
                            <p class="text-center text-3">Create your account using email.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="bg-white shadow-sm rounded h-100 p-3">
                        <div class="featured-box">
                            <div class="text-center text-primary mt-4 mb-4"><img style="width: 20%;"
                                    src="{{asset('images/img/how2.svg')}}"></div>
                            <h3 class="text-center">2. Enter Amount</h3>
                            <p class="text-center text-3">Enter amount to send.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="bg-white shadow-sm rounded h-100 p-3">
                        <div class="featured-box">
                            <div class="text-center text-primary mt-4 mb-4"><img style="width: 20%;"
                                    src="{{asset('images/img/how3.svg')}}"></div>
                            <h3 class="text-center">3. Enter Receiver Details</h3>
                            <p class="text-center text-3">Provide basic receiver details.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="bg-white shadow-sm rounded h-100 p-3">
                        <div class="featured-box">
                            <div class="text-center text-primary mt-4 mb-4"><img style="width: 20%;"
                                    src="{{asset('images/img/how4.svg')}}"></div>
                            <h3 class="text-center">4. Upload ID</h3>
                            <p class="text-center text-3">Upload required identification documents.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="bg-white shadow-sm rounded h-100 p-3">
                        <div class="featured-box">
                            <div class="text-center text-primary mt-4 mb-4"><img style="width: 20%;"
                                    src="{{asset('images/img/how5.svg')}}"></div>
                            <h3 class="text-center">5. Select Payment Method</h3>
                            <p class="text-center text-3">Select debit/credit card or bank transfer as desired sending option.
                                </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="bg-white shadow-sm rounded h-100 p-3">
                        <div class="featured-box">
                            <div class="text-center text-primary mt-4 mb-4"><img style="width: 20%;" src="{{asset('images/img/how6.svg')}}">
                            </div>
                            <h3 class="text-center">6. Review and Send</h3>
                            <p class="text-center text-3">Simply review your transaction and send.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- How it works end -->

    <!-- Can't find
    ============================================= -->
    <section class="section py-4 my-4 py-sm-5 my-sm-5 d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('outer.includes.cannot-find')
                </div>
            </div>
        </div>
    </section>
    <!-- Can't find end -->

@endsection
