<div>
    <div class="px-3 mt-4">
        @if($incomplete_profile)
            <div class="alert alert-warning mb-2">
                Identity documents not found. Please add identity document to make transaction.
            </div>
        @endif

        <p class="fs-20px text-full-black fw-bold">New Documents</p>
        <div class="rounded bg-white shadow-c form-padding">
            <form wire:submit.prevent="add">

                <div class="form-group boxed d-none">
                    <div class="input-wrapper">


                        <div
                                role="button"
                                class="form-control pe-2 justify-content-between d-flex align-items-center @error('type_name') is-invalid @enderror"
                                wire:click.prevent="dmtOpenModel('type_name','0')"
                        >
                            @if(!empty($type_name))
                                <span>
                                        {{ $type_name }}
                                    </span>
                            @else
                                <span class="text-placeholder">Document Type</span>
                            @endif
                            <ion-icon wire:ignore name="chevron-down-outline"></ion-icon>
                        </div>


                    </div>
                </div>
                <div >

                    <div class="form-group boxed">
                        <div class="input-wrapper">


                            <div
                                    role="button"
                                    class="form-control pe-2 justify-content-between d-flex align-items-center @error('type.id') is-invalid @enderror"

                                    wire:click.prevent="dtOpenModel('type','0')"

                            >
                                @if(!empty($type['name']))
                                    <span>
                                        {{ $type['name'] }}
                                    </span>
                                @else
                                    <span class="text-placeholder">Document Name</span>
                                @endif
                                <ion-icon wire:ignore name="chevron-down-outline"></ion-icon>
                            </div>


                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">

                            <input type="text" class="form-control @error('document_no') is-invalid @enderror"
                                   wire:model.defer="document_no" placeholder="Document Number">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">

                            <input type="text"
                                   class="form-control issuance_date @error('issuance') is-invalid @enderror"
                                   wire:model.lazy="issuance" placeholder="DD-MM-YYYY"
                                   style="padding: 8px 16px;
text-align: left;"
                                   id="issuance_date"
                            >
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>


                        </div>
                    </div>
                    <div class="form-group mb-1 boxed">
                        <div class="input-wrapper">

                            <input type="text" class="form-control expiry_date @error('expiry') is-invalid @enderror"
                                   wire:model.lazy="expiry" placeholder="DD-MM-YYYY"
                                   style="padding: 8px 16px;
text-align: left;"
                                   id="expiry_date"
                            >
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>


                        </div>
                    </div>



                    <div class="form-group boxed mt-1">
                        <div class="input-wrapper">

                            <div
                                    role="button"
                                    class="form-control pe-2 justify-content-between d-flex align-items-center @error('issuer_country.id') is-invalid @enderror"
                                    wire:click.prevent="nOpenModal('issuer_country','1')"
                            >
                                <div>
                                    @if(!empty($issuer_country['name']))
                                        <img class="imaged rounded w24 me-1"
                                             src="{{ url('images/flags') }}/{{ strtolower($issuer_country['iso2']) }}.svg"
                                             alt="">
                                        <span>
                                        {{ $issuer_country['name'] }}
                                    </span>
                                    @else
                                        <span class="text-placeholder">Issuer Country</span>
                                    @endif
                                </div>
                                <ion-icon wire:ignore name="chevron-down-outline"></ion-icon>
                            </div>

                        </div>
                    </div>
                    <div class="row mt-1"  >
                        <div class="col-12">
                            <div wire:ignore>
                                <input type="file"
                                       class="filepond"
                                       name="front"
                                       data-max-file-size="25MB"
                                />
                            </div>
                        </div>

                        <div class="col-12  ">
                            <div wire:ignore>
                                <input type="file"
                                       class="filepond"
                                       name="back"
                                       data-max-file-size="25MB"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-warning mt-2">
                        Please note that high resolution images may take longer to upload due to their larger file size.
                        Thank you for your patience.
                    </div>
                    <div class="mb-4 mt-2 transparent">
                        <button type="submit" class="btn btn-primary btn-block btn-lg" wire:target="front,back"
                                wire:loading.remove>

                    <span wire:loading wire:target="add">
                        <span class="spinner-grow spinner-grow-sm me-05" role="status" aria-hidden="true"></span>
                    </span>


                            {{ $modal == false ? 'Add Document':'Next' }}
                        </button>
                    </div>

                </div>

            </form>
        </div>
    </div>

    @if($modal == false)
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
    @endif
    @include('mobile.messages.error-messages')
    @include('inner.partials.modals.document-types')
    @include('inner.partials.modals.document-main-types')
    @include('inner.partials.modals.nationality')


</div>
@push('scripts')
    <script src="{{ asset('mobile/assets/js/resize/resizeImg.js') }}"></script>
    <script src="{{ asset('mobile/assets/js/resize/mobileBUGFix.js') }}"></script>
    <script>
        $(document).ready(function () {

            $("#fileuploadInput").resizeImg({
                mode: 0,
                quality: 0.8,
                type: "image/jpeg",
                use_reader: false,
                val: 800,

                callback: function (result) {
                    window.livewire.emit('frontAdded', result);
                }
            });

            $("#fileuploadInput1").resizeImg({
                mode: 0,
                quality: 0.8,
                type: "image/jpeg",
                use_reader: false,
                val: 800,
                callback: function (result) {
                    window.livewire.emit('backAdded', result);
                }
            });


        })
    </script>
@endpush