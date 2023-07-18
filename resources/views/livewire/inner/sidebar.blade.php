<div class="col-md-3 col-12">
    <div class="col-12 order-4 order-md-1">
        <div class="card card-border shadow-light-lg">
            <div class="card-body p-5">
                <div class="container-md">
                    <div class="col-12 col-md text-center">

                        <div class="col-auto">
                            <div class="icon-circle bg-primary text-white">
                                <i class="fe fe-users"></i>
                            </div>
                        </div>

                        <div class="col ms-n4 mt-5">

                            <!-- Heading -->
                            <h5 class="mb-0">
                                Hello, {{ session('name') }}
                            </h5>

                            <!-- Text -->
                        </div>

                    </div>

                    <div class="col-auto mt-5 d-flex align-items-center justify-content-center">

                        <a href="#!" class="text-reset d-inline-block me-1">
                            <img src="/assets/img/buttons/button-app.png" class="img-fluid" alt="..."
                                 style="max-width: 100px;">
                        </a>

                        <a href="#" class="text-reset d-inline-block">
                            <img src="/assets/img/buttons/button-play.png" class="img-fluid" alt="..."
                                 style="max-width: 100px;">
                        </a>

                    </div>
                </div>
            </div> <!-- / .container -->

        </div>
    </div>

    @if(\Illuminate\Support\Facades\Request::segment(1) != 'dashboard')
        <div class="col-12 mt-4 order-5 order-md-2" >
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($promotions as $p)

                        <div class="carousel-item {{ $loop->first ? 'active' :'' }}">
                            <img src="{{ env('AWS_URL') }}{{ $p->attachment }}" class="d-block w-100 rounded-2"
                                 alt="...">
                        </div>
                    @endforeach

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    @endif
    <div class="col-12 mt-4 order-6 order-md-3">
        <div class="card shadow-light-lg  ">
            <div class="card-body text-center p-3">
                <div class="text-17 text-light my-4">
                       <span class="d-block text-10 text-light mb-4">
                                         <img src="{{asset('assets/img/icons/chatwithus.png')}}" height="100px">
                                </span>
                </div>
                <h3 class="text-5 fw-bold my-4 text-warning">Need Help?</h3>
                <p class=" fs-12px opacity-8 mb-4">Have questions or concerns regrading your account?</p>
                <p class=" fs-12px mb-5"> Our experts are here to help!.</p>
                <div class="fs-12px w-100 "><a href="{{url('customer-support/add-complaint')}}" class="btn btn-primary btn-sm w-100">Chat with Us</a></div>
            </div>
        </div>
    </div>
</div>