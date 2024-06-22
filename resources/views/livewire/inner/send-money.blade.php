<div class="row g-3">
    <style>
        .select2-container--default .select2-selection--single {
            height: 30px;
            border: 1px solid #cbd5e1;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            border-radius: 6px;
            display: flex;
            align-items: center;
            font-size: 15px;
            font-weight: 400;
            padding: 0 5px;
        }

        .select2-container--default .select2-selection--single:focus {
            outline: none;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 60px;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #d1d5db;
            outline: none;
        }
    </style>
    @livewire('inner.sidebar')

    <div class="col-md-9 col-12 ">


        <div class="row g-3">
            <div class="col-xs-4 col-4">
                <div role="button" wire:click.prevent="goTo('transfer')"
                     class="card transfer-tab {{ $color_amount == 'bg-success' ? 'bg-success text-white' : '' }} {{ $selected_window == 'transfer' ? 'bg-danger' : '' }} card-border border-primary shadow-light-lg  ">
                    <div class="card-body   fs-16px p-4">
                        <div class="d-flex   justify-content-md-center align-items-lg-center">
                            @if ($color_amount == 'bg-success')
                                <div class="me-2">
                                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.68213 12.3024L9.72081 14.3636L15.7958 8.15906" stroke="white"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <circle cx="11.5" cy="11.5" r="10.5" stroke="white" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>

                                </div>
                            @endif
                            <div class="">
                                <span class="d-block d-md-none">Step 1</span>
                                <span class="d-none d-md-block">Transaction Details</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-4">
                <div wire:click.prevent="goTo('beneficiary')" role="button"
                     class="card  transfer-tab {{ $color_beneficiary == 'bg-success' ? 'bg-success text-white' : '' }} {{ $selected_window == 'beneficiary' || $selected_window == 'bank' ? 'bg-danger' : '' }}  card-border border-primary shadow-light-lg  ">
                    <div class="card-body  fs-16px p-4">
                        <div class="d-flex justify-content-md-center align-items-center">
                            @if ($color_beneficiary == 'bg-success')
                                <div class="me-2">
                                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.68213 12.3024L9.72081 14.3636L15.7958 8.15906" stroke="white"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <circle cx="11.5" cy="11.5" r="10.5" stroke="white" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>

                                </div>
                            @endif
                            <div>
                                <span class="d-block d-md-none">Step 2</span>
                                <span class="d-none d-md-block">Receiver Details</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-4">
                <div
                        class="card  transfer-tab {{ $color_confirm == 'bg-success' ? 'bg-success text-white' : '' }} {{ $selected_window == 'confirm' ? 'bg-danger' : '' }}   card-border border-primary shadow-light-lg  ">
                    <div class="card-body fs-16px p-4">
                        <div class="d-flex  justify-content-md-center align-items-center">
                            @if ($color_confirm == 'bg-success')
                                <div class="me-2">
                                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.68213 12.3024L9.72081 14.3636L15.7958 8.15906" stroke="white"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <circle cx="11.5" cy="11.5" r="10.5" stroke="white" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>

                                </div>
                            @endif
                            <div class="">
                                <span class="d-block d-md-none">Step 3</span>
                                <span class="d-none d-md-block">Confirm & Send</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div
                        class="card card-border border-primary shadow-light-lg  {{ $selected_window == 'transfer' ? '' : 'd-none' }} ">
                    <div class="card-header">Transaction Details</div>
                    <div class="card-body">
                        <form wire:submit.prevent="validateSendingDetails">
                            <div class="row g-4">
                                <div class="col-xs-12 col-sm-6 d-none">
                                    <div class="mb-3">
                                        <label class="form-label fs-16px mb-1">Sending from</label>
                                        <div readonly class="d-flex bg-light  fs-16px form-control align-items-center">
                                            <span>{{ session('country_name') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 {{ count($rc_data) == 1 ? 'd-none':'' }}">
                                    <div class="mb-3">
                                        <label class="form-label fs-16px mb-1">Sending to</label>
                                        <select name="" wire:model="receiving_country_id"
                                                class="form-select fs-16px  @error('receiving_country.iso2') is-invalid @enderror">
                                            <option value="">Select</option>
                                            @foreach ($rc_data as $s)
                                                <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                                            @endforeach
                                        </select>

                                        @error('receiving_country.iso2')
                                        <span class="invalid-feedback fs-14px" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror


                                    </div>
                                </div>


                                <div class="col-xs-12   col-sm-6  {{ count($receiving_methods) == 1 ? 'd-none':'' }}">
                                    <div class="mb-3">
                                        <label class="form-label fs-16px mb-1">Receiving Method</label>
                                        <select name="" wire:model="receiving_method"
                                                class="form-select fs-16px  @error('receiving_method') is-invalid @enderror">
                                            <option value="">Select</option>
                                            @foreach ($receiving_methods as $s)
                                                <option value="{{ $s }}">{{ ucwords($s) }}</option>
                                            @endforeach
                                        </select>
                                        @error('receiving_method')
                                        <span class="invalid-feedback fs-14px" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror


                                    </div>
                                </div>


                                <div class="col-xs-12   {{ count($payers) == 1 ? 'd-none':'' }}">
                                    <div class="mb-3">
                                        <label class="form-label fs-16px mb-1">Payout Using</label>

                                        <div class="input-group d-flex mb-3">
                                            @if (!empty($selected_payer['name']) && false)
                                                <div class="input-group-text w-50 text-start">

                                                    <p class="m-0 fs-20 bold-600  text-truncate">

                                                        {{ $selected_payer['name'] }} <br>
                                                        {{ !empty($selected_payer['rate_after_spread']) ? number_format($selected_payer['rate_after_spread'], 2) : '' }}
                                                        {{ $selected_payer['currency'] }}
                                                    </p>

                                                </div>
                                            @endif

                                            <select name="" wire:model="payer_id"
                                                    class="form-select  fs-16px  @error('selected_payer.id') is-invalid @enderror">
                                                <option value="">Select</option>
                                                @foreach (collect($payers)->sortBy('name')->toArray() as $s)
                                                    <option  value="{{ $s['id'] }}">{{ ($s['name']) }}
                                                        - {{ $s['currency'] }} {{ (!empty($s['customer_rate_id']) && $s['customer_rate_type'] == 'increment')  ? $this->addCombiningLongStrokeOverlay($s['rate_after_spread'] - $s['customer_rate_value'])  :  ''}} {{ number_format($s['rate_after_spread'],2) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('selected_payer.id')
                                            <span class="invalid-feedback fs-14px" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror

                                        </div>


                                    </div>
                                </div>

                                @if (strtolower($this->receiving_method) == 'cash')
                                    <div class="col-xs-12 ">
                                        <div class="mb-3">
                                            <label class="form-label fs-16px mb-1">Pick-up Location</label>
                                            <select name="" wire:model="selected_cash_destination"
                                                    class="form-select fs-16px  @error('selected_cash_destination') is-invalid @enderror">
                                                <option value="">Select</option>
                                                @foreach ($sd_data as $s)
                                                    <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                                                @endforeach
                                            </select>
                                            @error('selected_cash_destination')
                                            <span class="invalid-feedback fs-14px" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror


                                        </div>
                                    </div>
                                @endif

                                @if (!empty($selected_payer))
                                    <div class="col-xs-12">
                                        <div class="mb-3">
                                            <label for="youSend" class="form-label mb-1">
                                                You Send</label>

                                            <div class="input-group">
                                                <input style="font-size: 24px !important;" onclick="this.select()"
                                                       type="text" wire:model.debounce.1000ms="amounts.sending_amount"
                                                       class="form-control only-numbers  form-control-lg leading-zero @error('amounts.sending_amount') is-invalid @enderror"
                                                       id="youSend" value="" placeholder="" autocomplete="off"
                                                       autocorrect="off" autocapitalize="off">


                                                <span class="input-group-text fs-20px text-secondary fw-bold">
                                                    <img class="w-48px border rounded me-2"
                                                         src="{{ asset('assets/flags/' . session('iso2') . '.svg') }}"
                                                         alt="">
                                                    {{ $selected_payer['source_currency'] ?? '' }}
                                                </span>
                                                @error('amounts.sending_amount')
                                                <span class="invalid-feedback fs-14px" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="mb-3">
                                            <label for="recipient_gets" class="form-label mb-1">Recipient
                                                Gets</label>
                                            <div class="input-group">
                                                <input style="font-size: 24px !important;" onclick="this.select()"
                                                       type="text" wire:model.debounce.1000ms="amounts.receive_amount"
                                                       class="form-control only-numbers   form-control-lg leading-zero @error('amounts.receive_amount') is-invalid @enderror "
                                                       id="recipient_gets" value="" placeholder=""
                                                       autocomplete="off" autocorrect="off" autocapitalize="off">


                                                <span class="input-group-text fs-20px text-secondary fw-bold">

                                                    <img class="w-48px border rounded me-2"
                                                         src="{{ asset('assets/flags/' . $receiving_country['iso2'] . '.svg') }}"
                                                         alt="">
                                                    {{ $selected_payer['currency'] ?? '' }}
                                                </span>
                                                @error('amounts.receive_amount')
                                                <span class="invalid-feedback fs-14px" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if (!empty($selected_payer))

                                <p class="  text-center">The current exchange rate is
                                    @if(!empty($selected_payer['customer_rate_id']) && $selected_payer['customer_rate_type'] == 'increment')
                                        <span
                                                class="fw-500">{{ $selected_payer['source_currency'] ?? '' }} 1 = <span style="text-decoration: line-through;color: red"> {{ round($selected_payer['rate_after_spread'] -  $selected_payer['customer_rate_value'],2) }} </span> <span style="color: green">{{ round($selected_payer['rate_after_spread'],2) }}   {{$selected_payer['currency'] ?? ''}}</span></span>
                                    @else
                                        <span
                                                class="fw-500">{{ $selected_payer['source_currency'] ?? '' }} 1 = {{ round($selected_payer['rate_after_spread'],2) }} {{$selected_payer['currency'] ?? ''}}</span>
                                    @endif
                                </p>
                                @if (!$show_coupon_input  && false)
                                    <div class="col-12 {{ !empty($amounts['coupon_code']) ? 'd-none' : '' }}"
                                         style="color: #002f6c" id="have-coupon">
                                        <a wire:click.prevent="couponShowInput()" style="cursor: pointer">
                                            Have a Coupon?
                                        </a>
                                    </div>
                                @endif

                                @if ($show_coupon_input)
                                    <div class="col-xs-12">
                                        <div class="mb-3">
                                            <label class="form-label mb-1">Coupon Code</label>
                                            <input type="text" class="form-control" onclick="this.select()"
                                                   autocorrect="off" autocapitalize="off"
                                                   wire:model.debounce.2000ms="amounts.coupon_code"
                                                   placeholder="Enter code here..." autocomplete="off">
                                        </div>
                                    </div>
                                @endif

                                <hr>

                                <div class="row my-5">
                                    <div class="col-12 col-md-4">
                                        @if (!empty($free_fee_offer['status']) && !empty($free_fee_offer['id']) && $free_fee_offer['save'] > 0)
                                            @php
                                                $free_fee_check = true;
                                            @endphp
                                            <p class="text-danger text-decoration-line-through m-0 fw-bold">
                                                {{ $selected_payer['source_currency'] ?? '' }}
                                                {{ number_format($free_fee_offer['save'], 2) }}
                                            </p>
                                            <p class="mb-0 fw-bold fs-20px text-success">
                                                {{ $selected_payer['source_currency'] ?? '' }}
                                                {{ number_format($amounts['fees'], 2) }}
                                            </p>
                                        @else
                                            @if (!empty($coupon['receive_amount']))
                                                &nbsp;
                                            @endif
                                            <p class="mb-0 fw-bold fs-20px">{{ $selected_payer['source_currency'] ?? '' }} {{ number_format($amounts['fees'],2) }}</p>
                                        @endif
                                        <p class="mb-0 text-gray fs-14px">Total Fees</p>

                                    </div>

                                    <div class="col-12 col-md-4">
                                        @if (!empty($coupon['receive_amount']) || !empty($free_fee_check))
                                            &nbsp;
                                        @endif
                                        <p class="mb-0 fw-bold fs-20px">{{ $selected_payer['source_currency'] ?? '' }}
                                            {{ number_format($amounts['total'], 2) }}</p>
                                        <p class="mb-0 text-gray fs-14px">Total To Pay</p>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        @if (!empty($coupon['receive_amount']))
                                            <p class="text-danger text-decoration-line-through m-0 fw-bold">
                                                {{ $selected_payer['currency'] ?? '' }}
                                                {{ number_format(str_replace(',', '',$amounts['receive_amount']),2) }}
                                            </p>
                                            <p class="text-success mb-0 fw-bold fs-20px">
                                                {{ $selected_payer['currency'] ?? '' }}
                                                {{ number_format(str_replace(',', '', $amounts['receive_amount']) + $coupon['receive_amount'], 2) }}
                                            </p>
                                        @elseif (empty($coupon['receive_amount']) && !empty($free_fee_check))
                                            &nbsp;
                                            <p class="mb-0 fw-bold fs-20px">
                                                {{ $selected_payer['currency'] ?? '' }}
                                                {{ number_format(str_replace(',', '',$amounts['receive_amount']),2) }}
                                            </p>
                                        @else
                                            <p class="mb-0 fw-bold fs-20px">
                                                {{ $selected_payer['currency'] ?? '' }}
                                                {{ number_format(str_replace(',', '',$amounts['receive_amount']),2) }}
                                            </p>
                                        @endif
                                        <p class="mb-0 text-gray fs-14px">Recipient Gets</p>
                                    </div>
                                </div>
                                @if (!empty($free_fee_offer['status']) && !empty($free_fee_offer['id']) && $free_fee_offer['save'] > 0 && !empty($free_fee_offer['message']))
                                    <div class="p-4 bg-success rounded mb-4">
                                        <p class="text-white mb-0">{{ ucfirst($free_fee_offer['message']) }}</p>
                                    </div>
                                @endif




 
                                <div class=" my-2 alert alert-warning    @if($payment_done == 'false') d-none @endif">

                                    <p class="m-0">
                                        <span>Bank Name: </span>
                                        <strong>Clear Bank</strong>
                                    </p>
                                    <p class="m-0">
                                        <span>Account Title: </span>
                                        <strong>REMIT UNION LIMITED</strong>
                                    </p>
                                    <p class="m-0">
                                        <span>Sort Code: </span>
                                        <strong>040693</strong>
                                    </p>
                                    <p class="m-0">
                                        <span>Account Number: </span>
                                        <strong>00000165</strong>
                                    </p>

                                    <p>Remit Union is our Financial Partner and they collect funds on behalf of
                                        OriumPay.</p>

                                </div>
                                <p class="my-2 mx-1 fw-bold  @if($payment_done == 'false') d-none @endif"> Has payment been deposited into the account stated above?</p>
                                <div class="d-flex w-50 justify-content-between mb-3 my-2  mx-1 ">
                                    <div class="form-check">
                                        <label class="form-check-label" for="customCheckb1">
                                            Yes
                                        </label>

                                        <input type="radio" wire:model="payment_done" value="true"
                                               class="form-check-input  @error('agree') is-invalid @enderror">
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            No
                                        </label>
                                        <input type="radio" wire:model="payment_done" value="false"
                                               class="form-check-input  @error('agree') is-invalid @enderror">
                                    </div>
                                </div>
                                @if($payment_done == 'true')
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary  shadow-none">Continue</button>
                                    </div>
                                @elseif($payment_done == 'false')

                                    <p class="my-2 mx-1 text-danger fw-bold">Please deposit the payment into the account stated below.</p>

                                    <div class=" my-2 alert alert-warning">

                                        <p class="m-0">
                                            <span>Bank Name: </span>
                                            <strong>Clear Bank</strong>
                                        </p>
                                        <p class="m-0">
                                            <span>Account Title: </span>
                                            <strong>REMIT UNION LIMITED</strong>
                                        </p>
                                        <p class="m-0">
                                            <span>Sort Code: </span>
                                            <strong>040693</strong>
                                        </p>
                                        <p class="m-0">
                                            <span>Account Number: </span>
                                            <strong>00000165</strong>
                                        </p>

                                        <p>Remit Union is our Financial Partner and they collect funds on behalf of
                                            OriumPay.</p>

                                    </div>

                                @endif

                            @endif


                        </form>
                    </div>
                </div>


                <div
                        class="card card-border border-primary shadow-light-lg {{ $selected_window == 'beneficiary' ? '' : 'd-none' }}">
                    <div class="card-header">Receiver Details</div>
                    <div class="card-body">
                        <form wire:submit.prevent="validateBeneficiaryDetail">
                            <div class="row g-4">
                                <div class="col-xs-12  ">
                                    <div class="mb-3">
                                        <label class="form-label fs-16px mb-1">Choose From Existing Receivers</label>
                                        <select name="" wire:model="beneficiary_id"
                                                class="form-select fs-16px  @error('beneficiary_id') is-invalid @enderror">
                                            <option value="">Select</option>
                                            @foreach ($bene_data as $s)
                                                <option value="{{ $s['id'] }}">
                                                    {{ $s['first_name'] . ' ' . $s['last_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                @if ($show_beneficiary)
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label fs-16px  mb-1">First Name</label>
                                            <input type="text" placeholder="First Name" autocomplete="false"
                                                   autocorrect="off" autocapitalize="off"
                                                   wire:model.defer="selected_beneficiary.first_name"
                                                   class="form-control  fs-16px  only-name  @error('selected_beneficiary.first_name') is-invalid @enderror">

                                            @error('selected_beneficiary.first_name')
                                            <span class="invalid-feedback fs-14px" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label fs-16px  mb-1">Last Name</label>
                                            <input type="text" placeholder="Last Name" autocomplete="false"
                                                   autocorrect="off" autocapitalize="off"
                                                   wire:model.defer="selected_beneficiary.last_name"
                                                   class="form-control fs-16px   only-name  @error('selected_beneficiary.last_name') is-invalid @enderror">
                                            @error('selected_beneficiary.last_name')
                                            <span class="invalid-feedback fs-14px" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 ">
                                        <div class="mb-3">
                                            <label class="form-label   fs-16px mb-1">Phone</label>
                                            <div class="input-group mb-3">
                                                <span
                                                        class="input-group-text">{{ $selected_beneficiary['code'] ?? '' }}</span>
                                                <input type="text"
                                                       class="form-control only-just-numbers fs-16px   @error('selected_beneficiary.phone') is-invalid @enderror"
                                                       wire:model.defer="selected_beneficiary.phone"
                                                       placeholder="Phone number">
                                                @error('selected_beneficiary.phone')
                                                <span class="invalid-feedback fs-14px" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label fs-16px  mb-1">Your Relationship</label>
                                            <select name="" wire:model="selected_beneficiary.relationship_id"
                                                    class="form-select fs-16px  @error('selected_beneficiary.relationship_id') is-invalid @enderror">
                                                <option value="">Select</option>
                                                @foreach ($rl_data as $s)
                                                    <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                                                @endforeach
                                            </select>
                                            @error('selected_beneficiary.relationship_id')
                                            <span class="invalid-feedback fs-14px" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label fs-16px  mb-1">Sending Reason</label>
                                            <select name="" wire:model="selected_sending_reason"
                                                    class="form-select fs-16px  @error('selected_sending_reason') is-invalid @enderror">
                                                <option value="">Select</option>
                                                @foreach ($sr_data as $s)
                                                    <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                                                @endforeach
                                            </select>
                                            @error('selected_sending_reason')
                                            <span class="invalid-feedback fs-14px" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class=" @if ($show_beneficiary) col-sm-6 @endif col-xs-12 d-grid">
                                    @if (!$show_beneficiary)
                                        <p class="text-muted py-2 text-center">
                                            OR
                                        </p>
                                    @endif

                                    <button type="button" wire:click.prevent="addNewBeneficiary"
                                            class="btn btn-light shadow-none">Add New Receiver
                                    </button>
                                </div>


                                @if ($show_beneficiary)
                                    <div class="col-sm-6 col-xs-12 d-grid">
                                        <button type="submit" class="btn btn-primary shadow-none">Continue</button>
                                    </div>
                                @endif


                            </div>
                        </form>
                    </div>
                </div>


                <div
                        class="card card-border border-primary shadow-light-lg {{ $selected_window == 'bank' ? '' : 'd-none' }}">
                    <div class="card-header">Receiver Bank Details</div>
                    <div class="card-body">
                        <form wire:submit.prevent="validateBeneficiaryBankDetail">
                            <div class="row g-4">


                                <div class="col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label fs-16px mb-1">Select Existing Receiver Account</label>
                                        <select name="" wire:model="beneficiary_bank_id"
                                                class="form-select fs-16px  ">
                                            <option value="">Select</option>
                                            @foreach ($bb_data as $s)
                                                <option value="{{ $s['id'] }}">{{ $s['old_name'] }}</option>
                                            @endforeach
                                        </select>


                                    </div>
                                </div>

                                @if ($show_beneficiary_bank)
                                    <div class="col-xs-12">
                                        <div class="mb-3">
                                            <label class="form-label mb-1">Bank</label>
                                            <select name="" onchange="myFunction()"
                                                    wire:model="selected_bank_beneficiary.bank_id"
                                                    class="form-select fs-16px @error('selected_bank_beneficiary.bank_id') is-invalid @enderror">
                                                <option value="">Select</option>
                                                @foreach (collect($sb_data)->sortBy('name')->toArray() as $s)
                                                    <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                                                @endforeach
                                            </select>
                                            @error('selected_bank_beneficiary.bank_id')
                                            <span class="invalid-feedback fs-14px" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror

                                        </div>
                                    </div>


                                    @if ($receiving_country['iso2'] == 'BD')
                                        <div class="col-xs-12">
                                            <div class="mb-3">
                                                <label class="form-label mb-1">Branch Name</label>
                                                <select name=""
                                                        wire:model="selected_bank_beneficiary.branch_name"
                                                        id="select2_dropdown" onchange="branchChange()"
                                                        class="form-select fs-16px select2_dropdown  @error('selected_bank_beneficiary.branch_name') is-invalid @enderror">
                                                    <option value="">Select</option>
                                                    @foreach ($branches as $dist => $ss)
                                                        <optgroup label="{{ $dist }}"></optgroup>

                                                        @foreach (collect($ss)->sortBy('branch_name')->toArray() as $s)
                                                            <option value="{{ $s['branch_name'] }}">
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $s['branch_name'] }}
                                                            </option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                                @error('selected_bank_beneficiary.branch_name')
                                                <span class="invalid-feedback fs-14px" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="mb-3">
                                                <label class="form-label mb-1">Routing #</label>
                                                <input name=""
                                                       wire:model="selected_bank_beneficiary.branch_code" readonly
                                                       class="form-select fs-16px @error('selected_bank_beneficiary.branch_code') is-invalid @enderror">
                                                {{--                                                    <option value="">Select</option> --}}
                                                {{--                                                    @foreach ($routings as $s) --}}
                                                {{--                                                        <option value="{{ $s['code'] }}">{{ $s['code'] }}</option> --}}
                                                {{--                                                    @endforeach --}}

                                                @error('selected_bank_beneficiary.branch_code')
                                                <span class="invalid-feedback fs-14px" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="mb-3">
                                                <label class="form-label fs-16px mb-1">Account #</label>
                                                <input type="text" placeholder="Account #"
                                                       wire:model.lazy="selected_bank_beneficiary.account_no"
                                                       autocomplete="false" autocorrect="off" autocapitalize="off"
                                                       class="form-control fs-16px pe-2 @error('selected_bank_beneficiary.account_no') is-invalid @enderror">
                                                @error('selected_bank_beneficiary.account_no')
                                                <span class="invalid-feedback fs-14px" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @else
                                        @foreach ($validation as $v)
                                            <div class="col-xs-12">
                                                <div class="mb-3">
                                                    <label class="form-label fs-16px mb-1">{{ $v['label'] }}</label>
                                                    <input type="{{ $v['type'] }}"
                                                           placeholder="{{ $v['placeholder'] }}"
                                                           wire:model.lazy="selected_bank_beneficiary.{{ $v['name'] }}"
                                                           autocomplete="false" autocorrect="off" autocapitalize="off"
                                                           class="form-control fs-16px {{ $v['class'] }} pe-2 @error('selected_bank_beneficiary.' . $v['name']) is-invalid @enderror">
                                                    @error('selected_bank_beneficiary.' . $v['name'])
                                                    <span class="invalid-feedback fs-14px" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                    <small class="form-text text-muted">{!! $v['help_message'] !!}</small>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endif

                                <div class=" @if ($show_beneficiary_bank) col-sm-6 @endif  col-xs-12 d-grid">

                                    @if (!$show_beneficiary_bank)
                                        <p class="text-muted py-2 text-center">
                                            OR
                                        </p>
                                    @endif
                                    <button type="button" class="btn btn-light  shadow-none" id="new_bank"
                                            wire:click.prevent="addNewBeneficiaryBank">Add New Bank
                                    </button>
                                </div>
                                @if ($show_beneficiary_bank)
                                    <div class="col-sm-6 col-xs-12 d-grid">
                                        <button type="submit" class="btn btn-primary shadow-none">Continue</button>
                                    </div>
                                @endif

                            </div>


                        </form>
                    </div>
                </div>

                <div
                        class="card card-border border-primary shadow-light-lg {{ $selected_window == 'confirm' ? '' : 'd-none' }}">
                    <div class="card-header">Please Verify Transaction Details then Press Confirm & Send</div>
                    <div class="card-body">
                        <form wire:submit.prevent="sendMoney">

                            <div class="row g-5">
                                <div class="col-6">

                                    <p class=" fs-16px mb-0 ">{{ $selected_beneficiary['first_name'] }}
                                        {{ $selected_beneficiary['last_name'] }}</p>
                                    <p class="text-gray fs-12px mb-0">Beneficiary Name</p>
                                </div>

                                <div class="col-6">
                                    <p class=" fs-16px mb-0 ">{{ $receiving_method }}</p>
                                    <p class="text-gray fs-12px mb-0">Delivery Method</p>
                                </div>


                                <div class="col-6">
                                    <p class=" fs-16px mb-0 ">{{ $selected_beneficiary['relationship_name'] ?? '' }}
                                    </p>
                                    <p class="text-gray fs-12px mb-0">Beneficiary Relationship</p>
                                </div>

                                <div class="col-6 ">
                                    <p class=" fs-16px mb-0 ">{{ $selected_beneficiary['code'] ?? '' }}
                                        {{ $selected_beneficiary['phone'] ?? '' }}</p>
                                    <p class="text-gray fs-12px mb-0">Beneficiary Phone</p>
                                </div>
                                @if (strtolower($receiving_method) == 'bank')
                                    <div class="col-6 ">
                                        <p class=" fs-16px mb-0 ">{{ $selected_bank_beneficiary['name'] ?? '' }}</p>
                                        <p class="text-gray fs-12px mb-0">Bank Name</p>
                                    </div>



                                    @if (!empty($selected_bank_beneficiary['branch_name']))
                                        <div class="col-6 ">
                                            <p class=" fs-16px mb-0 ">
                                                {{ $selected_bank_beneficiary['branch_name'] ?? '' }}</p>
                                            <p class="text-gray fs-12px mb-0">Branch Name</p>
                                        </div>
                                    @endif


                                    @if (!empty($selected_bank_beneficiary['branch_code']))
                                        <div class="col-6">
                                            <p class=" fs-16px mb-0 ">
                                                {{ $selected_bank_beneficiary['branch_code'] ?? '' }}</p>
                                            <p class="text-gray fs-12px mb-0">Branch Code/Routing # </p>
                                        </div>
                                    @endif


                                    @if (!empty($selected_bank_beneficiary['account_no']))
                                        <div class="col-6">
                                            <p class=" fs-16px mb-0 ">
                                                {{ $selected_bank_beneficiary['account_no'] ?? '' }}</p>
                                            <p class="text-gray fs-12px mb-0">IBAN/Account #</p>
                                        </div>
                                    @endif



                                    @if (!empty($selected_bank_beneficiary['iban']))
                                        <div class="col-6">
                                            <p class=" fs-16px mb-0 ">{{ $selected_bank_beneficiary['iban'] ?? '' }}
                                            </p>
                                            <p class="text-gray fs-12px mb-0">IBAN/Account #</p>
                                        </div>
                                    @endif

                                @endif
                                @if (strtolower($receiving_method) == 'cash')
                                    <div class="col-6">
                                        <p class=" fs-16px mb-0 ">{{ $selected_payer['name'] ?? '' }}</p>
                                        <p class="text-gray fs-12px mb-0">Receive From</p>
                                    </div>
                                @endif

                                <div class="col-6">
                                    <p class=" fs-16px mb-0 ">{{ $selected_sending_method['name'] ?? '' }}</p>
                                    <p class="text-gray fs-12px mb-0">Sending Method</p>
                                </div>

                                <div class="col-6">
                                    <p class=" fs-16px mb-0 ">{{ $amounts['sending_amount'] }}
                                        {{ $selected_payer['source_currency'] ?? '' }}</p>
                                    <p class="text-gray fs-12px mb-0">Sending Amount</p>
                                </div>
                                <div class="col-6">
                                    @if (!empty($free_fee_offer['status']) && !empty($free_fee_offer['id']) && $free_fee_offer['save'] > 0)
                                        <p class="m-0 fs-6">
                                            &nbsp;
                                        </p>
                                    @endif
                                        @if(!empty($selected_payer['customer_rate_id']) && $selected_payer['customer_rate_type'] == 'increment')
                                            <p class="fs-12px mb-0">&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <span style="text-decoration: line-through;color: red">{{ number_format($selected_payer['rate_after_spread'] -  $selected_payer['customer_rate_value'],2) }} </span>
                                            </p>
                                            <p class=" fs-16px mb-0 ">1 {{ $selected_payer['source_currency'] ?? '' }}
                                                =  <span style="color: green"> {{ number_format($selected_payer['rate_after_spread'] ?? 0,2) }}
                                                    {{ $selected_payer['currency'] ?? '' }} </span></p>
                                        @else
                                            <p class=" fs-16px mb-0 ">1 {{ $selected_payer['source_currency'] ?? '' }}
                                                = {{ number_format($selected_payer['rate_after_spread'] ?? 0,2) }}
                                                {{ $selected_payer['currency'] ?? '' }}</p>
                                        @endif
                                    <p class="text-gray fs-12px mb-0">
                                        Exchange Rate</p>
                                </div>


                                <div class="col-6">
                                    @if (!empty($free_fee_offer['status']) && !empty($free_fee_offer['id']) && $free_fee_offer['save'] > 0)
                                        <p class="text-danger text-decoration-line-through m-0 p-0 fs-6 fw-bold">
                                            {{ number_format($free_fee_offer['save'], 2) }}
                                            {{ $selected_payer['source_currency'] ?? '' }}
                                        </p>
                                        <p class="text-success mb-0 fs-16px fw-bold">
                                            {{ number_format($amounts['fees'], 2) }}
                                            {{ $selected_payer['source_currency'] ?? '' }}
                                        </p>
                                    @else
                                        @if(!empty($selected_payer['customer_rate_id']) && $selected_payer['customer_rate_type'] == 'increment')
                                            <p class="fs-12px mb-0">
                                                &nbsp;
                                            </p>
                                        @endif
                                        <p class=" fs-16px mb-0 ">{{ number_format($amounts['fees'] ?? 0,2) }}
                                            {{ $selected_payer['source_currency'] ?? '' }}</p>
                                    @endif
                                    <p class="text-gray fs-12px mb-0">Transaction Fee</p>
                                </div>
                                <div class="col-6">
                                    @if (!empty($coupon['receive_amount']))
                                        <p class="text-danger text-decoration-line-through m-0 p-0 fs-6 fw-bold">
                                            {{ number_format(str_replace(',', '',$amounts['receive_amount']),2) }} {{ $selected_payer['currency'] ?? '' }}
                                        </p>
                                        <p class="text-success mb-0 fs-16px fw-bold">
                                            {{ number_format(str_replace(',', '', $amounts['receive_amount']) + $coupon['receive_amount'], 2) }}
                                            {{ $selected_payer['currency'] ?? '' }}
                                        </p>
                                    @else
                                        <p class="fs-16px mb-0">
                                            {{ number_format(str_replace(',', '',$amounts['receive_amount']),2) }} {{ $selected_payer['currency'] ?? '' }}
                                        </p>
                                    @endif
                                    <p class="text-gray fs-12px mb-0">Recipient Gets</p>
                                </div>
                                <div class="col-6">
                                    @if (!empty($coupon['receive_amount']))
                                        <p class="m-0 fs-6">
                                            &nbsp;
                                        </p>
                                    @endif
                                    <p class=" fs-16px mb-0 ">{{ number_format($amounts['total'] ?? 0, 2) }}
                                        {{ $selected_payer['source_currency'] ?? '' }}</p>
                                    <p class="text-gray fs-12px mb-0">Total Amount to Pay</p>
                                </div>
                                @if (!empty($free_fee_offer['status']) && !empty($free_fee_offer['id']) && $free_fee_offer['save'] > 0 && !empty($free_fee_offer['message']))
                                    <div class=" col-12 ">
                                        <div class=" p-4 bg-success rounded">
                                            <p class="text-white mb-0">{{ ucfirst($free_fee_offer['message']) }}</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-xs-12  ">
                                    <div class="mb-3">
                                        <label class="form-label fs-16px mb-1">Payment Method</label>
                                        <select name="" wire:model="sending_method_id"
                                                class="form-select fs-16px  @error('selected_sending_method.id') is-invalid @enderror">
                                            <option value="">Select</option>
                                            @foreach ($sm_data as $s)
                                                <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                                            @endforeach

                                        </select>
                                        @error('selected_sending_method.id')
                                        <span class="invalid-feedback fs-14px" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </div>
                                </div>


                                <div class="col-xs-12  ">
                                    <div class="mb-3">
                                        <label class="form-label fs-16px mb-1">Source of Funds</label>
                                        <select name="" wire:model="source_of_funds"
                                                class="form-select fs-16px  @error('source_of_funds') is-invalid @enderror">
                                            <option value="">Select</option>
                                            @php
                                                $sources = ['SALARY', 'SAVINGS', 'BUSINESS', 'GIFT', 'PENSION', 'BANK LOAN', 'SALES OF PROPERTY OR ASSETS'];
                                            @endphp
                                            @foreach (collect($sources)->sort() as $s)
                                                <option value="{{ $s }}">{{ $s }}</option>
                                            @endforeach
                                        </select>
                                        @error('source_of_funds')
                                        <span class="invalid-feedback fs-14px" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-12">
                                    <p class="mb-0 fw-bold">By proceeding with this transaction, you confirm the
                                        following:</p>
                                    <ul class="fs-14px">
                                        <li>You are using your personal card/account and not a third-party payment
                                            card/account.
                                        </li>
                                        <li>You are not using any Business/Commercial card/account.</li>
                                        <li>Your detail provided during sign-up, for example Name and Address
                                            must be the same information held by issuing bank and payment card
                                            company.
                                        </li>
                                        <li>This transaction complies with our terms & conditions.</li>
                                    </ul>
                                </div>


                                <div class="d-grid col-xs-12">

                                    <button type="submit" class="btn btn-primary shadow-none">Confirm and Send
                                    </button>
                                </div>

                            </div>


                        </form>

                    </div>
                </div>

                @error('error')
                <div class="alert alert-danger mb-3 fade show d-flex justify-content-between" role="alert">
                    <div>
                        <p class="m-0"> {{ $message }}</p>
                    </div>
                </div>
                @enderror
            </div>
        </div>


        {{--        <div class="@if ($profile == false && $address == false) d-none @else d-block @endif"> --}}
        {{--            @livewire('inner.profile',['show_password'=>false],key(rand(90000,999999))) --}}
        {{--        </div> --}}
        {{--        <div class="@if ($documents == false) d-none @else d-block @endif"> --}}
        {{--            @livewire('inner.document-add',['primary_id' => session('customer_id')],key(rand(90000,999999))) --}}
        {{--        </div> --}}

    </div>


    <!-- Modal -->

</div>

<script>
    $(document).ready(function () {
        $('#select2_dropdown').select2();

        $('#new_bank').on('click', function (e) {
            setTimeout(function () {
                $('#select2_dropdown').select2();
            }, 400);
        });


        $('.select2_dropdown').on('change', function (e) {
            console.log('erer');
            var data = $('.select2_dropdown').select2("val");

            @this.
            set('selected_bank_beneficiary.branch_name', data);
        });

        window.addEventListener('existingBranch', function (event) {

            // console.log('existingBranch event triggered');
            // console.log('Selected value:', event.detail);
            $('#select2_dropdown').select2();

            $('#select2_dropdown').val(event.detail).trigger('change');

        });

    });

    function myFunction() {
        setTimeout(function () {
            $('#select2_dropdown').select2();
        }, 400);
    }


    function branchChange() {
        var data = $('#select2_dropdown').select2("val");

        @this.
        set('selected_bank_beneficiary.branch_name', data);

        myFunction();
    }
</script>
