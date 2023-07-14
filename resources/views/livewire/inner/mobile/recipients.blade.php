<div>


    <!-- All Transactions
    ============================================= -->
    <div class="bg-white mb-3 p-1">
        <h3 class="text-5  d-flex align-items-center px-1">All Recipients</h3>


        <!-- Transaction List
        =============================== -->
        <div class="transaction-list">
            @foreach($beneficiary as $b)
                <div class="transaction-item px-1 py-3">

                    <div class="row align-items-center flex-row">
                        <div class="col col-sm-7">
                            <p class="m-0 text-4 d-flex  align-items-center">
                                <i class="currency-flag border-flag currency-flag-{{ strtolower($b->currency) }} me-2"></i>
                                {{ $b->first_name }} {{ $b->last_name }} </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <!-- Pagination
        ============================================= -->
    {{ $beneficiary->links('vendor.livewire.custom-pagination') }}
    <!-- Paginations end -->

    </div>
    <!-- All Transactions End -->
</div>
