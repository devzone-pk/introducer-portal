<div id="appCapsule" class="px-3 mt-3">

    <p class="fs-20px text-full-black fw-bold">All Receivers</p>

    <div class="accordion overflow-hidden border-0 shadow-c rounded " id="accordionExample1">
        @foreach($beneficiary as $key => $b)
            <div class="accordion-item">
                <h2 class="accordion-header ">
                    <div class="accordion-button collapsed" role="button" data-bs-toggle="collapse"
                         data-bs-target="#accordion{{ $key }}" aria-expanded="false">

                        <div>
                            <p class="m-0 line-height-20px"> {{ $b->first_name. ' '.$b->last_name }}</p>


                            <p class="fs-12px line-height-20px m-0 text-muted"> {{ $b->country }}</p>

                        </div>


                    </div>

                </h2>
                <div id="accordion{{ $key }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample1"
                     style="">
                    <div class="accordion-body">
                        <p class="fs-14px m-0 line-height-20px text-full-black">
                            {{ $b->first_name. ' '.$b->last_name }}
                        </p>
                        <p class="fs-14px line-height-20px text-muted">
                            Receiver Name
                        </p>

                        <p class="fs-14px m-0 line-height-20px text-full-black">
                            {{$b->country}}
                        </p>
                        <p class="fs-14px line-height-20px text-muted">
                            Country
                        </p>


                        <p class="fs-14px m-0 line-height-20px text-full-black">
                            {{$b->code}} {{ $b->phone }}
                        </p>
                        <p class="fs-14px line-height-20px text-muted">
                            Phone
                        </p>


                        <p class="fs-14px m-0 line-height-20px text-full-black">
                            {{ $b->relation }}
                        </p>
                        <p class="fs-14px line-height-20px text-muted">
                            Relation
                        </p>



                        <a class="btn btn-primary btn-block"
                           href="{{ url('mobile/receiver') }}/{{ $b->id }}">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>




    <div class="mb-4 mt-2">
        <a href="{{ url('mobile/receivers/add') }}" class="btn btn-primary py-4 btn-block btn-lg">Add a Receiver</a>
    </div>



</div>
