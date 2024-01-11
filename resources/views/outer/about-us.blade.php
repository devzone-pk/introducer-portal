@extends('outer.layouts.master')
@section('title')
    About Us
@endsection
@section('content')
    <section class="py-10 py-md-14 overlay bg-black  overlay-60 bg-cover"
             style="background-image: url(assets/img/pattern-blue.webp);">
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
                    <p class=" mb-7    ">
                        Welcome to {{ config('app.company_name') }}!
                    </p>

                    <!-- Text -->
                    <p class=" mb-7    ">
                        Welcome to {{ config('app.company_name') }}, your trusted partner for secure and efficient money transfers worldwide. Based in the United Kingdom, we specialize in providing seamless international remittance services, enabling individuals and businesses to send money across borders quickly and reliably.
                    </p>

                    <p class=" mb-7   ">
                        At {{ config('app.company_name') }}, we understand the importance of fast, secure, and cost-effective money transfers. With our extensive network and cutting-edge technology, we connect people from the UK to destinations around the globe, ensuring their funds reach their intended recipients promptly and safely.
                    </p>

                    <p class="    ">
                        Why Choose Us:
                    </p>
                    <ul class=" mb-7   ">
                        <li>Trust and Reliability: We prioritize the trust and satisfaction of our customers above all else. With a proven track record and a robust compliance framework, we ensure your money is handled with the utmost care and security throughout the transfer process.</li>
                        <li>Global Reach: Whether you need to send money to loved ones abroad, make business payments, or support international causes, our expansive network allows us to facilitate transfers to numerous countries across the world. No matter where your recipient is located, we strive to provide a seamless and hassle-free experience.</li>
                        <li>Competitive Rates and Low Fees: We understand the significance of affordability when it comes to international money transfers. That's why we offer competitive exchange rates and transparent fee structures, helping you maximize the value of your transferred funds.</li>
                        <li>User-Friendly Platform: Our user-friendly online platform or mobile app allows you to initiate and track your transfers with ease. With intuitive navigation, real-time updates, and dedicated customer support, we ensure a seamless experience from start to finish.</li>
                        <li>Compliance and Security: As a fully licensed and regulated money transfer company, we adhere to strict compliance measures, ensuring that your transactions meet all legal requirements. Your personal and financial information is safeguarded using state-of-the-art encryption technologies, providing you with peace of mind.</li>
                        <li>Customer Support: Our knowledgeable and friendly customer support team is available to assist you every step of the way. Whether you have questions about the transfer process, need assistance with documentation, or require any other support, we are here to help.</li>

                    </ul>
                    <p class=" mb-7   ">
                        Join thousands of satisfied customers who have chosen {{ config('app.company_name') }} for their international money transfer needs. Experience the convenience, reliability, and value we offer as we help you bridge distances and connect with your loved ones or business partners across the globe.
                    </p>
                    <p class=" mb-7   ">
                        {{ config('app.company_name') }} - Your Trusted Partner for Global Money Transfers.

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
{{--                    <p class=" mb-7  text-center ">--}}
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
{{--                    <p class=" mb-7  text-center ">--}}
{{--                        Instant Cash is the fastest mode of transferring your money to any part of the world in minutes. As one of the most popular instant money transfer services of the world, Instant Cash offers true value for your money with nominal charges, reliability ensured with state-of-the-art technologies, simplified transaction procedures, and instant payout to the beneficiary.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div> <!-- / .row -->--}}
{{--        </div> <!-- / .container -->--}}
{{--    </section>--}}


@endsection
