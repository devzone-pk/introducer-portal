@extends('outer.layouts.master')

@section('title')
    Terms and Conditions
@endsection
@section('content')

    <section class="py-10 py-md-14 overlay  overlay-60 bg-cover"
             style="background-image: url(assets/img/pattern-blue.webp);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 text-center" data-aos="fade-up">

                    <!-- Heading -->
                    <h1 class="display-2 fw-bold text-white">
                        Terms & Conditions
                    </h1>

                    <!-- Text -->
                    <p class="lead text-white-75 mb-0">
                        {{ config('app.company_name') }}

                    </p>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>
    @include('include.terms-and-conditions')

@endsection
