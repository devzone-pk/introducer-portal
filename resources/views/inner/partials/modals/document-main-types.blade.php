{{--done--}}
<div class="modal fade modalbox" wire:ignore.self id="document-types-main-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-60">
        <div class="modal-content pt-0 bg-capsule">

            <div class="modal-body p-0 ">

                <div class="bg-dark-blue  d-flex  justify-content-between align-items-center p-2">
                    <h3 class="text-white modal-title">{{ $dmt_title }}</h3>
                    <a href="#" class="ms-2" data-bs-dismiss="modal">
                        <img src="{{ asset('icons/close-modal.png') }}" style="width: 30px;" alt="">
                    </a>
                </div>
                <div class="p-1">
                    <div class="form-group  searchbox not-empty">
                        <input type="text" wire:model.debounce.500ms="dmt_search_query" class="form-control"
                               placeholder="Search...">
                        <i class="input-icon">
                            <img style="width: 25px;" src="{{ asset('icons/search.png') }}" alt="">
                        </i>
                    </div>
                </div>
                @if(!empty($dmt_data))
                    <ul class="listview image-listview remove-arrow inset">
                        @foreach($dmt_data as $rc)
                            <li>
                                <a href="#" class="item"  data-bs-dismiss="modal" wire:click.prevent="dmtSelection('{{ json_encode($rc) }}')">

                                    <div class="in">
                                        <div>{{ $rc['name'] }}

                                        </div>

                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
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
