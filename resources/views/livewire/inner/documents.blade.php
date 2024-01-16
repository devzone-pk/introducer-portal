<div class="row g-3">

    @livewire('inner.sidebar')
    <div class="col-md-9 col-12">
    <div class="card card-border border-primary shadow-light-lg mb-6">
        <div class="card-header px-5">
            <div class="row align-items-center">
                <div class="col">
                    <!-- Heading -->
                    <h4 class="mb-0">
                        Documents
                    </h4>
                </div>
                <div class="col-auto">
                    <a class="btn btn-info px-5 py-1" href="{{ url('user/document/add') }}">Add
                        Document</a>
                </div>
            </div>
        </div>
        <div class="card-body px-4 ">
            <div class="row">
                @foreach($documents as $d)
                    <div class="col-12 col-sm-6 mb-1">
                        <div class="card bg-info text-center" >
                            <a class="text-white text-decoration-none" href="{{ url('user/document/view') }}/{{$d->id}}">

                                <div class="card-body  rounded">
                                    <h5 class="card-title mb-0">{{ $d->type_name }}</h5>
                                    <p class="card-text">{{ $d->number }}</p>

                                    @if(strtotime($d->expiry) < time())
                                        <p class="badge bg-danger text-dark text-0 fw-500 rounded-pill px-2 mb-0">
                                            Expired</p>
                                    @else
                                        <p class="badge bg-success text-dark text-0 fw-500 rounded-pill px-2 mb-0">
                                            Active</p>
                                    @endif

                                    @if($d->is_primary == 't')
                                        <p class="badge bg-warning text-dark text-0 fw-500 rounded-pill px-2 mb-0">
                                            Primary</p>
                                    @else
                                        <p class="badge bg-danger text-dark text-0 fw-500 rounded-pill px-2 mb-0">
                                            Secondary</p>
                                    @endif

                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>


    <div id="bank-account-details" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered transaction-details" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    @if(!empty($document))
                        <div class="row g-0">
                            <div class="col-sm-5 d-flex justify-content-center bg-primary rounded-start py-4">
                                <div class="my-auto text-center">

                                    <h3 class="text-6 text-white ">{{ $document['type_name'] }}</h3>
                                    <div class="text-4 text-white ">{{ $document['number'] }}</div>
                                    <p class="badge bg-light text-dark text-0 fw-500 rounded-pill px-2 mb-0">
                                        @if($d->is_primary == 't')
                                            Primary
                                        @else
                                            Secondary
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <h5 class="text-5 fw-400 m-3">Document Details
                                    <button type="button" class="btn-close text-2 float-end" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </h5>
                                <hr>
                                <div class="px-3 mb-3">
                                    <ul class="list-unstyled">
                                        <li class="fw-500">Issuance Date:</li>
                                        <li class="text-muted">
                                            @if(!empty($document['issuance']))
                                                {{ date('d M, Y',strtotime($document['issuance'])) }}
                                            @endif
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li class="fw-500">Expiry Date:</li>
                                        <li class="text-muted">
                                            @if(!empty($document['expiry']))
                                                {{ date('d M, Y',strtotime($document['expiry'])) }}
                                            @endif
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li class="fw-500">Front Document:</li>
                                        <li class="text-muted">
                                            <a href="{{ env('AWS_URL'). $document['front'] }}">View</a>
                                        </li>
                                    </ul>

                                    <ul class="list-unstyled">
                                        <li class="fw-500">Back Document:</li>
                                        <li class="text-muted">
                                            <a href="{{ env('AWS_URL'). $document['back'] }}">View</a>
                                        </li>
                                    </ul>

                                    <ul class="list-unstyled">
                                        <li class="fw-500">Issuer Authority:</li>
                                        <li class="text-muted">
                                            {{ $document['issuer_authority'] }}
                                        </li>
                                    </ul>

                                    <ul class="list-unstyled">
                                        <li class="fw-500">Issuer Country:</li>
                                        <li class="text-muted">
                                            {{ $document['country_name'] }}
                                        </li>
                                    </ul>

                                    <ul class="list-unstyled">
                                        <li class="fw-500">Status:</li>

                                        <li class="text-muted">
                                            @if(strtotime($document['expiry']) < time())
                                                Expired
                                            @else
                                                Active
                                            @endif
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>


</div>
