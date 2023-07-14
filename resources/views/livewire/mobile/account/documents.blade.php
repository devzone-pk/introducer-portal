<div id="appCapsule">
    <div class="px-3 mt-3">
        <p class="fs-20px text-full-black fw-bold">Your Documents</p>

        @foreach($documents as $d)
            <a href="{{ url('mobile/document/view') }}/{{$d->id}}" class="">
                <div class="p-2 mb-2     rounded shadow-c bg-white d-flex align-items-center justify-content-between">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center">

                            <div>
                                <p class="  fs-12px line-height-20px text-gray mb-0">{{ $d->type_name }}</p>
                                <h3 class="  mb-0">{{ $d->number }}</h3>

                                <div class=" ">
                                    @if(!empty($d->expiry))
                                        @if( strtotime($d->expiry) > time())
                                            <span class="badge rounded-2 badge-success">Active</span>
                                        @else
                                            <span class="badge rounded-2 badge-danger">Expired</span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.5 7L14.5 12L12 14.5L9.5 17" stroke="#85a555" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M9.5 7L14.5 12L12 14.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>

                    </div>
                </div>
            </a>


        @endforeach

        <div class="mb-5">
            <a href="{{ url('mobile/document/add') }}" class="btn btn-primary py-4 btn-block btn-lg">Upload New
                Document</a>
        </div>

    </div>


</div>
