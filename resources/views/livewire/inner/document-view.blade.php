<div class="row g-3">

    @livewire('inner.sidebar')
    <div class="col-md-9 col-12">
        <div class="card card-border border-primary shadow-light-lg mb-6">
        <div class="card-header px-5">
            <div class="row align-items-center">
                <div class="col">
                    <!-- Heading -->
                    <h4 class="mb-0">
                        Document Details
                    </h4>
                </div>

            </div>
        </div>
        <div class="card-body  ">
            <div class="row g-5">
                <div class="col-md-6 col-12">

                    <p class=" fs-14px mb-0 ">{{ $document->type_name }}</p>
                    <p class="text-gray fs-12px mb-0">Document Type</p>
                </div>

                <div class="col-md-6 col-12">
                    <p class=" fs-14px mb-0 ">{{ $document->number }}</p>
                    <p class="text-gray fs-12px mb-0">Document Number</p>
                </div>

                <div class="col-md-6 col-12">
                    <p class=" fs-14px mb-0 ">
                        @if(!empty($document->issuance))
                            {{ date('d M, Y',strtotime($document->issuance)) }}
                        @endif
                    </p>
                    <p class="text-gray fs-12px mb-0">Issuance</p>
                </div>

                <div class="col-md-6 col-12">
                    <p class=" fs-14px mb-0 ">
                        @if(!empty($document->expiry))
                            {{ date('d M, Y',strtotime($document->expiry)) }}
                        @endif
                    </p>
                    <p class="text-gray fs-12px mb-0">Expiry</p>
                </div>


                @if(!empty($document->front))
                    <div class="col-md-6 col-12">
                        <p class=" fs-14px mb-0 ">
                            <a href="{{ env('AWS_URL') }}{{ $document->front }}">View</a>
                        </p>
                        <p class="text-gray fs-12px mb-0">Front Document</p>
                    </div>
                @endif

                @if(!empty($document->back))
                    <div class="col-md-6 col-12">
                        <p class=" fs-14px mb-0 ">
                            <a href="{{ env('AWS_URL') }}{{ $document->back }}">View</a>
                        </p>
                        <p class="text-gray fs-12px mb-0">Back Document</p>
                    </div>
                @endif

                @if(!empty($document->issuer_authority))
                <div class="col-md-6 col-12">
                    <p class=" fs-14px mb-0 ">{{ $document->issuer_authority  }}</p>
                    <p class="text-gray fs-12px mb-0">Issuer Authority</p>
                </div>
                @endif

                @if(!empty($document->country_name))
                <div class="col-md-6 col-12">
                    <p class=" fs-14px mb-0 ">{{ $document->country_name  }}</p>
                    <p class="text-gray fs-12px mb-0">Country</p>
                </div>
                @endif


                <div class="col-md-6 col-12">

                    @if(strtotime($document->expiry) < time())
                        <p class="badge bg-danger text-dark text-0 fw-500 rounded-pill px-2 mb-0">
                            Expired</p>
                    @else
                        <p class="badge bg-success text-dark text-0 fw-500 rounded-pill px-2 mb-0">
                            Active</p>
                    @endif

                    <p class="text-gray fs-12px mb-0">Status</p>
                </div>


            </div>
        </div>
    </div>
</div>
</div>
