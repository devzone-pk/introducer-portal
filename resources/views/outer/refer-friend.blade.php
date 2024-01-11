@extends('outer.layouts.master')
@section('title')
    Refer a Friend
@endsection
@section('content')

    <style>

        p {
            font-size: 15px;
        }
    </style>
    <section class="py-10 py-md-14 overlay  overlay-60 bg-cover"
             style="background-image: url(assets/img/pattern-blue.webp);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 text-center" data-aos="fade-up">

                    <!-- Heading -->
                    <h1 class="display-2 fw-bold text-white">
                        Refer a Friend
                    </h1>

                    <!-- Text -->
                    <p class="lead text-white-75 mb-0">
                        {{ config('app.company_name') }}

                    </p>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>


    <section class="pt-8 pt-md-11 pb-8 bg-light">
        <div class="container"><!-- / .row -->
            <div class="row">
                <div align="justify">
                    <h3 class="fw-bold">Refer a Friend (T&amp;C)</h3>
                    <h3 class="fw-bold">General Terms and Conditions (RAF)</h3>
                    <p class="inner-page">1.    {{ config('app.company_name') }} customers will be eligible for participating in the “Refer a Friend”.</p>
                    <p class="inner-page">2. All existing and new customers will be auto-enrolled to participate in this program.</p>
                    <p class="inner-page">3. This offer is applicable for successful referrals made on, or after January 12, 2023.</p>
                    <p class="inner-page">4. Reward, i.e., 5 GBP, 5 EUR, 5 AUD, 5 PLN, 5 CAD, 5 NOK, 5 DKK, 5 RON, and 5 CHF will be added in credits.</p>
                    <p class="inner-page">5. Only paid and completed transactions of referred persons will be considered for this program and transactions created by the referred friends should be</p>
                    <p class="inner-page">
                    </p><ul style="margin-left:50px;list-style: disc;">
                        <li><strong>Equal to 200 GBP or above if the transaction is created from the UK</strong></li>
                        <li><strong>Equal to 200 EUR or above if the transaction is created from Europe</strong></li>
                        <li><strong>Equal to 200 AUD or above if the transaction is created from Australia</strong></li>
                        <li><strong>Equal to 1000 PLN or above if the transaction is created from Poland</strong></li>
                        <li><strong>Equal to 350 CAD or above if the transaction is created from Canada</strong></li>
                        <li><strong>Equal to 2,000 NOK or above if the transaction is created from Norway</strong></li>
                        <li><strong>Equal to 1500 DKK or above if the transaction is created from Denmark</strong></li>
                        <li><strong>Equal to 1200 RON or above if the transaction is created from Romania</strong></li>
                        <li><strong>Equal to 250 CHF or above if the transaction is created from Switzerland</strong></li>
                    </ul>
                    <p></p>
                    <p class="inner-page">
                        6.	If your Referral was also referred by another user, you will earn a reward only if the Referral registers with your referral link/code. If your Referral uses another user's referral link/ number to sign up, you will not receive the reward.
                    </p>
                    <p class="inner-page">
                        7.	The amount earned by a customer under this referral program will be credited to the customer’s available credit in the ‘Credit’, for both, Mobile App.
                    </p>
                    <p class="inner-page">
                        8.	Customer can redeem available credits while creating transactions with    {{ config('app.company_name') }} Limited.
                    </p>
                    <p class="inner-page">
                        9.	Customer will be able to pay a maximum of 50% of their transaction amount from available credits in one transaction.
                    </p>
                    <p class="inner-page">
                        10.	If the transaction, created by using credit, gets failed or cancelled,    {{ config('app.company_name') }} will reverse the credit to your available credits.
                    </p>
                    <p class="inner-page">
                        11.	Credits and reward earned under this program will be customer specific and the customer will not be able to transfer, exchange, encash, return or otherwise refund credit for own self or with other    {{ config('app.company_name') }} customers.
                    </p>
                    <p class="inner-page">
                        12.	Use of    {{ config('app.company_name') }} ‘Invite a Friend’ Request shall amount to the acceptance of the FAQ’s and Terms and Conditions in force at that time.
                    </p>
                    <p class="inner-page">
                        13.	Terms and Conditions as well as the Promotion FAQs are intended to be legally binding.
                    </p>
                    <p class="inner-page">
                        14.	   {{ config('app.company_name') }} Limited may ask you and your friend for any additional KYC (Know Your Customer) documentation to fulfill RU’s KYC responsibilities for fraud prevention and/or its obligations under AML and CFT.
                    </p>
                    <p class="inner-page">
                        15.	You may not be able to use the Services, or some features of the Services if you are located in certain regions, countries, or jurisdictions.
                    </p>
                    <p class="inner-page">
                        16.	You are responsible for any personal tax as a consequence of rewards earned from this promotion and    {{ config('app.company_name') }} accepts no liability.
                    </p>
                    <p class="inner-page">
                        17.	   {{ config('app.company_name') }} may reject or cancel any invite friend request or subsequent reward for any discrepancy found in the request or if we find that the feature has been misused in any way, like appended examples:
                    </p><ul style="margin-left:50px;list-style: disc;">
                        <li>Referring to people in the same household as you</li>
                        <li>Non-compliance with applicable law or regulation in any jurisdiction</li>
                        <li>The making of non-genuine payments</li>
                        <li>Inviting existing    {{ config('app.company_name') }} registered customers; and</li>
                        <li>Creating multiple or non-genuine accounts</li>
                    </ul>
                    <p></p>
                    <p class="inner-page">
                        18.	We may revise the FAQs and Terms and Conditions at any time at our discretion if needed.
                    </p>
                    <p class="inner-page">
                        19.	   {{ config('app.company_name') }} reserves the right to cancel or suspend this promotion at any time.
                    </p>
                    <p class="inner-page">
                        20.	Rewards are subject to verification. The Company may delay a Reward for investigation or for any other reason it deems appropriate. The Company may also refuse to verify and process any transaction that it deems, in its sole discretion, to be fraudulent, suspicious, in violation of these Terms and Conditions or the Company’s Privacy Policy, or believes will impose potential liability on Company, its subsidiaries, affiliates or any of their respective officers, directors, employees, representatives, and agents. All of the Company's decisions are final and binding, including decisions as to whether a Qualified Referral, Credit or Reward is verified.
                    </p>
                    <div class="clear pad-20"></div>
                    <br><br>
                </div>
                {{--                <div class="col-12 col-md-4">--}}

                {{--                    <!-- Card -->--}}
                {{--                    <div class="card shadow-light-lg">--}}
                {{--                        <div class="card-body">--}}

                {{--                            <!-- Heading -->--}}
                {{--                            <h4 class="text-primary">--}}
                {{--                                Have a question?--}}
                {{--                            </h4>--}}

                {{--                            <!-- Text -->--}}
                {{--                            <p class="fs-sm text-gray-800 mb-5">--}}
                {{--                                Not sure exactly what we’re looking for or just have a query? We’re always available to--}}
                {{--                                talk and help you with your money transfer needs. Anytime!--}}
                {{--                            </p>--}}

                {{--                            <!-- Heading -->--}}
                {{--                            <h6 class="fw-bold text-uppercase text-primary mb-2">--}}
                {{--                                Call anytime--}}
                {{--                            </h6>--}}

                {{--                            <!-- Text -->--}}
                {{--                            <p class="fs-sm mb-5">--}}
                {{--                                +44 124 5953 337 <br>--}}
                {{--                                +44 124 5953 338<br>--}}
                {{--                                +44 734 140 5879 (Whatsapp)--}}
                {{--                            </p>--}}

                {{--                            <!-- Heading -->--}}
                {{--                            <h6 class="fw-bold text-uppercase text-primary mb-2">--}}
                {{--                                Email us--}}
                {{--                            </h6>--}}

                {{--                            <!-- Text -->--}}
                {{--                            <p class="fs-sm mb-0">--}}
                {{--                                 info@oriumpay.com--}}
                {{--                            </p>--}}

                {{--                        </div>--}}
                {{--                    </div>--}}

                {{--                </div>--}}
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>

    {{--    <section class="pb-10 pt-10 pt-md-10 bg-dark">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row  justify-content-center">--}}
    {{--                <div class="col-12 gy-5 col-md-10 col-lg-8 text-center">--}}

    {{--                    <!-- Badge -->--}}
    {{--                    <span class="badge rounded-pill bg-gray-700-soft mb-4">--}}
    {{--              <span class="h6 fw-bold text-uppercase">Get started</span>--}}
    {{--            </span>--}}

    {{--                    <!-- Heading -->--}}
    {{--                    <h1 class="display-4 text-white">--}}
    {{--                        Need Help?--}}
    {{--                    </h1>--}}

    {{--                    <!-- Text -->--}}
    {{--                    <p class="fs-lg text-muted mb-6 mb-md-8">--}}
    {{--                        We are always here for you!--}}
    {{--                    </p>--}}

    {{--                    <!-- Button -->--}}
    {{--                    <a href="{{ url('contact-us') }}" target="_blank" class="btn btn-primary lift">--}}
    {{--                        Contact Us <i class="fe fe-arrow-right"></i>--}}
    {{--                    </a>--}}

    {{--                </div>--}}
    {{--            </div> <!-- / .row -->--}}
    {{--        </div>--}}
    {{--    </section>--}}


@endsection
