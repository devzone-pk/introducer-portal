<div id="appCapsule" class="">
    <div class="section mt-3 text-center ">

            @if(empty($transfer))

                <h2>
                    Track Your Transaction
                </h2>
                <p class="text-gray m-0 px-4">
                    Track your transaction by entering your transaction code.
                </p>
                <form wire:submit.prevent="track">
                    <div class="form-group text-start mt-4 px-4">

                        <input type="text" wire:model.defer="transaction_code" class="form-control"
                               placeholder="Enter Transaction code" style="line-height: 2.5rem;font-size: 18px;">
                    </div>


                    <div class="form-button-group">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Track</button>
                    </div>
                </form>

                @if(!empty($error))
                    <div class="alert mt-2 mx-4 text-start  alert-danger">
                        {{ $error }}
                    </div>
                @endif

                @if($errors -> any())
                    <div class="alert mx-4 mt-2 text-start alert-danger">
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

            @endif


            @if(!empty($transfer))

                <div class="mt-5">
                    @if($transfer['status'] == 'PAI')
                        <svg width="85" height="85" viewBox="0 0 85 85" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M27.7727 45.5953L35.6362 53.5455L59.0682 29.6136" stroke="#34C759" stroke-width="3"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="42.5" cy="42.5" r="40.5" stroke="#34C759" stroke-width="3"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"/>
                        </svg>

                        <h2 class="mt-3">Your transaction status is:
                        </h2>

                        <h2>
                        <span class="rounded-2 bg-success px-2 py-1">
                            {{optional($transfer->paymentStatus)->secondary_name}}
                        </span>
                        </h2>
                    @else

                        <svg width="85" height="85" viewBox="0 0 85 85" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M28.7275 42.2725L55.2725 42.2725" stroke="#FE9500" stroke-width="3"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <circle cx="42.5" cy="42.5" r="40.5" stroke="#FE9500" stroke-width="3"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"/>
                        </svg>


                        <h2 class="mt-3">Your transaction status is:
                        </h2>

                        <h2>
                        <span class="rounded-2 {{optional($transfer->paymentStatus)->additional_info }} px-2 py-1">
                            {{optional($transfer->paymentStatus)->secondary_name}}
                        </span>
                        </h2>

                    @endif


                </div>

                <div class="mt-4">
                    <p class="fs-16px mb-0">
                        <span class="fw-bold">Transaction Code:</span> {{ $transfer['transfer_code'] }}</p>
                    <p class="fs-16px">
                        <span class="fw-bold">Receiver:</span> {{ optional($transfer->beneficiary)->first_name }}  {{ optional($transfer->beneficiary)->last_name }}
                    </p>
                </div>

                <div class="mt-2">
                    <p class="fs-16px mb-0">
                        Thank you for using
                    </p>
                    <p class="fs-16px mb-0 fw-bold text-danger">
                        {{ config('app.company_name') }}
                    </p>
                </div>

                <div class="form-button-group">
                    <button type="button" wire:click.prevent="resetData" class="btn btn-light btn-block btn-lg">Go
                        Back
                    </button>
                </div>

            @endif

    </div>
</div>
