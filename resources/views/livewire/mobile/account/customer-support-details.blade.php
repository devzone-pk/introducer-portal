<div>
    <div class="px-3 mb-5 mt-3">
        <p class="fs-20px text-full-black fw-bold">Ticket Details

            @if( $complain['status'] == 'open')
                <span class="badge rounded-2 right-14px position-absolute badge-danger">Open</span>
            @else
                <span class="badge rounded-2  right-14px position-absolute badge-success">Closed</span>
            @endif
        </p>


        <ul class="listview shadow-c rounded">
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ $complain_id }}</p>
                            <p class="fs-16px m-0 text-muted">Ticket ID</p>

                        </div>
                    </div>
                </a>
            </li>
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0 ">{{ $complain['name'] }}</p>
                            <p class="fs-16px m-0 text-muted">Type</p>

                        </div>
                    </div>
                </a>
            </li>
            @if(!empty($complain['transfer_code']))
                <li class="profile-list">
                    <a href="#" class="item">
                        <div class="in">
                            <div>
                                <p class="fs-16px mb-0 ">{{ $complain['transfer_code'] }}</p>
                                <p class="fs-16px m-0 text-muted">Transaction ID</p>

                            </div>
                        </div>
                    </a>
                </li>
            @endif
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0 ">{{ $complain['description'] }}</p>
                            <p class="fs-16px m-0 text-muted">Description</p>

                        </div>
                    </div>
                </a>
            </li>

            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>

                            <p class="fs-16px mb-0 ">{{ date('d M, Y',strtotime($complain['created_at'])) }}</p>
                            <p class="fs-16px m-0 text-muted">Created At</p>
                        </div>
                    </div>
                </a>
            </li>


        </ul>


        <p class="fs-20px mt-3 text-full-black fw-bold">Comments</p>

        <ul class="listview shadow-c rounded">
            @foreach($comments as $comment)
                <li class="profile-list">
                    <a href="#" class="item">
                        <div class="in">
                            <div>
                                <p class="fs-16px mb-0 ">{{ $comment->description }}</p>
                                <p class="fs-12px mb-0 ">{{ date('d M, Y h:i A',strtotime($comment->created_at)) }}</p>
                                <p class="fs-12px m-0  {{ $comment->type == 'customer' ? 'text-muted': 'text-primary' }}">@if($comment->type == 'customer')
                                        ME @else Support @endif</p>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="rounded bg-white shadow-c form-padding">
        @if($complain['status'] == 'open')

            <form wire:submit.prevent="postComment">

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <textarea placeholder="Write your comment here..." wire:model.defer="description" class="form-control" cols="30" rows="4"></textarea>


                    </div>
                </div>
                <button type="submit" class="btn  btn-primary btn-lg btn-block">
                    Add a Comment
                </button>
            </form>

        @endif
        </div>

    </div>


    <div class="toast-box toast-top bg-success  {{ !empty($success) ? 'show' :'' }}">
        <div class="in">
            <div class="text">
                {{ $success }}
            </div>
        </div>
        <button type="button"
                class="btn btn-sm btn-text-light close-button">OK
        </button>
    </div>


    @include('mobile.messages.error-messages')

</div>
