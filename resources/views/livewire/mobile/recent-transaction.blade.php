<div class="section mt-2 mb-4">
    <div class="section-title">Recent Transfers</div>
    @if($transfers->isNotEmpty())
        <div class="card">
            <ul class="listview flush transparent no-line icon-show image-listview detailed-list mt-1 mb-1">
                @foreach($transfers as $transfer)
                    <li>
                        <a href="{{ url('mobile/transaction') }}/{{ $transfer->id }}" class="item">
                            <div class="icon-box ">
                                <img class="imaged  rounded w32 "
                                     src="{{ url('images/flags') }}/{{ strtolower($transfer->beneficiaryCountry->iso2)  }}.svg"
                                     alt="">
                            </div>
                            <div class="in">
                                <div>
                                    <strong>{{ $transfer->beneficiary->first_name. ' '.$transfer->beneficiary->last_name }}</strong>
                                    <div class="text-small text-secondary">{{$transfer->transfer_code}}</div>
                                </div>
                                <div class="text-end pe-3">
                                    <strong>{{ number_format($transfer->receiving_amount) }} {{ $transfer->receiving_currency }}</strong>
                                    <div class="text-small">
                                        {{ date('d M Y',strtotime($transfer->created_at)) }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <div class="alert alert-warning mb-1" role="alert">
            You haven't send money to anyone yet. Please send and enjoy best rates.
        </div>
    @endif
</div>
