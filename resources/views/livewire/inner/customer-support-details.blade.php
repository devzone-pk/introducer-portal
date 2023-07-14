<div class="row g-3">

    @livewire('inner.sidebar')
    <div class="col-md-9 col-12">
        <div class="card card-border border-primary shadow-light-lg mb-6">
            <div class="card-header px-5">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Heading -->
                        <h4 class="mb-0">
                            Complain Details
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-info px-5 py-1" href="{{ url('customer-support') }}">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body px-5">
                <div class="list-group list-group-flush">

                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Heading -->
                                <p class="mb-0">
                                    Complain ID
                                </p>

                                <!-- Text -->
                                <small class="fw-light text-gray-700">
                                    {{ $complain_id }}
                                </small>

                            </div>

                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Heading -->
                                <p class="mb-0">
                                    Complain Type
                                </p>

                                <!-- Text -->
                                <small class="fw-light text-gray-700">
                                    {{ $complain['name'] }}
                                </small>

                            </div>

                        </div>
                    </div>

                    @if(!empty($complain['transfer_code']))
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Heading -->
                                    <p class="mb-0">
                                        transaction No
                                    </p>

                                    <!-- Text -->
                                    <small class="fw-light text-gray-700">
                                        {{ $complain['transfer_code'] }}
                                    </small>

                                </div>

                            </div>
                        </div>
                    @endif
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Heading -->
                                <p class="mb-0">
                                    Description
                                </p>

                                <!-- Text -->
                                <small class="fw-light text-gray-700">
                                    {{ $complain['description'] }}
                                </small>

                            </div>

                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Heading -->
                                <p class="mb-0">
                                    Status
                                </p>

                                <!-- Text -->
                                <small class="fw-light text-gray-700">
                                    @if($complain['status'] == 'open')
                                        <span class="badge bg-danger">Open</span>
                                    @else
                                        <span class="badge bg-success">Closed</span>
                                    @endif
                                </small>

                            </div>

                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Heading -->
                                <p class="mb-0">
                                    Created At
                                </p>

                                <!-- Text -->
                                <small class="fw-light text-gray-700">
                                    {{ date('d M, Y',strtotime($complain['created_at'])) }}
                                </small>

                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="card card-border border-primary shadow-light-lg mb-6">
            <div class="card-header px-5">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Heading -->
                        <h4 class="mb-0">
                            @if($complain['status'] == 'open')
                                Post a Comment
                            @else
                                Comments
                            @endif
                        </h4>
                    </div>

                </div>
            </div>
            <div class="card-body px-5">

                @if($success)
                    <div class="alert alert-success" role="alert">
                        {{ $success }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $e)
                            <p class="m-0">{{ $e }}</p>
                        @endforeach
                    </div>
                @endif

                @if($complain['status'] == 'open')
                    <form wire:submit.prevent="postComment">
                        <div class="mb-2">
                            <label for="" class="form-label fw-600">Comment</label>
                            <textarea name="" wire:model.defer="description" class="form-control" cols="30"
                                      rows="5"></textarea>
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-sm btn-danger">Post</button>
                        </div>
                    </form>
                @endif

                <div class="media mt-5">
                    @foreach($comments as $comment)
                        <div class="media-body">
                            <h5 class="mt-4 mb-0">{{ $comment->type == 'customer' ? 'Me':'Support' }}</h5>
                            <p class="m-0 lh-sm">{{ $comment->description }}</p>
                            <p class="m-0 blockquote-footer"> {{ date('d M, Y H:i:s',strtotime($comment->created_at)) }}</p>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>


    </div>
</div>
