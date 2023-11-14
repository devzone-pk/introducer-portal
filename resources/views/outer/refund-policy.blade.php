@extends('outer.layouts.master')

@section('title')
    Refund Policy
@endsection
@section('content')

    <section class="py-10 py-md-14 overlay bg-black  overlay-60 bg-cover"
             style="background-image: url(assets/img/pattern.png);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 text-center" data-aos="fade-up">

                    <!-- Heading -->
                    <h1 class="display-2 fw-bold text-white">
                        Refund Policy
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
        <div class="container">

            <div class="row">
                <div class="col-12 col-md-8 w-100">

                    <h3 class="fw-bold">
                        1. Cancellation:
                    </h3>


                    <p class="text-gray-800 mb-5">
                        If customer wants to cancel a payment, then you can do it over the phone/email but after
                        establishing his
                        identity. This cancellation is only possible before the money transferred has either been
                        credited to the
                        recipient’s account or collected by him. In case of timely cancellation, it will normally take
                        10 working days to
                        reverse the transaction and customer has to come in the office in person with the original
                        receipt to collect the
                        money if in-branch service is used when sending money, if transaction was sent through online
                        web portal
                        than funds will be transferred back to customers account or Debit/Credit card from which money
                        was
                        transferred. The exchange rate fluctuations might affect the money received back. <strong>
                            *Cancellation charges
                            will also be applied*.</strong>

                    </p>
                    <p class="text-gray-800 mb-5">
                        If you instruct us to pay a money transfer to a designated recipient and later request that we
                        stop the payment
                        of such transaction, we will need to check first with the paying agent to determine if the money
                        transfer has
                        been paid to the recipient. If we can confirm that payment has not been made, the money transfer
                        will be
                        cancelled and we will refund the amount of the money transfer, excluding the service charge and
                        transfer fee.
                        The exchange rate fluctuations might affect the money received back. Your refund will be in GBP.
                        All refunds shall be available within Ten (10) calendar days of the stop order or as soon as the
                        refunds are
                        returned by the paying agent and, whichever is first. If you want a refund, you must email at
                         info@oriumpay.com or post your written request to {{ config('app.company_name') }} at 140 High Street,
                        North, Eastham,
                        London. E6 2HT. For further information please contact our customer service team at 02084709606,
                        or email;
                         info@oriumpay.com
                    </p>
                    <h3 class="fw-bold">
                        2. Refunds
                    </h3>
                    <p class="text-gray-800 mb-5">
                        Once we receive confirmation from paying agent of payment cancellation, payment will be
                        transferred back to
                        customer’s account or Debit/Credit card from which money was transferred. Any charges(1)
                        applicable on
                        refund to debit/credit card will be applicable and will be deducted from original amount of
                        transfer.
                        <br>
                    <ul>
                        (1) Cancellation charges will be 3% of the transfer amount at the time of transaction in GBP
                    </ul>
                    </p>
                    <!-- Text -->

                    <!-- List -->

                </div>

            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>
@endsection
