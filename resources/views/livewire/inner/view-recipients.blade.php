<div class="row g-3">

    @livewire('inner.sidebar')
    <div class="col-md-9 col-12">
        <div class="card card-border border-primary shadow-light-lg mb-6">
            <div class="card-header px-5">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Heading -->
                        <h4 class="mb-0">
                            Receiver Details
                        </h4>
                    </div>

                </div>
            </div>
            <div class="card-body  ">
                <div class="row g-5">
                    <div class="col-md-6 col-12">

                        <p class="text-gray fs-12px mb-0">First Name</p>
                        <p class=" fs-14px mb-0 ">{{ $beneficiary_detail->first_name }}</p>
                    </div>

                    <div class="col-md-6 col-12">
                        <p class="text-gray fs-12px mb-0">Last Name</p>
                        <p class=" fs-14px mb-0 ">{{ $beneficiary_detail->last_name }}</p>
                    </div>

                    <div class="col-md-6 col-12">
                        <p class="text-gray fs-12px mb-0">Phone</p>
                        <p class=" fs-14px mb-0 ">
                            {{ $beneficiary_detail->phone}}
                        </p>
                    </div>

                    <div class="col-md-6 col-12">

                        <p class="text-gray fs-12px mb-0">Country</p>

                        <p class=" fs-14px mb-0 ">
                            {{ $beneficiary_detail->country}}
                        </p>
                    </div>

                    <div class="col-md-6 col-12">

                        <p class="text-gray fs-12px mb-0">Relation</p>

                        <p class=" fs-14px mb-0 ">
                            {{ $beneficiary_detail->relation}}
                        </p>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
