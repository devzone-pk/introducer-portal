{{--discarded in new portal--}}
<header id="header">
    <div class="container">
        <div class="d-none d-lg-block">
            <div class="header-row ">
                <div class="header-column justify-content-start">
                    <div class="logo me-3">


                        <a class="d-flex" href="{{ url('dashboard') }}"><img
                                src="{{ env('COMPANY_LOGO') }}" width="{{ env('COMPANY_LOGO_WIDTH','250') }}"
                                alt="{{ env('APP_NAME') }}"/></a></div>
                </div>
                <div class="header-column justify-content-end">
                    <!-- My Profile
                    ============================== -->
                    <nav class="login-signup navbar navbar-expand">
                       <span class="navbar-text text-end">
                           @php
                               $company = \App\Models\Company::find(config('app.company_id'));
                               @endphp
     <a href="mailto:{{ $company['email'] }}">{{ $company['email'] }}</a>
                           <br>
                       {{ $company['phone'] }} <br>
                           {{ $company['phone2'] }}
    </span>
                    </nav>
                    <!-- My Profile end -->
                </div>

            </div>
        </div>
        <div class="d-lg-none">
            <div class="header-row ">
                <div class="header-column">
                    <button class="btn btn-link ps-0 	d-lg-none" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        <i class="fas fa-bars fa-lg"></i>
                    </button>
                </div>
                <div class="header-column  justify-content-center">
                    <div class="logo ">


                        <a class="d-flex" href="{{ url('dashboard') }}"><img
                                src="{{ env('COMPANY_LOGO') }}" width="{{ env('COMPANY_LOGO_WIDTH','250') }}"
                                alt="{{ env('APP_NAME') }}"/></a></div>
                </div>
                <div class="header-column  justify-content-end">
                    <a href="{{ url('send/money') }}" class="btn btn-primary btn-sm shadow-none">Send Money</a>
                </div>

            </div>
        </div>
    </div>
</header>
