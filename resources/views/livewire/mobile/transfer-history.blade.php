<div id="appCapsule" class="">
    <div class="px-3 mt-2 ">

        @if($transfers->isNotEmpty())
            @foreach($transfers as $transfer)
                <a href="{{ url('mobile/transaction') }}/{{ $transfer->id }}" class="">
                    <div class="p-2 mb-2     rounded shadow-c bg-white d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <div class="rounded-date bg-white text-center overflow-hidden">
                                    <p class=" mb-0  fs-14px line-height-20px px-4">{{ date('M',strtotime($transfer->created_at)) }}</p>
                                    <p class="transfer-month  line-height-20px fw-bold  ">{{ date('d',strtotime($transfer->created_at)) }}</p>
                                    <p class="m-0 line-height-20px  bg-dark-blue text-white  fs-14px">{{ date('Y',strtotime($transfer->created_at)) }}</p>
                                </div>
                                <div>
                                    <p class="ms-2 fs-12px line-height-20px text-gray mb-0">{{ $transfer->beneficiary->first_name. ' '.$transfer->beneficiary->last_name }}</p>
                                    <h3 class="ms-2 mb-0">{{ $transfer->receiving_currency }} {{ number_format($transfer->receiving_amount,2) }}</h3>
{{--                                    <p class="ms-2 fs-12px line-height-20px text-gray mb-0">  {{ $transfer->receivingMethod->name }}</p>--}}
                                    <div class="ms-2">
                                        @if($transfer->status != 'INC')
                                            <span class="badge {{optional($transfer->paymentStatus)-> additional_info }} ">
                                             {{ optional($transfer->paymentStatus)->secondary_name }}
                                            </span>
                                        @else
                                            <button type="button" class="btn btn-sm btn-danger"
                                                    wire:click.prevent="continue('{{ url('gateway/swipen/payment').'/'.$transfer->transfer_code }}?mobile=yes')">
                                                Continue
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.5 7L14.5 12L12 14.5L9.5 17" stroke="#85a555" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.5 7L14.5 12L12 14.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        </div>
                    </div>
                </a>
            @endforeach












        @else
            <div class="alert alert-warning mb-1" role="alert">
                You haven't sent money to anyone yet. Please send and enjoy best rates.
            </div>
        @endif


    </div>
</div>
