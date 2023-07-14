<div class="section   padding-bottom-100">
    {{--    <h3 class="subtitle text-center   ">Today's Rates</h3>--}}

    <div class="row bg-white pt-1 rounded shadow-c">
        <div class="col-6">
            <div class="sending-from-dashboard mb-2">
                <div class="d-flex   align-items-center">
                    <div>
                        <img class="imaged w-28px" src="{{ asset('images/flags') }}/{{strtolower(session('iso2'))}}.svg"
                             alt="">

                    </div>
                    <div class="text-dark-blue ms-1">
                        <span class="fs-14px fw-bold">  1 {{ session('currency') }}</span>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="sending-from-dashboard mb-2">
                <div class="d-flex   align-items-center" wire:click.prevent="rcOpenModel('country','0')" role="button">
                    <div>
                        <img class="imaged w-28px"
                             src="{{ asset('images/flags') }}/{{strtolower($country['iso2'])}}.svg"
                             alt="">


                    </div>
                    <div class="ms-1">
                        <span class="fs-14px   fw-bold">
                            <span class="text-dark-blue">
                            {{ number_format($high_rate['rate_after_spread'],2) }}
                            </span>

                            <span class=" ">
                                {{ $high_rate['currency'] }}
                            </span>
                            </span>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12">
            <ul class="listview image-listview">
                <li style="padding: 0px 10px 0px 16px;" class="profile-list">
                    <a href="{{ url('mobile/transactions') }}?incomplete=true" class="item">

                        <div class="in">
                            <div>Incomplete Transactions
                                <br>
                                <span class="fw-bold">
                        {{ $incomplete   }}
                    </span>
                            </div>

                        </div>
                    </a>
                </li>
                <li style="padding: 0px 16px;" class="profile-list">
                    <a href="#" class="item">

                        <div class="in">
                            <div class="">
                                Successful Transactions

                                <br>
                                <span class="fw-bold">{{ $total_transactions['total'] ?? 0 }} </span>
                            </div>
                        </div>
                    </a>
                </li>

                <li style="padding: 0px 16px;" class="profile-list">
                    <a href="#" class="item">

                        <div class="in">
                            <div>Transactions Amount
                                <br>
                                <span class="fw-bold">
                            {{ session('currency') }} {{ number_format($total_transactions['total_amount'],2)   }}
                        </span>
                            </div>

                        </div>
                    </a>
                </li>

            </ul>
        </div>

    </div>


    @include('inner.partials.modals.receiving-countries')
</div>
