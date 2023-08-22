<div class=" px-3 mt-4">

    <p class="fs-20px text-full-black fw-bold">Support</p>
    <div class="accordion overflow-hidden border-0 shadow-c rounded " id="accordionExample1">
        @foreach($complaints as $key => $d)
            <div class="accordion-item">
                <h2 class="accordion-header accordion-header-c">
                    <div class="accordion-button collapsed" role="button" data-bs-toggle="collapse"
                         data-bs-target="#accordion{{ $key }}" aria-expanded="false">

                        <div>
                            <p class="m-0 line-height-20px"> {{$d->option->name}}</p>

                            @if(!empty(optional($d->transfer)->transfer_code))
                                <p class="fs-12px line-height-20px m-0 text-muted"> {{ optional($d->transfer)->transfer_code }}</p>
                            @endif
                        </div>

                        @if( $d->status == 'open')
                            <span class="badge rounded-2 support-status badge-danger">Open</span>
                        @else
                            <span class="badge rounded-2 support-status badge-success">Closed</span>
                        @endif
                    </div>

                </h2>
                <div id="accordion{{ $key }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample1"
                     style="">
                    <div class="accordion-body">
                        <p class="fs-14px m-0 line-height-20px text-full-black">
                            {{ $d->id }}
                        </p>
                        <p class="fs-14px line-height-20px text-muted">
                            Ticket ID
                        </p>

                        <p class="fs-14px m-0 line-height-20px text-full-black">
                            {{$d->option->name}}
                        </p>
                        <p class="fs-14px line-height-20px text-muted">
                            Type
                        </p>
                        @if(!empty(optional($d->transfer)->transfer_code))
                            <p class="fs-14px m-0 line-height-20px text-full-black">
                                {{optional($d->transfer)->transfer_code}}
                            </p>
                            <p class="fs-14px line-height-20px text-muted">
                                Transaction ID
                            </p>
                        @endif

                        @if( $d->status == 'open')
                            <span class="badge rounded-2   badge-danger">Open</span>
                        @else
                            <span class="badge rounded-2   badge-success">Closed</span>
                        @endif
                        <p class="fs-14px line-height-20px text-muted">
                            Status
                        </p>

                        <a class="btn btn-primary btn-block" href="{{ url('mobile/customer-support/details') }}/{{$d->id}}">View Ticket</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>




    <div class="form-button-group padding-bottom-100">
        <a href="{{ url('mobile/customer-support/add') }}" class="btn btn-primary py-4 btn-block btn-lg">Add a Ticket</a>
    </div>
</div>
