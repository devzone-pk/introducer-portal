{{--done--}}
<div class="modal fade modalbox" wire:ignore.self id="sm_branches" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-60">
        <div class="modal-content pt-0  bg-capsule">

            <div class="modal-body p-0">
                <div class="bg-dark-blue  justify-content-between d-flex  align-items-center p-2">
                    <h3 class="text-white modal-title">Choose Branch</h3>
                    <a href="#" class="ms-2" data-bs-dismiss="modal">
                        <img src="{{ asset('icons/close-modal.png') }}" style="width: 30px;" alt="">
                    </a>
                </div>


                <div class="p-1">
                    <div class="form-group  searchbox not-empty">
                        <input type="text" wire:model.debounce.500ms="branch_search_query" class="form-control"
                               placeholder="Search...">
                        <i class="input-icon">
                            <img style="width: 25px;" src="{{ asset('icons/search.png') }}" alt="">
                        </i>
                    </div>
                </div>
                @if(!empty($branches))
                @foreach($branches as $dist=>$branch)

                    <div class="listview-title sticky-title">
                        <strong>{{$dist}}</strong>
                    </div>
                    <ul class="listview image-listview inset">
                        @foreach(collect($branch)->sortBy('branch_name') as $rc)
                            <li>
                                <a href="#" class="item" data-bs-dismiss="modal"
                                   wire:click.prevent="branchSelection('{{ $rc['branch_name'] }}')">


                                    <div class="in">
                                        <div>
                                            {{ $rc['branch_name'] }}

                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    @endforeach
                @else
                    <div class="section">
                        <div class="splash-page mt-5 mb-5">
                            <h2 class="mb-1">Oops!</h2>
                            <p>
                                No record found. Please try with different keyword.
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{--done--}}
