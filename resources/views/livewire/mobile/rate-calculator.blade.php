<div id="appCapsule">
    {{-- Do your work, then step back. --}}
    <div class="section mt-2">
        <div class="rounded bg-white shadow-c form-padding">
            <form wire:submit.prevent="validateSendingDetails">

                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <div
                                style="background: rgb(204 204 204 / 31%);"
                                role="button"
                                class="form-control mobile-input d-flex align-items-center">

                            <img class="imaged rounded w24 me-1"
                                 src="{{ url('images/flags') }}/{{ strtolower($country['iso2'])  }}.svg"
                                 alt="">

                            <span>{{ $country['name'] }}</span>


                        </div>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <div
                                role="button"
                                class="form-control mobile-input d-flex justify-content-between align-items-center  pe-2  @error('receiving_country.iso2') is-invalid @enderror"
                                wire:click.prevent="rcOpenModel('receiving_country','0')">
                            <div>
                                @if(!empty($receiving_country['iso2']))
                                    <img class="imaged rounded w24 me-1"
                                         src="{{ url('images/flags') }}/{{ strtolower($receiving_country['iso2']) }}.svg"
                                         alt="">
                                    <span>
                                        {{ $receiving_country['name'] }}
                                        </span>
                                @else
                                    <span class="text-placeholder">Select Receiving Country</span>
                                @endif
                            </div>

                            <ion-icon wire:ignore name="chevron-down-outline"></ion-icon>

                        </div>
                    </div>


                </div>
                @if(!empty($receiving_country['iso2']))
                    <div class="form-group boxed">
                        <div class="input-wrapper">

                            <div
                                    class="d-flex form-control mobile-input justify-content-between pe-2 align-items-center @error('selected_sending_method.id') is-invalid @enderror"
                                    role="button"
                                    wire:click.prevent="smOpenModel('selected_sending_method','0')">
                                    <span
                                            class="{{ empty($selected_sending_method['id']) ? 'text-placeholder' : '' }} ">{{ empty($selected_sending_method['id']) ? 'Select Sending Method' : $selected_sending_method['name']  }}</span>

                                <ion-icon wire:ignore name="chevron-down-outline"></ion-icon>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!empty($selected_sending_method['id']))
                    <div class="form-group boxed">
                        <div class="input-wrapper">

                            <div
                                    class="d-flex form-control mobile-input align-items-center  pe-2 justify-content-between @error('receiving_method') is-invalid @enderror"
                                    role="button"
                                    wire:click.prevent="rmOpenModel('receiving_method','0')">

                                    <span
                                            class="{{ empty($receiving_method) ? 'text-placeholder' : '' }} ">

                                        @if(strtolower($receiving_method) == 'cash')
                                            Cash Pickup
                                        @elseif(strtolower($receiving_method) == 'bank')
                                            Bank Deposit
                                        @elseif(strtolower($receiving_method) == 'wallet')
                                            Wallet
                                        @else
                                            Select Receiving Method
                                        @endif


                                    </span>

                                <ion-icon wire:ignore name="chevron-down-outline"></ion-icon>
                            </div>
                        </div>
                    </div>
                @endif

                @if(!empty($receiving_method))
                    <div class="form-group boxed">
                        <div class="input-wrapper">

                            <div
                                    style="padding-right: 16px; {{ !empty($selected_payer['name']) ? 'height: 58px;':'' }}"
                                    class="d-flex form-control mobile-input align-items-center  justify-content-between  @error('selected_payer.id') is-invalid @enderror"
                                    role="button"
                                    wire:click.prevent="payerOpenModel('selected_payer','0')">
                                <div class="d-flex flex-column ">
                                    @if(empty($selected_payer['name']))
                                        <div class="text-placeholder">Select Payout</div>
                                    @else
                                        <div class=" text-truncate" style="max-width: 90%;">
                                            {{ $selected_payer['name'] }}
                                        </div>
                                    @endif

                                    @if(!empty($selected_payer['name']))
                                        <strong
                                                class="fs-20px bold-600" style="color: #000;">{{
                                                !empty($selected_payer['rate_after_spread'])?
                                                number_format($selected_payer['rate_after_spread'],2) : '' }} {{ $selected_payer['currency'] }}</strong>
                                    @endif
                                </div>
                                <ion-icon wire:ignore name="chevron-down-outline"></ion-icon>
                            </div>
                        </div>
                    </div>
                @endif






                @if((!empty($selected_payer) ))
                    <div class="row">

                        <div class="col-12 mb-1">
                            <div class="mobile-amounts bg-white mt-1">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column py-2 px-3 ">

                                        <label class="label text-gray fs-16px">You Send</label>
                                        <input
                                                style="font-size: 24px !important;"
                                                onclick="this.select()" type="text"
                                                wire:model.debounce.1000ms="amounts.sending_amount"
                                                class="form-control sending-amount only-numbers form-control-lg leading-zero @error('amounts.sending_amount') is-invalid @enderror"
                                                id="youSend"
                                                value="" placeholder="" autocomplete="off" autocorrect="off"
                                                autocapitalize="off">
                                    </div>
                                    <div class="d-flex px-3 bg-gray-c justify-content-between align-items-center">
                                        <img class="  rounded-2 me-1 " style="width: 35px;"
                                             src="{{ url('images/flags') }}/{{ strtolower($country['iso2'])  }}.svg"
                                             alt="">

                                        <span class="fs-16px fw-bold"
                                              style="width: 40px;">{{ $country['currency'] }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="col-12">
                            <div class="mobile-amounts bg-white mt-1">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column py-2 px-3 ">

                                        <label class="label text-gray fs-16px">Recipient Gets</label>
                                        <input
                                                style="font-size: 24px !important;"
                                                onclick="this.select()" type="text"
                                                wire:model.debounce.1000ms="amounts.receive_amount"
                                                class="form-control sending-amount only-numbers form-control-lg leading-zero "
                                                id="recipient_gets"
                                                value="" placeholder="" autocomplete="off" autocorrect="off"
                                                autocapitalize="off">
                                    </div>
                                    <div class="d-flex px-3  bg-gray-c justify-content-between align-items-center">
                                        <img class="  rounded-2 me-1 " style="width: 40px;"
                                             src="{{ url('images/flags') }}/{{ strtolower($receiving_country['iso2']) }}.svg"
                                             alt="">

                                        <span class="fs-16px fw-bold"
                                              style="width: 35px;">{{ $receiving_country['currency'] }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="col-12 {{ empty($amounts['coupon_code'])? 'd-none' : '' }}"
                             id="have-coupon-input">
                            <div class="form-group basic">
                                <label class="label">Coupon Code</label>
                                <input
                                        oninput="this.value = this.value.toUpperCase()"
                                        style="font-size: 24px !important;"
                                        onclick="this.select()" type="text"
                                        wire:model.debounce.2000ms="amounts.coupon_code"
                                        class="form-control   form-control-lg "
                                        autocomplete="false" autocorrect="off"
                                        autocapitalize="off">
                            </div>
                        </div>

                        <div class="col-12 mt-2">


                            <ul class="listview profile-listview image-listview bg-white">
                                <li class="profile-list">
                                    <a href="#" class="item">
                                        <div class="in">
                                            <div>
                                                <p class="fs-16px mb-0">{{ $selected_payer['source_currency'] ?? '' }} {{ number_format($amounts['fees'],2) }}</p>
                                                <p class="fs-16px m-0 text-muted">Total Fees</p>

                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="profile-list">
                                    <a href="#" class="item">
                                        <div class="in">
                                            <div>
                                                <p class="fs-16px mb-0">{{$selected_payer['source_currency'] ?? ''}} {{ number_format($amounts['total'],2) }} </p>
                                                <p class="fs-16px m-0 text-muted">Total to Pay</p>

                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="profile-list">
                                    <a href="#" class="item">
                                        <div class="in">
                                            <div>
                                                <p class="fs-16px mb-0">{{$selected_payer['currency'] ?? ''}} {{ ($amounts['receive_amount']) }}</p>
                                                <p class="fs-16px m-0 text-muted">Recipient Gets</p>

                                            </div>
                                        </div>
                                    </a>
                                </li>

                            </ul>


                        </div>
                    </div>



                @endif

            </form>
        </div>
    </div>


    @include('inner.partials.modals.receiving-countries')
    @include('inner.partials.modals.receiving-methods')
    @include('inner.partials.modals.payer-list')
    @include('inner.partials.modals.sending-methods')
    @include('mobile.messages.error-messages')
</div>
