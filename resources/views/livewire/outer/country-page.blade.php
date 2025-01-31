<div class="container">
    <style>


    </style>
    <div class="row">

        <div class="col-12  ">
            <div class="card  ">
                {{--                <div class="card-header border-0 text-uppercase bg-red rad p-2">--}}
                {{--                    <p class="m-0 text-white text-center fw-light letter-spacing-lg">--}}
                {{--                        Today's rate--}}
                {{--                    </p>--}}
                {{--                    <h2 class="m-0  text-white text-center fw-bold letter-spacing">--}}
                {{--                        @if(!empty($high_rate))--}}
                {{--                            1 {{ $high_rate['source_currency'] }}--}}
                {{--                            = {{ number_format($high_rate['rate_after_spread'],2) }} {{ $high_rate['currency'] }}--}}
                {{--                        @endif--}}
                {{--                    </h2>--}}
                {{--                </div>--}}

                <div class="card-body bg-white rounded p-5 border shadow">
                    <form wire:submit.prevent="proceed">

                        <div class="row g-4">
                            <div class="col-12">
                                <div class="form-group country-page" wire:ignore>
                                    <label class="form-label mb-1 " for="">You Send</label>
                                    <div class="input-group   mb-3">
                                        <input
                                                onclick="this.select()" type="text" autocomplete="off"
                                                wire:model.debounce.500ms="amounts.sending_amount"
                                                class="form-control country-calculator  only-numbers leading-zero @error('amounts.sending_amount') is-invalid @enderror"
                                                id="youSend"
                                                style="border: 1px solid #ced4da;"
                                                value="" placeholder="" autocorrect="off"
                                                autocapitalize="off">


                                        <select wire:model="sending_iso2" id="sending"
                                                class="form-select select-dropdown"
                                                data-placeholder="Sending From">
                                            <option></option>
                                            @foreach($sending as $s)
                                                <option data-iso2="{{ $s['iso2'] }}"
                                                        value="{{ $s['iso2']  }}">{{ $s['currency']  }}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>

                                <div class="form-group d-none" wire:ignore>
                                    <label class="form-label mb-1  " for="">Receiving
                                        Method</label>
                                    <select class="form-select   select-dropdown-simple" id="receiving_method"
                                            data-placeholder="Select" wire:model="receiving_method">
                                        <option></option>
                                        @foreach($receiving_methods as $s)
                                            <option
                                                    {{ $receiving_method == $s ? 'selected' : '' }}   value="{{ $s   }}">{{ $s }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group country-page" wire:ignore>
                                    <label class="form-label  mb-1 " for="">Recipient Gets</label>
                                    <div class="input-group mb-3">
                                        <input
                                                onclick="this.select()" type="text" autocomplete="off"
                                                wire:model.debounce.500ms="amounts.receive_amount"
                                                class="form-control  country-calculator only-numbers leading-zero "
                                                id="recipient_gets"
                                                style="border: 1px solid #ced4da;"
                                                value="" placeholder="" autocorrect="off"
                                                autocapitalize="off" maxlength="10">


                                        <select class="form-select  select-dropdown" id="receiving"
                                                data-placeholder="Sending To" wire:model="receiving_iso2">
                                            <option></option>
                                            @foreach($receiving as $s)
                                                <option data-iso2="{{ $s['iso2'] }}"
                                                        value="{{ $s['iso2']  }}">{{ $s['currency']  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div wire:key="select-field-model-version-{{ $iteration }}">
                                    <div class="form-group rate-select d-none" wire:ignore>
                                        <label class="form-label mb-1  " for="">Payout
                                            Using</label>
                                        <select class="form-select   select-dropdown-rate" id="payout"
                                                data-placeholder="Select" wire:model="payer_id">

                                            @foreach($payers as $s)
                                                <option
                                                        data-rate="{{$s['currency']}} {{ $s['rate_after_spread'] }}"
                                                        {{ $payer_id == $s['id'] ? 'selected' : '' }}       value="{{ $s['id']   }}">{{ $s['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @if(!empty($selected_payer))
                                    <div class="row   ">
                                        <div class="col-12 mt-2">

                                            <div class="d-flex my-2 justify-content-between">
                                                <div>
                                                    <h5 class="fw-bold m-0">1 {{ $high_rate['source_currency'] }}</h5>
                                                </div>
                                                <div>
                                                    <h5 class="fw-bold m-0"> {{ number_format($high_rate['rate_after_spread'],2) }} {{ $high_rate['currency'] }}</h5>
                                                </div>
                                            </div>
                                            <div class="d-flex my-2 justify-content-between">
                                                <div>
                                                    <h5 class="fw-bold m-0">Fee</h5>
                                                </div>
                                                <div>
                                                    @if(empty($amounts['fees']))
                                                    <span class="badge bg-success">No Fee</span>
                                                    @else
                                                    <h5 class="fw-bold m-0"> {{ $selected_payer['source_currency'] ?? '' }} {{ number_format($amounts['fees'],2) }}</h5>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="d-flex my-2 justify-content-between">
                                                <div>
                                                    <h3 class="fw-bold m-0">Total To Pay</h3>
                                                </div>
                                                <div>
                                                    <h3 class="fw-bold m-0">{{$selected_payer['source_currency'] ?? ''}} {{ number_format($amounts['total'],2) }} </h3>
                                                </div>
                                            </div>
                                            <div class="d-flex my-2 justify-content-between">
                                                <div>
                                                    <h3 class="fw-bold m-0">Recipient Gets</h3>
                                                </div>
                                                <div>
                                                    <h3 class="fw-bold m-0">{{$selected_payer['currency'] ?? ''}}{{ number_format(str_replace(',', '',$amounts['receive_amount']),2) }}
                                                    </h3>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if(!empty($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>

                        @endif

                        <div class="d-grid">
                            @if(!empty(session('email')))
                                <a href="{{ url('send/money') }}?receiving_country_id={{$receiving_country['id']}}"
                                   class="btn  btn-primary mt-2 ">Continue</a>
                            @else
                                <a href="{{ url('sign-up') }}" class="btn  mt-2 btn-primary ">Continue</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div> <!-- / .row -->
</div> <!-- / .container -->


@push('scripts')

    <script>
        $(document).ready(function () {

            $('#sending').on('change', function (e) {
                var data = $('#sending').select2("val");
                @this.
                set('sending_iso2', data);
            });

            $('#receiving').on('change', function (e) {
                var data = $('#receiving').select2("val");
                @this.
                set('receiving_iso2', data);
            });

            $('#receiving_method').on('change', function (e) {
                var data = $('#receiving_method').select2("val");
                @this.
                set('receiving_method', data);
            });
            $('.select-dropdown-simple').select2({
                theme: "bootstrap-5"
            });

            $('#payout').on('change', function (e) {
                var data = $('#payout').select2("val");
                @this.
                set('payer_id', data);
            });


        });

    </script>

@endpush
