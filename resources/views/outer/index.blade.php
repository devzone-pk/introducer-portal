@extends('outer.layouts.master')

@section('title')
    Home
@endsection

@section('content')


    <!-- WELCOME -->
    <section data-jarallax data-speed=".8" class="pt-12 pb-10 pt-md-15 pb-md-14"
             style="background-image: url(/assets/img/covers/cover-3.jpg)">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-8 col-lg-6">

                    <!-- Heading -->
                    <h1 class="display-3 fw-bold text-white" id="welcomeHeadingSource">
                        Send Money to <br/>
                        <span class="text-warning"
                              data-typed='{"strings": {{ $countries->pluck('name')->toJson() }} }'></span>
                    </h1>


                    <!-- Text -->
                    <p class="fs-lg text-white-80 mb-6">
                        Experience hassle-free global money transfers with our secure and user-friendly online platform.
                    </p>

                    <!-- Form -->


                </div>
                @livewire('outer.send-money')
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>

    <section class="pt-6 pt-md-8 bg-black">
        <div class="container pb-6 pb-md-8 border-bottom">
            <div class="row align-items-center">
                <div class="col-12 col-md">

                    <!-- Heading -->
                    <h3 class="fw-bold mb-1">
                        Get the app now!
                    </h3>

                    <!-- Text -->
                    <p class=" mb-6 mb-md-0">
                        Download our mobile app for fast and secure money transfers. Our app is easy to use and offers a
                        seamless transfer experience.
                    </p>

                </div>

                <div class="col-auto">

                    <a href="#!" class="text-reset d-inline-block me-1">
                        <img src="assets/img/buttons/button-app.png" class="img-fluid" alt="..."
                             style="max-width: 155px;">
                    </a>

                    <a href="https://play.google.com/store/apps/details?id=com.xmg.remit" class="text-reset d-inline-block">
                        <img src="assets/img/buttons/button-play.png" class="img-fluid" alt="..."
                             style="max-width: 155px;">
                    </a>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>


    <section class="py-8 py-md-11 border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 aos-init aos-animate" data-aos="fade-up">

                    <!-- Icon -->
                    <div class="icon text-primary mb-3">

                        <img class="w-48px" src="{{ asset('icons/fast-secure.png') }}" alt="">
                    </div>

                    <!-- Heading -->
                    <h3>
                        Fast and Secure
                    </h3>

                    <!-- Text -->
                    <p class="text-muted mb-6 mb-md-0">
                        Our money transfer website provides fast and secure transactions that are designed to meet the
                        needs of modern-day consumers.
                    </p>

                </div>
                <div class="col-12 col-md-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="50">

                    <!-- Icon -->
                    <div class="icon text-primary mb-3">
                        <img class="w-48px" src="{{ asset('icons/low-fees-and-best-rates.png') }}" alt="">
                    </div>

                    <!-- Heading -->
                    <h3>
                        Low Fees
                    </h3>

                    <!-- Text -->
                    <p class="text-muted mb-6 mb-md-0">
                        We pride ourselves on offering the lowest fees and best rates in the industry.
                    </p>

                </div>
                <div class="col-12 col-md-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

                    <!-- Icon -->
                    <div class="icon text-primary mb-3">
                        <img class="w-48px" src="{{ asset('icons/customer-support.png') }}" alt="">
                    </div>

                    <!-- Heading -->
                    <h3>
                        24/7 Customer Support
                    </h3>

                    <!-- Text -->
                    <p class="text-muted mb-0">
                        Our team of experts is available 24/7 to provide you with prompt and efficient support for all
                        your money transfer needs.
                    </p>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>


    <section class="py-8 bg-gray-200 py-md-11" id="how-works">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 text-center">

                    <!-- Preheading -->
                    <h6 class="text-uppercase text-gray-500 fw-bold">
                        Seamless transfer flows
                    </h6>

                    <!-- Heading -->
                    <h1 class="fw-bold">
                        Money transfer is just a few clicks.
                    </h1>

                    <!-- Text -->
                    <p class="fs-lg text-muted mb-7 mb-md-9">
                        Experience the convenience of fast and secure money transfers with just a few clicks on our
                        platform, no matter where you are in the world.
                    </p>

                </div>
            </div> <!-- / .row -->
            <div class="row gx-4 mb-7 mb-md-9">
                <div class="col-12 col-md-4 text-center">

                    <div class="row mb-5">
                        <div class="col">

                            <!-- Placeholder -->

                        </div>
                        <div class="col-auto">

                            <!-- Icon -->
                            <div class="icon text-primary mb-3">
                                <img class="w-48px" src="{{ asset('icons/create-your-account.png') }}" alt="">
                            </div>

                        </div>
                        <div class="col">

                            <!-- Divider -->
                            <hr class="d-none d-md-block">

                        </div>
                    </div> <!-- / .row -->

                    <!-- Headin -->
                    <h3 class="fw-bold">
                        Create your account
                    </h3>

                    <!-- Text -->
                    <p class="text-muted mb-6 mb-md-0">
                        To sign up on the app or website, choose a strong password and provide a valid email address.
                    </p>

                </div>
                <div class="col-12 col-md-4 text-center">

                    <div class="row mb-5">
                        <div class="col">

                            <!-- Divider -->
                            <hr class="d-none d-md-block">

                        </div>
                        <div class="col-auto">

                            <!-- Icon -->
                            <div class="icon text-primary mb-3">
                                <img class="w-48px" src="{{ asset('icons/update-profile.png') }}" alt="">
                            </div>

                        </div>
                        <div class="col">

                            <!-- Divider -->
                            <hr class="d-none d-md-block">

                        </div>
                    </div> <!-- / .row -->

                    <!-- Headin -->
                    <h3 class="fw-bold">
                        Update Profile
                    </h3>

                    <!-- Text -->
                    <p class="text-muted mb-6 mb-md-0">
                        Update your profile, including your address, and add any primary document through the app or
                        website.
                    </p>

                </div>
                <div class="col-12 col-md-4 text-center">

                    <div class="row mb-5">
                        <div class="col">

                            <!-- Divider -->
                            <hr class="d-none d-md-block">

                        </div>
                        <div class="col-auto">

                            <!-- Icon -->
                            <div class="icon text-primary mb-3">
                                <img class="w-48px" src="{{ asset('icons/send-money.png') }}" alt="">
                            </div>

                        </div>
                        <div class="col">

                            <!-- Placeholder -->

                        </div>
                    </div> <!-- / .row -->

                    <!-- Headin -->
                    <h3 class="fw-bold">
                        Send Money
                    </h3>

                    <!-- Text -->
                    <p class="text-muted mb-0">
                        Simply enter the amount you wish to send with best rate, add the recipient's details, and
                        confirm the transaction.
                    </p>

                </div>
            </div> <!-- / .row -->

        </div> <!-- / .container -->
    </section>


    <section class="py-8 pt-md-11 pb-md-12 bg-black">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 text-center">


                    <!-- Heading -->
                    <h1 class="fw-bold text-white">
                        Supported Countries
                    </h1>

                    <!-- Text -->
                    <p class="fs-lg text-white mb-7 mb-md-9">
                        We provide services to following countries.
                    </p>

                </div>
            </div> <!-- / .row -->
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3 mb-4">

                    <!-- Heading -->
                    <h4 class="fw-bold text-white mb-5">
                        Asia
                    </h4>
                    <!-- List -->
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/au.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Australia
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/bd.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Bangladesh
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/kh.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Cambodia
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/cn.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            China
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/in.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            India
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/id.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Indonesia
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/jp.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Japan
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/my.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Malaysia
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/np.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Nepal
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/pk.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Pakistan
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/ph.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Philippines
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/kr.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            South Korea
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/sg.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Singapore
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/lk.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Sri Lanka
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/th.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Thailand
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/tr.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Turkey
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/vn.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Vietnam
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-4">

                    <!-- Heading -->
                    <h4 class="fw-bold text-white mb-5">
                        Europe
                    </h4>

                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/be.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Belgium
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/gb.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            United Kingdom
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/fi.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Finland
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/fr.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            France
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/de.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Germany
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/it.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Italy
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/lt.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Lithuania
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/nl.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Netherlands
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/no.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Norway
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/pl.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Poland
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/pt.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Portugal
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/es.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Spain
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/se.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Sweden
                        </p>
                    </div>


                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-4">

                    <!-- Heading -->
                    <h4 class="fw-bold text-white mb-5">
                        Africa
                    </h4>

                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/bj.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Benin
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/bf.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Burkina Faso
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/cm.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Cameroon
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/gn.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Guinea
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/gm.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Gambia
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/gh.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Ghana
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/ci.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Ivory Coast
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/ne.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Niger
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/ng.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Nigeria
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/sn.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Senegal
                        </p>
                    </div>

                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-4">

                    <!-- Heading -->
                    <h4 class="fw-bold text-white mb-5">
                        Latin America
                    </h4>

                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/ar.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Argentina
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/br.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Brazil
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/co.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Colombia
                        </p>
                    </div>
                    <div class="d-flex align-items-center mb-2 ">
                        <!-- Badge -->
                        <img class="rounded-2 w-36px me-3 border " src="{{ asset('images/flags/uy.svg') }}" alt="">
                        <!-- Text -->
                        <p class="text-white mb-0">
                            Uruguay
                        </p>
                    </div>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>


    <section class="py-8 py-md-11 border-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 text-center">


                    <!-- Heading -->
                    <h1 class="fw-bold">
                        We offer multiple payment methods
                    </h1>

                    <!-- Text -->
                    <p class="fs-lg text-muted mb-7 mb-md-9">
                        Our platform offers a variety of payment methods for your receiver.
                    </p>

                </div>
            </div>
            <div class="row text-center">
                <div class="col-12 col-md-4 aos-init aos-animate" data-aos="fade-up">

                    <!-- Icon -->
                    <div class="icon text-primary mb-3">
                        <img class="w-48px" src="{{ asset('icons/bank-deposit.png') }}" alt="">
                    </div>

                    <!-- Heading -->
                    <h3>
                        Bank Deposit
                    </h3>

                    <!-- Text -->
                    <p class="text-muted mb-6 mb-md-0">
                        Make a secure bank transfer to numerous major banks across the globe without any intermediaries.
                    </p>

                </div>
                <div class="col-12 col-md-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="50">

                    <!-- Icon -->
                    <div class="icon text-primary mb-3">
                        <img class="w-48px" src="{{ asset('icons/cash-pickup.png') }}" alt="">
                    </div>

                    <!-- Heading -->
                    <h3>
                        Cash Pickup
                    </h3>

                    <!-- Text -->
                    <p class="text-muted mb-6 mb-md-0">
                        Cash can be collected within minutes from any available location across the receiving countries.
                    </p>

                </div>
                <div class="col-12 col-md-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

                    <!-- Icon -->
                    <div class="icon text-primary mb-3">
                        <img class="w-48px" src="{{ asset('icons/mobile-wallet.png') }}" alt="">
                    </div>

                    <!-- Heading -->
                    <h3>
                        Mobile Wallet
                    </h3>

                    <!-- Text -->
                    <p class="text-muted mb-0">
                        Within minutes, you can send funds directly to mobile money accounts worldwide.
                    </p>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>


@endsection
