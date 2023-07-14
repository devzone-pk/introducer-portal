<div class="row g-3">

    @livewire('inner.sidebar')

    <div class="col-md-9 col-12">
        <div class="card card-border border-primary shadow-light-lg mb-4 ">

            <div class="card-body p-5">
                <form action="">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label class="form-label mb-1" for="">From</label>
                            <input type="date" wire:model="from" class="form-control form-control-sm">
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="form-label mb-1" for="">To</label>
                            <input type="date" wire:model="to" class="form-control form-control-sm">
                        </div>

                        <div class="col-12 col-sm-4">
                            <label class="form-label mb-1" for="">Status</label>
                            <select name="" wire:model="status" class="form-select form-select-sm" id="">
                                <option value=""></option>

                                <option value="CNL">Canceling</option>
                                <option value="CMH">Compliance Held</option>
                                <option value="CAN">Canceled</option>
                                <option value="INC">Incomplete</option>
                                <option value="PAI">Paid</option>
                                <option value="PAY">Available for Collection</option>
                                <option value="PEN">Awaiting funds</option>
                                <option value="PRC">Processing Transfer</option>
                                <option value="VER">Verifying</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card card-border border-primary shadow-light-lg mb-6">
            <div class="card-header px-5">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Heading -->
                        <h4 class="mb-0">
                            Transaction History
                        </h4>
                    </div>

                </div>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-sm  table-striped overflow-hidden  ">
                    <tr class="bg-light fs-12px ">
                        {{--                    <th class="text-gray fw-normal ps-5">Date</th>--}}
                        <th class="ps-5 text-gray fw-normal">DESCRIPTION</th>
                        <th class="text-gray fw-normal">STATUS</th>
                        <th class="text-gray fw-normal">AMOUNT</th>
                        <th class="text-gray fw-normal"></th>
                        <th class="text-gray fw-normal"></th>
                    </tr>

                    @foreach($transfers as $t)
                        <tr class="fs-16px  ">
                            {{--                        <td class="ps-5 align-middle text-gray">--}}
                            {{--                            --}}
                            {{--                        </td>--}}

                            <td class="ps-5 align-middle  ">
                            <span class="text-secondary">
                            {{ date('d M Y',strtotime($t->created_at)) }}
                                </span><br>
                                <span class="fw-bold">
                            {{ $t->beneficiary->first_name }} {{ $t->beneficiary->last_name }}
                            </span> <br> {{ $t->transfer_code }} <br>
                                {{ $t->payer->name }}
                            </td>
                            <td class="align-middle text-gray">
                            <span
                                    class="badge {{ $t->paymentStatus->additional_info }}">{{ $t->paymentStatus->secondary_name }}</span>
                            </td>
                            <td class="align-middle ">
                                <span class=" ">{{ $t->sending_currency }}</span>
                                {{ number_format($t->sending_amount ,2) }} <br>

                                <span class=" ">{{ $t->receiving_currency }}</span>
                                {{ number_format($t->receiving_amount ,2) }}
                            </td>

                            <td class="align-middle text-gray">

                                @if($t->status == 'INC')
                                    <a href="{{ url('gateway/swipen/payment') }}/{{$t->transfer_code}}"
                                       target="_blank" class="btn fs-12px btn-success mb-2 py-1" style="width: 105px;">Continue</a>
                                    <br>
                                @endif

                                <a href="{{ url('receipt') }}?transfer_id={{$t->id}}"
                                   target="_blank" class="btn fs-12px btn-light  py-1" style="width: 105px;">Receipt</a>

                            </td>

                            <td class="align-middle text-gray">
                                <div class="dropdown show">
                                    <a class="btn" href="#" role="button" id="dropdownMenuLink"
                                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg width="5" height="23" viewBox="0 0 5 23" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="2.5" cy="2.5" r="2.5" fill="#ABBCD5"/>
                                            <circle cx="2.5" cy="11.5" r="2.5" fill="#ABBCD5"/>
                                            <circle cx="2.5" cy="20.5" r="2.5" fill="#ABBCD5"/>
                                        </svg>
                                    </a>

                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="{{ url('transfer/history') }}/{{ $t->id }}">Transaction
                                                Details</a></li>

                                        @if(!in_array($t->status,['REF','CAN','PAI','CMH']))
                                            <li><a class="dropdown-item"
                                                   href="{{ url('customer-support/add-complaint') }}?transfer_id={{$t->id}}&type=95">Beneficiary
                                                    Name Change</a></li>
                                        @else
                                            <li><a class="dropdown-item text-muted"
                                                   href="#">Beneficiary
                                                    Name Change</a></li>
                                        @endif
                                        @if(!in_array($t->status,['REF','CAN','PAI','CMH']))
                                            <li><a class="dropdown-item"
                                                   href="{{ url('customer-support/add-complaint') }}?transfer_id={{$t->id}}&type=171">Request
                                                    for Cancellation</a></li>
                                        @else
                                            <li><a class="dropdown-item text-muted"
                                                   href="#">Request
                                                    for Cancellation</a></li>
                                        @endif
                                    </div>
                                </div>

                            </td>
                        </tr>


                    @endforeach


                </table>
                <div class="d-flex justify-content-center">
                    {{ $transfers->links() }}
                </div>

            </div>
        </div>
    </div>

</div>
