
<div class="modal fade modalbox" wire:ignore.self id="payers_list" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-60">
        <div class="modal-content  pt-0 bg-capsule">

            <div class="modal-body p-0">
                <div class="bg-dark-blue  justify-content-between d-flex  align-items-center p-2">
                    <h3 class="text-white modal-title">{{ $payer_title }}</h3>
                    <a href="#" class="ms-2" data-bs-dismiss="modal">
                        <img src="{{ asset('icons/close-modal.png') }}" style="width: 30px;" alt="">
                    </a>
                </div>
                <div class="p-1">
                    <div class="form-group  searchbox not-empty">
                        <input type="text" wire:model.debounce.500ms="payer_search_query" class="form-control"
                               placeholder="Search...">
                        <i class="input-icon">
                            <img style="width: 25px;" src="{{ asset('icons/search.png') }}" alt="">
                        </i>
                    </div>
                </div>
                @if(!empty($payers))
                    <ul class="listview image-listview inset">
                        @foreach(collect($payers)->sortBy('name')->toArray() as $rc)
                            <li>
                                <a href="#" class="item"  data-bs-dismiss="modal" wire:click.prevent="payerSelection('{{ json_encode($rc) }}')">

                                    <div class="">
                                        <div>
                                            {{ $rc['name'] }}
                                        </div>
                                        <div class="cool" style="white-space: nowrap;">
                                            @if(!empty($rc['customer_rate_id']) && $rc['customer_rate_type'] == 'increment')
                                            <div class="d-flex">
                                                <span class="fs-13-400 opacity-50">{{ $rc['currency']}} &nbsp;</span>
                                                <span class="fs-12"
                                                      style="color: red;text-decoration: line-through;">{{ number_format($rc['rate_after_spread'] - $rc['customer_rate_value'],2) }} &nbsp;</span>
                                                <span class="fs-18-400"
                                                      style="color: green">{{number_format($rc['rate_after_spread'],2) }} </span>

                                            </div>
                                            @else
                                                <span class="fs-13-400 opacity-50">{{ $rc['currency'] }}</span>      <span
                                                        class="fs-18-400">{{ number_format($rc['rate_after_spread'],2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="section">
                        <div class="splash-page mt-5 mb-5">
                            <h2 class="mb-1">Oops!</h2>
                            <p>
                                No record found. Please try with different keyword.
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{--done--}}
