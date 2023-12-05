<div class="">

    <div class="px-3 mt-4">
        @if($incomplete_profile)
            <div class="alert alert-warning  mb-2">
                Your profile is incomplete please update your profile to make transaction.
            </div>
        @endif

        <p class="fs-20px text-full-black fw-bold">Update Personal Details</p>
        <div class="rounded bg-white shadow-c form-padding">
            <form wire:submit.prevent="profileUpdate">

                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <input

                                type="text"
                                class="form-control only-name @error('first_name') is-invalid @enderror"
                                {{ $customer['is_verified'] == 't' ? 'disabled':'' }}
                                wire:model.defer="first_name" placeholder="First Name">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>


                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <input type="text"
                               {{ $customer['is_verified'] == 't' ? 'disabled':'' }}
                               class="form-control only-name @error('last_name') is-invalid @enderror"
                               wire:model.defer="last_name" placeholder="Last Name">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>


                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <input type="text" class="form-control" style="background: rgb(204 204 204 / 31%);"
                               placeholder="Email" value="{{$email}}" disabled>
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>


                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <input type="text" class="form-control"
                               style="padding: 8px 16px;
text-align: left;"
                               id="profile_dob"
                               placeholder="DD-MM-YYYY" wire:model.lazy="dob"
                               @if(!empty($dob))
                               value="{{ date('d m Y',strtotime($dob)) }}"
                               @else
                               value="{{ date('d m Y',strtotime('-17 Years')) }}"
                                @endif
                                {{ $customer['is_verified'] == 't' ? 'disabled':'' }}>

                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <div class="row ">
                            <div class="col-4">
                                <input type="text" readonly style="background: rgb(204 204 204 / 31%);"
                                       class="form-control  pe-2"
                                       wire:model.defer="code" placeholder="Code">
                            </div>
                            <div class="col-8">
                                <input type="tel"
                                       wire:model.defer="phone"
                                       class="form-control only-just-numbers pe-2 @error('phone') is-invalid @enderror"
                                       placeholder="Phone Number">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>


                        </div>

                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <div
                                role="button"
                                class="form-control pe-2 justify-content-between d-flex align-items-center @error('gender') is-invalid @enderror"
                                @if($customer['is_verified'] == 'f')
                                wire:click.prevent="grOpenModel('gender','0')"
                                @endif
                        >
                            @if(!empty($gender))
                                <span>
                                        {{ $gender == 'm' ?'Male':'Female'  }}
                                    </span>
                            @else
                                <span class="text-placeholder">Gender</span>
                            @endif
                            <ion-icon wire:ignore name="chevron-down-outline"></ion-icon>
                        </div>

                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <div
                                role="button"
                                class="form-control pe-2 justify-content-between d-flex align-items-center @error('nationality.id') is-invalid @enderror"
                                @if($customer['is_verified'] == 'f')
                                wire:click.prevent="nOpenModal('nationality','0')"
                                @endif
                        >
                            <div>
                                @if(!empty($nationality['iso2']))
                                    <img class="imaged rounded w24 me-1"
                                         src="{{ url('images/flags') }}/{{ strtolower($nationality['iso2']) }}.svg"
                                         alt="">
                                    <span>
                                        {{ $nationality['nationality'] }}
                                    </span>
                                @else
                                    <span class="text-placeholder">Nationality</span>
                                @endif
                            </div>

                            <ion-icon wire:ignore name="chevron-down-outline"></ion-icon>
                        </div>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <div
                                role="button"
                                class="form-control pe-2 justify-content-between d-flex align-items-center @error('place_of_birth') is-invalid @enderror"
                                @if($customer['is_verified'] == 'f')
                                wire:click.prevent="nOpenModal('place_of_birth','1')"
                                @endif
                        >
                            <div>
                                @if(!empty($place_of_birth))

                                    <span>
                                        {{ $place_of_birth }}
                                    </span>
                                @else
                                    <span class="text-placeholder">Place of Birth</span>
                                @endif
                            </div>

                            <ion-icon wire:ignore name="chevron-down-outline"></ion-icon>
                        </div>
                    </div>
                </div>


                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <div
                                role="button"
                                class="form-control pe-2 justify-content-between d-flex align-items-center @error('occupation.id') is-invalid @enderror"
                                @if($customer['is_verified'] == 'f')
                                wire:click.prevent="ocOpenModel('occupation','0')"
                                @endif
                        >
                            @if(!empty($occupation['id']))

                                <span>
                                        {{ $occupation['name'] }}
                                    </span>
                            @else
                                <span class="text-placeholder">Occupation</span>
                            @endif
                            <ion-icon wire:ignore name="chevron-down-outline"></ion-icon>
                        </div>
                    </div>
                </div>


                <div class="mt-1  mb-2">
                    <button type="submit" class="btn btn-primary  btn-block btn-lg">
                     <span wire:loading wire:target="profileUpdate">
                        <span class="spinner-grow spinner-grow-sm me-05" role="status" aria-hidden="true"></span>
                    </span>
                        {{ $modal == false ? 'Update':'Next' }}
                    </button>
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
        <div class="toast-box toast-top bg-warning  {{ !empty($alert) ? 'show' :'' }}">
            <div class="in">
                <div class="text">
                    {{ $alert }}
                </div>
            </div>
            <button type="button"
                    class="btn btn-sm btn-text-light close-button">OK
            </button>
        </div>
    @endif


    @include('inner.partials.modals.nationality')
    @include('inner.partials.modals.occupation')
    @include('inner.partials.modals.genders')
    @include('mobile.messages.error-messages')


</div>
