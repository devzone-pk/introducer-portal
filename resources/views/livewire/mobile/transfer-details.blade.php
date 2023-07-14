<div id="appCapsule" class=" ">

    <div class="px-3 mb-5 mt-4">

        <p class="fs-20px text-full-black fw-bold">{{ ($details->transfer_code) }}
            <span class="badge rounded-2 right-14px position-absolute {{optional($details->paymentStatus)-> additional_info }}">{{ optional($details->paymentStatus)->secondary_name }}</span>
        </p>


        @if($details->status == 'PEN'  && $details->sending_method_id =='91')
            <div class="alert alert-warning">
                <strong>Attention!</strong> <br>
                Your funds have not yet been received. Please send on following details
            </div>
            <ul class="listview simple-listview shadow-c rounded mb-3 no-space mt-3">

                <li>
                    <span>Account Name </span>
                    <strong>XMG FINANCIAL SERVICES LTD </strong>
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
                    <strong>{{ ($details->transfer_code) }}</strong>
                </li>
            </ul>



        @endif

        <ul class="listview shadow-c rounded">
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ optional($details->beneficiary)->first_name }} {{ optional($details->beneficiary)->last_name }}</p>
                            <p class="fs-16px m-0 text-muted">Receiver</p>

                        </div>
                    </div>
                </a>
            </li>
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ optional($details->receivingMethod)->name }}</p>
                            <p class="fs-16px m-0 text-muted">Method</p>

                        </div>
                    </div>
                </a>
            </li>
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ optional($details->payer)->name }}</p>
                            <p class="fs-16px m-0 text-muted">Payout Partner</p>

                        </div>
                    </div>
                </a>
            </li>
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ $details->customer_rate }} {{ $details->receiving_currency }}</p>
                            <p class="fs-16px m-0 text-muted">1 {{ $details->sending_currency }}</p>

                        </div>
                    </div>
                </a>
            </li>
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ number_format($details->sending_amount,2) }} {{ $details->sending_currency }}</p>
                            <p class="fs-16px m-0 text-muted">Sending Amount</p>
                        </div>
                    </div>
                </a>
            </li>

            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ number_format($details->company_charges,2) }} {{ $details->sending_currency }}</p>
                            <p class="fs-16px m-0 text-muted">Fees</p>
                        </div>
                    </div>
                </a>
            </li>
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ number_format($details->sending_amount+$details->company_charges,2) }} {{ $details->sending_currency }}</p>
                            <p class="fs-16px m-0 text-muted">Total Amount</p>
                        </div>
                    </div>
                </a>
            </li>
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px fw-bold mb-0"
                            >{{ number_format($details->receiving_amount,2) }} {{ $details->receiving_currency }}</p>
                            <p class="fs-16px m-0 text-muted">Receiver Gets</p>
                        </div>
                    </div>
                </a>
            </li>

        </ul>


        <div class="rounded shadow-c bg-white mt-3 px-2 py-2 ">
            @if($details->status == 'INC')
                <a href="{{ url('gateway/trust/payment') }}/{{$details->transfer_code}}"
                   class="btn fs-12px btn-block btn-secondary mb-2 py-1">Complete</a>
                <br>
            @endif

            <a href="{{ url('mobile/customer-support/add') }}?transfer_id={{$details->id}}"
               class="btn   btn-light btn-block">
                Open Ticket
            </a>
        </div>


    </div>


</div>
