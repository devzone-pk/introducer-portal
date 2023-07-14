
<div class="row g-3">

    @livewire('inner.sidebar')
    <div class="col-md-9 col-12">
    <div class="card card-border border-primary shadow-light-lg mb-6">
        <div class="card-header px-5">
            <div class="row align-items-center">
                <div class="col">
                    <!-- Heading -->
                    <h4 class="mb-0">
                        Transaction Details
                    </h4>
                </div>

            </div>
        </div>
        <div class="card-body  ">
            <div class="row g-5">
                <div class="col-md-6 col-12">
                    <p class=" fw-bold fs-14px ">Customer Information:</p>
                    <p class=" fs-14px mb-0 ">Sender Name: <span
                                class="text-gray">{{ $transfer->sender->first_name }} {{ $transfer->sender->last_name }}</span>
                    </p>
                    <p class=" fs-14px mb-0 ">Email: <span class="text-gray">{{ $transfer->sender->email }} </span></p>
                    <p class=" fs-14px mb-0 ">Phone number: <span
                                class="text-gray">{{ $transfer->sender->phone_code }} {{ $transfer->sender->phone }}</span>
                    </p>
                    <p class=" fs-14px mb-0 ">Country: <span class="text-gray">{{ session('country') }} </span></p>
                    <p class=" fs-14px mb-0 ">Address: <span
                                class="text-gray">{{ $transfer->sender->house_no  }} {{ $transfer->sender->street_name  }} {{ $transfer->sender->postal_code  }},{{ $transfer->sender->city_name  }}</span>
                    </p>
                </div>

                <div class="col-md-6 col-12">
                    <p class=" fw-bold fs-14px ">Beneficiary Information:</p>
                    <p class=" fs-14px mb-0 ">Name: <span
                                class="text-gray">{{ $transfer->beneficiary->first_name }} {{ $transfer->beneficiary->last_name }}</span>
                    </p>
                    <p class=" fs-14px mb-0 ">Phone: <span
                                class="text-gray">{{ $transfer->beneficiary->code }} {{ $transfer->beneficiary->phone }}</span>
                    </p>
                    <p class=" fs-14px mb-0 ">Payer: <span class="text-gray">{{ $transfer->payer->name }}</span></p>
                    <p class=" fs-14px mb-0 ">Sending Reason: <span
                                class="text-gray">{{ $transfer->sendingReason->name }}</span></p>
                </div>


                <div class="col-md-6 col-12">
                    <p class=" fw-bold fs-14px ">Payment Information:</p>
                    <p class=" fs-14px mb-0 ">Amount Sent: <span
                                class="text-gray">{{ number_format($transfer->sending_amount,2) }} {{ $transfer->sending_currency }}</span>
                    </p>
                    <p class=" fs-14px mb-0 ">Charges: <span
                                class="text-gray">{{ number_format($transfer->company_charges,2) }} {{ $transfer->sending_currency }}</span>
                    </p>
                    <p class=" fs-14px mb-0 ">Total Amount: <span
                                class="text-gray">{{ number_format($transfer->sending_amount+$transfer->company_charges,2) }} {{ $transfer->sending_currency }}</span>
                    </p>
                    <p class=" fs-14px mb-0 ">Delivery Method: <span
                                class="text-gray">{{ $transfer->receivingMethod->name }}</span></p>
                    <p class=" fs-14px mb-0 ">Payment Status: <span
                                class="badge {{ $transfer->paymentStatus->additional_info }}">{{ $transfer->paymentStatus->secondary_name }}</span></p>
                </div>


                <div class="col-md-6 col-12">
                    <p class=" fw-bold fs-14px ">&nbsp;</p>
                    <p class=" fs-14px mb-0 ">Transaction Code: <span
                                class="text-gray">{{ ($transfer->transfer_code) }} </span>
                    </p>
                    <p class=" fs-14px mb-0 ">Exchange Rate: <span
                                class="text-gray"> 1 {{ $transfer->sending_currency }}  = {{ $transfer->customer_rate }} {{ $transfer->receiving_currency }}</span>
                    </p>
                    <p class=" fs-14px mb-0 ">Payout Amount: <span
                                class="text-gray">  {{number_format( $transfer->receiving_amount ,2) }} {{ $transfer->receiving_currency }}</span>
                    </p>

                    <p class=" fs-14px mb-0 ">Sending Method: <span
                                class="text-gray"> {{ $transfer->sendingMethod->name }}</span>
                    </p>


                    <p class=" fs-14px mb-0 ">Payment Date: <span
                                class="text-gray"> {{ date('d M, Y h:i A',strtotime($transfer->created_at)) }}</span>
                    </p>


                </div>

                @if($transfer->status == 'PEN' && $transfer->sending_method_id =='91' )
                    <div class="alert  alert-warning mt-5">
                        <strong>Attention!</strong> <br>
                        Your funds have not yet been received. Please send
                        <strong>
                            {{ $transfer->sending_currency }} {{ number_format($transfer->sending_amount+$transfer->company_charges,2) }}</strong> on following details
                    </div>
                    <ul class="list mt-3">

                        <li>
                            <span>Account Name </span>
                            <strong>XMG FINANCIAL SERVICES LTD</strong>
                        </li>
                        <li>
                            <span>Sort Code</span>
                            <strong>04-00-72</strong>
                        </li>
                        <li>
                            <span>Account Number</span>
                            <strong>27942155</strong>
                        </li>

                        <li>
                            <span>Reference</span>
                            <strong>{{ ($transfer->transfer_code) }}</strong>
                        </li>



                    </ul>


                @endif

            </div>
        </div>
    </div>
</div>
</div>