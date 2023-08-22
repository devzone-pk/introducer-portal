<div class="row g-3">
    @livewire('inner.sidebar')
    <div class="col-md-9 col-12">
        <div class="col-12">
            <div class="card shadow-light-lg  ">
                <div class="card-header p-lg-3">
                    <p class="fw-bold fs-14 mb-0">Profile Completeness</p>
                </div>
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between row ">
                        <div class="col-sm-3 col-md-3">
                            <div class="border rounded text-center px-2 py-2">
                        <span class="d-block text-10 text-light  mb-2">
                            <img src="{{asset('assets/img/icons/mobile.png ')}}" height="45px">
                        </span>
                                <span class="text-5 d-block text-success mt-4 mb-4">
                            <i class="fas fa-check-circle text-warning"></i>
                            </span>
                                <p class="mb-0 fw-bold fs-14px">Mobile</p>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="border rounded text-center px-2 py-2">
                                <span class="d-block text-10 text-light mb-3">
                                         <img src="{{asset('assets/img/icons/mail.png')}}" height="45px">
                                </span>
                                <span class="text-5 d-block text-success mt-4 mb-3">
                                    <i class="fas fa-check-circle text-warning"></i>
                                </span>
                                <p class="mb-0 fw-bold fs-14px">Email</p>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="border rounded text-center px-2 py-2">
                                     <span class="d-block text-10 text-light  mb-3">
                             <img src="{{asset('assets/img/icons/address.png ')}}" height="45px">
                        </span>
                                @if($address_completed)
                                    <span class="text-5 d-block text-light mt-4 mb-3">
                                        <i class="fas fa-check-circle text-warning"></i>
                                   </span>

                                    <p class="mb-0 fw-bold fs-14px">Address</p>
                                @else
                                    <span class="text-5 d-block text-light mt-4 mb-3 ">
                                        <i class="fas fa-circle border border-gray-300 rounded-circle"></i>
                                    </span>
                                    <p class="mb-0 fw-bold fs-14px">
                                        <a class="btn-link stretched-link" href="{{url('profile')}}">Address</a>
                                    </p>
                                @endif

                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class=" border rounded text-center px-2 py-2">
                                     <span class="d-block text-10 text-light  mb-2">
                            <img src="{{asset('assets/img/icons/documents.png ')}}" height="45px">
                                </span>
                                @if($documents_completed)
                                    <span class="text-5 d-block text-light mt-4 mb-3">
                                    <i class="fas fa-check-circle text-warning"></i>
                                </span>
                                    <p class="mb-0 fw-bold fs-14px">
                                        Documents
                                    </p>
                                @else
                                    <span class="text-5 d-block text-light mt-4 mb-3">
                                         <i class="fas fa-circle border border-gray-300 rounded-circle"></i>
                                    </span>
                                    <p class="mb-0 fw-bold fs-14px">
                                        <a class="btn-link stretched-link"
                                           href="{{url('user/documents')}}">Documents</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex col-12 flex-md-row flex-column">

            {{--            <div class="col-md-8 mt-4 ">--}}
            {{--                <div class="card  shadow-light-lg  ">--}}
            {{--                    <div class="card-body px-5 text-center" style="margin: 68px 0px 68px 0px">--}}
            {{--                        <p class="fs-20px mb-0 fw-bold">--}}
            {{--                            Welcome to {{ config('app.company_name') }}, Dashboard--}}
            {{--                        </p>--}}
            {{--                        --}}{{--                <p class="fs-16px text-gray">--}}
            {{--                        --}}{{--                    All Transactions will be visible here--}}
            {{--                        --}}{{--                </p>--}}

            {{--                        <a href="{{ url('send/money') }}" class="btn btn-danger w-75  mt-4 mb-2  py-2">--}}
            {{--                            Send Money--}}
            {{--                        </a>--}}

            {{--                        <a href="{{url('recipients/add')}}" class="btn btn-light mb-2 w-75 py-2">--}}
            {{--                            Add Receiver--}}
            {{--                        </a>--}}

            {{--                        <a href="{{ url('user/document/add')  }}" class="btn btn-light mb-2 w-75 py-2">--}}
            {{--                            Add Document--}}
            {{--                        </a>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="col-md-8 mt-4 ">

                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($promotions as $p)

                            <div class="carousel-item {{ $loop->first ? 'active' :'' }}">
                                <img src="{{ env('AWS_URL') }}{{ $p->attachment }}" class="d-block w-100 rounded-2"
                                     alt="...">
                            </div>

                        @endforeach

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-md-4 mt-3 pb-0 pt-1 ps-3 order-8">
                <div class="col-12">
                    <div class="card shadow-light-lg">
                        <div class="card-body p-3">
                            <div class="d-flex flex-column  align-items-center justify-content-center">
                                <span class="d-block text-10 text-light">
                                         <img src="{{asset('assets/img/icons/successful-transaction.png')}}"
                                              height="32px">
                                    </span>

                                <p class="fs-12px  mb-0  text-uppercase text-gray">
                                              <span class="fs-20px fw-bold text-secondary text-center" wire:ignore>
                                               {{ $total_transactions['total'] ?? 0 }}
                                             </span>
                                </p>

                                <p class="fs-12px mb-0 text-uppercase text-gray text-center">Successful
                                    Transactions
                                </p>


                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-12 pt-4">
                    <div class="card shadow-light-lg ">
                        <div class="card-body p-3">
                            <div class="d-flex flex-column  align-items-center">
                                <span class="d-block text-10 text-light">
                                         <img src="{{asset('assets/img/icons/transactions-amount.png')}}" height="32px">
                                    </span>
                                <p class="fs-12px mb-0 text-uppercase text-gray">
                                    <span class="fs-20px fw-bold text-secondary" wire:ignore>
                            {{ session('currency') }} {{ number_format($total_transactions['total_amount'],2)   }}
                                    </span>
                                </p>
                                <p class="fs-12px mb-0 text-uppercase text-gray">Transactions Amount
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 pt-4">
                    <div class="card  shadow-light-lg  ">
                        <div class="card-body p-3">
                            <a href="{{ url('transfer/history') }}?status=INC" class="text-decoration-none">
                                <div class="d-flex flex-column  align-items-center">
                                    <span class="d-block text-10 text-light">
                                         <img src="{{asset('assets/img/icons/incomplete-transactions.png')}}"
                                              height="32px">
                                    </span>
                                    <p class="fs-12px mb-0 text-uppercase text-gray">
                                              <span class="fs-20px fw-bold text-secondary" wire:ignore>
                             {{ $incomplete   }}
                           </span>
                                    </p>
                                    <p class="fs-12px mb-0 text-uppercase text-gray">Incomplete Transactions
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--            <div class="col-md-4 col-12">--}}
    {{--                <div class="card card-border border-primary shadow-light-lg  ">--}}
    {{--                    <div class="card-header p-4">--}}
    {{--                        <p class="text-center fs-20px mb-0">Today's Rate</p>--}}
    {{--                    </div>--}}
    {{--                    <div class="card-body p-3">--}}
    {{--                        <div class="px-0 text-center py-6">--}}
    {{--                            <p class="fs-14px mb-0">1 GBP is</p>--}}
    {{--                            <p class="fs-36px fw-bolder mb-0">{{ number_format($high_rate['rate_after_spread'],2) }}</p>--}}
    {{--                            <div class="d-flex justify-content-center align-items-center">--}}
    {{--                                <img class="rounded border w-48px" src="{{ asset('assets/flags/'. $country['iso2'] .'.svg') }}"--}}
    {{--                                     alt="">--}}
    {{--                                <p class="mb-0 ps-2 fs-16px">{{ $country['currency'] }}</p>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="d-grid mb-2">--}}
    {{--                            <select wire:model="country_id" class="form-select fs-14px chevron-select px-2 py-2 bg-light" id="">--}}

    {{--                                @foreach($rc_data as $r)--}}
    {{--                                    <option value="{{ $r['id'] }}">{{ $r['name'] }}</option>--}}
    {{--                                @endforeach--}}
    {{--                            </select>--}}
    {{--                        </div>--}}

    {{--                        <div class="d-grid mb-2">--}}
    {{--                            <select wire:model="method" class="form-select fs-14px chevron-select px-2 py-2 bg-light" id="">--}}

    {{--                                @foreach($receiving_methods as $r)--}}

    {{--                                    <option value="{{ $r }}">{{ $r }}</option>--}}
    {{--                                @endforeach--}}
    {{--                            </select>--}}
    {{--                        </div>--}}


    {{--                        <div class="d-grid">--}}
    {{--                            <a href="{{ url('send/money') }}?method={{ $method }}&receiving_country_id={{$country_id}}"--}}
    {{--                               class="btn py-2 btn-primary ">Continue</a>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}


</div>