@extends('outer.layouts.master')
@section('title')
    Contact Us
@endsection
@section('content')
    <section class="py-10 py-md-14 overlay bg-black overlay-60 bg-cover bg-gray-200 "
             style="background-image: url(assets/img/pattern.png);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 text-center"  data-aos="fade-up">

                    <!-- Heading -->
                    <h1 class="display-2 fw-bold text-white">
                        Get in touch
                    </h1>

                    <!-- Text -->
                    <p class="lead text-white-75 mb-0">
                        If you have any questions about the services we provide simply use the form below. We try and respond to all queries and comments within 24 hours.
                    </p>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>




    <section class="py-7 py-md-9 border-bottom border-gray-300  bg-gray-200" id="info">
        <div class="container">

            <div class="row"  data-aos="fade-up">
                <div class="col-12 col-md-4 text-center border-end border-gray-700">

                    <!-- Heading -->
                    <h6 class="text-uppercase text-gray fw-bold letter-spacing-lg mb-1">
                        WHATSAPP
                    </h6>

                    <!-- Link -->
                    <div class="mb-5 mb-md-0">
                        <p class="h4 text-secondary fw-light">
                            +44 772 574 6316
                        </p>
                    </div>

                </div>
                <div class="col-12 col-md-4 text-center border-end border-gray-300">

                    <!-- Heading -->
                    <h6 class="text-uppercase text-gray fw-bold letter-spacing-lg mb-1">
                        CALL Anytime
                    </h6>

                    <!-- Link -->
                    <div class="mb-5 mb-md-0">
                        <p class="h4 text-secondary fw-light">
                            +44 772 574 6316
                        </p>
                    </div>

                </div>
                <div class="col-12 col-md-4 text-center">

                    <!-- Heading -->
                    <h6 class="text-uppercase text-gray fw-bold letter-spacing-lg mb-1">
                        EMAIL US
                    </h6>

                    <!-- Link -->
                    <div class="mb-5 mb-md-0">
                        <p class="h4 text-secondary fw-light">
                             info@oriumglobalresources.com
                        </p>
                    </div>

                </div>
            </div> <!-- / .row -->
        </div>
    </section>

    <section class="py-5 py-md-7   bg-gray-200"  >
        <div class="container">

            <div class="row"  data-aos="fade-up">
                <div class="col-12   text-center border-end border-gray-700">

                    <!-- Heading -->
                    <h6 class="text-uppercase text-gray fw-bold letter-spacing-lg mb-1">
                        Address
                    </h6>

                    <!-- Link -->
                    <div class="mb-5 mb-md-0 d-flex justify-content-center">
                        <p class="h4 text-secondary fw-light w-50 text-center">
                            {{ config('app.company_address') }}
                        </p>
                    </div>

                </div>

            </div> <!-- / .row -->
        </div>
    </section>


    <section class="pt-5 pt-md-9 pb-8 pb-md-11 bg-gray-200">
        <div class="container">
            <div class="row justify-content-center"  data-aos="fade-up">
                <div class="col-12 col-md-10 col-lg-8 text-center">

                    <!-- Heading -->
                    <h2 class="fw-bold">
                        Reach out to book a call
                    </h2>

                    <!-- Text -->
                    <p class="fs-lg text-muted mb-7 mb-md-9">
                        We are always here for you!
                    </p>

                </div>
            </div> <!-- / .row -->
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 col-lg-10">

                    <!-- Form -->
                   @livewire('outer.contact-us')

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>



@endsection
