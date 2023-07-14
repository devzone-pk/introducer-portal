@extends('outer.layouts.master')
@section('title')
    About Us
@endsection
@section('content')
    <section class="py-10 py-md-14 overlay bg-black  overlay-60 bg-cover"
             style="background-image: url(assets/img/pattern.png);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 text-center" data-aos="fade-up">

                    <!-- Heading -->
                    <h1 class="display-2 fw-bold text-white">
                        About Us
                    </h1>

                    <!-- Text -->
                    <p class="lead text-white-75 mb-0">
                        Secure & Reliable Money Transfers
                    </p>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>



    <section class="pt-6 pt-md-7">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up">
                <div class="col-12 col-md-10 col-lg-9 col-xl-9">



                    <!-- Text -->
                    <p class=" mb-7 fw-light text-center text-gray">
                        Welcome to {{ config('app.company_name') }}!
                    </p>

                    <!-- Text -->
                    <p class=" mb-7 fw-light text-center text-gray">
                        XMG Remit, a trading name of Xmg Financial Services Limited, is a trusted financial institution authorised and regulated by the Financial Conduct Authority (FCA). Our FCA Firm reference number is 790926, which demonstrates our commitment to providing secure and reliable services.                    </p>

                    <p class=" mb-7 fw-light text-center text-gray">
                        As a Small Payment Institution, we specialise in facilitating seamless and efficient money transfers using our website; mobile apps available on both the Apple store and Android. Whether you need to send funds to friends and family by making international payments, XMG Remit is here to simplify the process.
                    </p>
                    <p class=" mb-7 fw-light text-center text-gray">
                        Rest assured; we operate under the supervision of His Majesty's Revenue and Customs (HMRC) as a registered Money Service Business (MSB). Our MSB registration number, XKML00000115637, signifies our compliance with the highest standards of financial regulations and customer protection.
                    </p>
                    <p class=" mb-7 fw-light text-center text-gray">
                        Xmg Financial Services Limited (Company No 10966723) is headquartered at Unit 3, 29-31 Greatorex Street, London, England, E1 5NP. We proudly serve our clients with integrity and transparency, prioritising your trusted service.                    </p>
                    <p class=" mb-7 fw-light text-center text-gray">
                        At XMG Remit, we understand the importance of your money and the value of reliable financial services. With our expertise and dedication, we strive to make your financial transactions smooth, secure, and cost-effective.                    </p>
                    <p class=" mb-7 fw-light text-center text-gray">
                        Choose XMG Remit for your money transfer needs and experience a seamless and trustworthy service. Get started today, and let us assist you in achieving your financial goals with confidence.                    </p>
                    <p class=" mb-7 fw-light text-center text-gray">
                        Remember, at XMG Remit, your satisfaction is our success!
                    </p>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>


{{--    <section class="pt-6 pt-md-7">--}}
{{--        <div class="container">--}}
{{--            <div class="row justify-content-center" data-aos="fade-up">--}}
{{--                <div class="col-12 col-md-10 col-lg-9 col-xl-9">--}}

{{--                    <!-- Heading -->--}}
{{--                    <h1 class="text-secondary text-center">--}}
{{--                        International Money Transfer--}}
{{--                    </h1>--}}

{{--                    <!-- Text -->--}}
{{--                    <p class=" mb-7 fw-light text-center text-gray">--}}
{{--                        We offered the services to transfer money to Pakistan, India, Bangladesh, Sri Lanka, UAE, South Asia, Europe, America, Canada & Africa at very competitive exchange rates.--}}

{{--                        Online transfer facility is currently limited to Pakistan corridor only. The money can be received from any branch of one of these banks; United Bank Limited, Muslim Commercial Bank,  very next day in Pakistan. Moreover you can transfer money into any bank account in Pakistan.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div> <!-- / .row -->--}}
{{--        </div> <!-- / .container -->--}}
{{--    </section>--}}

{{--    <section class="pt-6 pt-md-7 pb-8">--}}
{{--        <div class="container">--}}
{{--            <div class="row justify-content-center" data-aos="fade-up">--}}
{{--                <div class="col-12 col-md-10 col-lg-9 col-xl-9">--}}

{{--                    <!-- Heading -->--}}
{{--                    <h1 class="text-secondary text-center">--}}
{{--                        Instant Cash--}}
{{--                    </h1>--}}

{{--                    <!-- Text -->--}}
{{--                    <p class=" mb-7 fw-light text-center text-gray">--}}
{{--                        Instant Cash is the fastest mode of transferring your money to any part of the world in minutes. As one of the most popular instant money transfer services of the world, Instant Cash offers true value for your money with nominal charges, reliability ensured with state-of-the-art technologies, simplified transaction procedures, and instant payout to the beneficiary.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div> <!-- / .row -->--}}
{{--        </div> <!-- / .container -->--}}
{{--    </section>--}}


@endsection
