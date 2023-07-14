<div id="appCapsule" class="  ">

    @php
        $country = \App\Models\Country\Country::find($beneficiary->country_id);
    @endphp
    <div class="px-3 mt-3">
        <p class="fs-20px text-full-black fw-bold">Receiver Details</p>
        <ul class="listview shadow-c rounded">
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ $beneficiary->first_name }} {{ $beneficiary->last_name }}</p>
                            <p class="fs-16px m-0 text-muted">Name</p>

                        </div>
                    </div>
                </a>
            </li>
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">


                                {{ optional($country)->name }}</p>
                            <p class="fs-16px m-0 text-muted">Country</p>

                        </div>
                    </div>
                </a>
            </li>
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ $beneficiary->code }}{{ $beneficiary->phone }}</p>
                            <p class="fs-16px m-0 text-muted">Phone</p>

                        </div>
                    </div>
                </a>
            </li>
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ optional(\App\Models\Options\Option::find($beneficiary->relationship_id))->name }}</p>
                            <p class="fs-16px m-0 text-muted">Relation</p>

                        </div>
                    </div>
                </a>
            </li>


        </ul>


        <p class="fs-20px text-full-black mt-3 fw-bold">Bank Details</p>
        <ul class="listview shadow-c rounded">
            @foreach($beneficiary->beneficiaryBank as $bank)

                <li class="profile-list">
                    <a href="#" class="item">
                        <div class="in">
                            <div>
                                <p class="fs-16px mb-0"> {{ $bank->name }}</p>
                                <p class="fs-16px m-0 text-muted">
                                    @if(!empty($bank->iban))
                                        {{ $bank->iban }} <br>
                                    @endif

                                    @if(!empty($bank->ifsc))
                                        {{ $bank->ifsc }}<br>
                                    @endif
                                    @if(!empty($bank->account_no))
                                        {{ $bank->account_no }}<br>
                                    @endif
                                </p>
                            </div>


                        </div>
                    </a>
                </li>

            @endforeach


        </ul>


    </div>

</div>
