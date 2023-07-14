<div class="" id="appCapsule">

    <div class=" px-3 mt-3 ">


        <p class="fs-20px text-full-black fw-bold">Add New Receiver</p>

        <div class="rounded bg-white shadow-c form-padding">
            <form wire:submit.prevent="addNew">

                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <input

                                type="text"
                                class="form-control only-name @error('first_name') is-invalid @enderror"
                                wire:model.defer="first_name" placeholder="First Name">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>


                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <input type="text"

                               class="form-control only-name @error('last_name') is-invalid @enderror"
                               wire:model.defer="last_name" placeholder="Last Name">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>


                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <div
                                role="button"
                                class="form-control pe-2 justify-content-between d-flex align-items-center @error('country.id') is-invalid @enderror"
                                wire:click.prevent="nOpenModal('country','1')"
                        >
                            <div>
                                @if(!empty($country['iso2']))
                                    <img class="imaged rounded w24 me-1"
                                         src="{{ url('images/flags') }}/{{ strtolower($country['iso2']) }}.svg"
                                         alt="">
                                    <span>
                                        {{ $country['name'] }}
                                    </span>
                                @else
                                    <span class="text-placeholder">Receiver Country</span>
                                @endif
                            </div>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17 9.5L14.5 12L12 14.5L7 9.5" stroke="#85a555" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7 9.5L12 14.5L14.5 12" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        </div>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <div class="row ">
                            <div class="col-4">
                                <input type="text" style="background: rgb(204 204 204 / 31%);" readonly
                                       class="form-control  pe-2 @error('code') is-invalid @enderror"
                                       wire:model.defer="code" placeholder="Code">
                            </div>
                            <div class="col-8">
                                <input type="number"
                                       wire:model.defer="phone"
                                       class="form-control allow-number pe-2 @error('phone') is-invalid @enderror"
                                       placeholder="Phone Number">

                            </div>


                        </div>

                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <div
                                class="d-flex pe-2 justify-content-between form-control align-items-center @error('relation.relationship_id') is-invalid @enderror"
                                role="button"
                                wire:click.prevent="rlOpenModel('relation','0')">

                                    <span
                                            class="{{ empty($relation['relationship_id']) ? 'text-placeholder' : '' }} ">
                                        {{ empty($relation['relationship_id']) ? 'Choose Relation' : $relation['relationship_name']  }}</span>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17 9.5L14.5 12L12 14.5L7 9.5" stroke="#85a555" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7 9.5L12 14.5L14.5 12" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        </div>
                    </div>
                </div>


                <div class="mt-2 transparent">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                     <span wire:loading wire:target="addNew">
                        <span class="spinner-grow spinner-grow-sm me-05" role="status" aria-hidden="true"></span>
                    </span>
                        Add
                    </button>
                </div>

            </form>
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


    @include('inner.partials.modals.nationality')
    @include('inner.partials.modals.relationship')
    @include('mobile.messages.error-messages')
</div>
