@extends('mobile.layout.master')

@section('title') Coming Soon @endsection

@section('content')

    <div id="main-wrapper" class="h-100">
        <!-- Header
        ============================================= -->

        <!-- Header End -->

        <section class="d-flex flex-column min-vh-100">
            <div class="container text-center my-auto py-5">
                <div class="row mt-5">
                    <div class="col-lg-10 mx-auto">
                        <img width="300" class="mb-5" src="{{asset(env('COMPANY_LOGO'))}}" />
                        <h1 class="mb-3">Coming Soon!</h1>
                        <p class="text-13 mb-5">Launching this Month<br>The Future of Digital Payments is Here</p>
                    </div>
                </div>

            </div>
            <div class="container-fluid bg-white mt-auto py-2">
                <p class="text-center text-muted mb-0">Copyright &copy; 2022 <a href="#">{{ config('app.company_name') }}</a>. All Rights Reserved.</p>
            </div>
        </section>

    </div>
@endsection
