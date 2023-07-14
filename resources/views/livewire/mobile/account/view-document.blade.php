<div class="px-3 mt-3">
    <p class="fs-20px text-full-black fw-bold">Document Details</p>
    <ul class="listview shadow-c rounded">
        <li class="profile-list">
            <a href="#" class="item">

                <div class="in">
                    <div>
                        <p class="fs-16px mb-0">{{ $document['type_name'] }}</p>
                        <p class="fs-16px m-0 text-muted">Document Type</p>
                    </div>

                </div>
            </a>
        </li>
        <li class="profile-list">
            <a href="#" class="item">
                <div class="in">
                    <div>
                        <p class="fs-16px mb-0">{{ $document['number'] }}</p>
                        <p class="fs-16px m-0 text-muted">Document Number</p>
                    </div>
                </div>
            </a>
        </li>
        <li class="profile-list">
            <a href="#" class="item">
                <div class="in">
                    <div>
                        <p class="fs-16px mb-0">
                            @if(!empty($document['issuance']))
                                {{ date('d M, Y',strtotime($document['issuance'])) }}
                            @endif
                        </p>
                        <p class="fs-16px m-0 text-muted">Issuance</p>
                    </div>
                </div>
            </a>
        </li>
        <li class="profile-list">
            <a href="#" class="item">
                <div class="in">
                    <div>
                        <p class="fs-16px mb-0">
                            @if(!empty($document['expiry']))
                                {{ date('d M, Y',strtotime($document['expiry'])) }}
                            @endif
                        </p>
                        <p class="fs-16px m-0 text-muted">Expiry</p>
                    </div>
                </div>
            </a>
        </li>

        @if(!empty($document['front']))
            <li class="profile-list">
                <a href="{{ env('AWS_URL') }}{{ $document['front'] }}" class="item" >
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">
                                View
                            </p>
                            <p class="fs-16px m-0 text-muted">Front Document</p>
                        </div>
                    </div>
                </a>
            </li>
        @endif
        @if(!empty($document['back']))
            <li class="profile-list">
                <a href="{{ env('AWS_URL') }}{{ $document['back'] }}" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">
                            View
                            </p>
                            <p class="fs-16px m-0 text-muted">Back Document</p>
                        </div>
                    </div>
                </a>
            </li>
        @endif


        @if(!empty($document['issuer_authority']))
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0"> {{ $document['issuer_authority'] }}</p>
                            <p class="fs-16px m-0 text-muted">Issuer Authority</p>
                        </div>
                    </div>
                </a>
            </li>
        @endif
        @if(!empty($document['country_name']))
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0"> {{ $document['country_name'] }}</p>
                            <p class="fs-16px m-0 text-muted">Country</p>
                        </div>
                    </div>
                </a>
            </li>
        @endif


    </ul>
</div>