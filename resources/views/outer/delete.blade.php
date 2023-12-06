@extends('outer.layouts.master')

@section('title')
    Account Deletion Query
@endsection
@section('content')
    <section class="py-10 py-md-14 overlay bg-black  overlay-60 bg-cover"
        style="background-image: url(/assets/img/pattern.png);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 text-center" data-aos="fade-up">

                    <!-- Heading -->
                    <h1 class="display-2 fw-bold text-white">
                        Account Deletion Query
                    </h1>

                    <!-- Text -->

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>


    <section class="py-7 py-md-6  " id="info">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">

                    <!-- Button -->
                    <a href="#info" class="btn btn-white btn-rounded-circle shadow mt-n11 mt-md-n10 text-primary"
                        data-scroll="">
                        <i class="fe fe-arrow-down"></i>
                    </a>

                </div>
            </div> <!-- / .row -->

        </div>
    </section>

    @livewire('outer.account-deletion')
@endsection
