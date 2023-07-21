<div>
    <div class="row g-3">
        <div class="col-4 ">
            <div role="button" wire:click.prevent="sendMoney"
                 class="card bg-success  text-white card-border border-primary shadow-light-lg  ">
                <div class="card-body   fs-16px p-4">
                    <div class="d-flex  justify-content-center align-items-center">

                        <div class="me-2">
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.68213 12.3024L9.72081 14.3636L15.7958 8.15906" stroke="white"
                                      stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="11.5" cy="11.5" r="10.5" stroke="white" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        </div>
                        <div>
                            <span class="d-block d-md-none">Step 1</span>
                            <span class="d-none d-md-block">Transaction Details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4  ">
            <div wire:click.prevent="sendMoney" role="button"
                 class="card  bg-success  text-white card-border border-primary shadow-light-lg  ">
                <div class="card-body  fs-16px p-4">
                    <div class="d-flex justify-content-center align-items-center">

                        <div class="me-2">
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.68213 12.3024L9.72081 14.3636L15.7958 8.15906" stroke="white"
                                      stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="11.5" cy="11.5" r="10.5" stroke="white" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        </div>

                        <div>
                            <span class="d-block d-md-none">Step 2</span>
                            <span class="d-none d-md-block">Receiver Details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 ">
            <div class="card  bg-success text-white card-border border-primary shadow-light-lg  ">
                <div class="card-body fs-16px p-4">
                    <div class="d-flex  justify-content-center align-items-center">

                        <div class="me-2">
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.68213 12.3024L9.72081 14.3636L15.7958 8.15906" stroke="white"
                                      stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="11.5" cy="11.5" r="10.5" stroke="white" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        </div>

                        <div class="">
                            <span class="d-block d-md-none">Step 3</span>
                            <span class="d-none d-md-block">Confirm & Send</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card   card-border border-primary shadow-light-lg  ">
                <div class="card-body fs-16px text-center py-8">
                    <div class="">

                        <svg width="85" height="85" viewBox="0 0 85 85" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M27.7725 45.5953L35.636 53.5455L59.0679 29.6136" stroke="#42BA96" stroke-width="3"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="42.5" cy="42.5" r="40.5" stroke="#42BA96" stroke-width="3"
                                    stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>


                        <p class="fs-20px mt-3 fw-bold">
                            Your transaction has been placed successfully
                        </p>
                        <p class="   text-gray fw-bold">
                            Transfer Code: {{ $transfer->transfer_code }}
                        </p>

                        <p>
                            Thank you for using {{ config('app.company_name') }}!
                        </p>


                        @if($transfer->status == 'PEN' && $transfer->sending_method_id =='91' )
                            <div class="alert  alert-warning mt-5">
                                <strong>Attention!</strong> <br>
                                Your funds have not yet been received. Please send
                                <strong>
                                    {{ $transfer->sending_currency }} {{ number_format($transfer->sending_amount+$transfer->company_charges,2) }}</strong>
                                on following details
                            </div>
                            <ul class="list mt-3">

                                <li>
                                    <span>Account Name </span>
                                    <strong>- </strong>
                                </li>
                                <li>
                                    <span>Sort Code</span>
                                    <strong>-</strong>
                                </li>
                                <li>
                                    <span>Account Number</span>
                                    <strong>-</strong>
                                </li>
                                <li>
                                    <span>Reference</span>
                                    <strong>{{ ($transfer->transfer_code) }}</strong>
                                </li>
                            </ul>

                        @endif


                        <a class="btn btn-info px-5 py-1" href="{{ url('receipt') }}?transfer_id={{ ($transfer->id) }}"
                           target="_blank">View Receipt</a>

                    </div>

                </div>
            </div>
        </div>

    </div>


</div>
