@extends('outer.layouts.master')

@section('title')
    FAQs
@endsection
@section('content')


    <section class="py-10 py-md-14 overlay overlay-60 bg-cover"
             style="background-image: url(assets/img/pattern-blue.webp);">
        <div class="container">
            <div class="row justify-content-center"  data-aos="fade-up">
                <div class="col-12 col-md-10 col-lg-8 text-center">

                    <!-- Heading -->
                    <h1 class="display-2 fw-bold text-white">
                       FAQs
                    </h1>

                    <!-- Text -->
                    <p class="lead text-white-75 mb-0">
                        Frequently Asked Questions
                    </p>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>


    <section class="  ">
        <div class="container">
            <div class="row align-items-center gx-0"  data-aos="fade-up">
                <div class="col-12">
                    @include('outer.includes.faqs')
                </div>
            </div>
        </div>
    </section>





@endsection
