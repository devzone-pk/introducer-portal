<div>
    <div class="  px-3 mt-4">
        @if($incomplete_profile)
            <div class="alert alert-warning mb-2">
                Your address is incomplete please update your address to make transaction.
            </div>
        @endif
        <p class="fs-20px text-full-black fw-bold">Update Address Details</p>
        <div class="rounded bg-white shadow-c form-padding">
            <form wire:submit.prevent="addressUpdate">


                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <input type="text" class="form-control only-alphanum @error('house_no') is-invalid @enderror"
                               wire:model.defer="house_no" placeholder="House #"
                                {{ $customer['is_verified'] == 't' ? 'disabled':'' }}>
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>


                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <input type="text" class="form-control only-alphanum @error('street_name') is-invalid @enderror"
                               wire:model.lazy="street_name" placeholder="Street"
                                {{ $customer['is_verified'] == 't' ? 'disabled':'' }}>
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>


                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <input type="text" class="form-control only-alphanum @error('postal_code') is-invalid @enderror"
                               oninput="this.value = this.value.toUpperCase()" wire:model.defer="postal_code"
                               placeholder="Postal Code"
                                {{ $customer['is_verified'] == 't' ? 'disabled':'' }}>
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>


                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <input type="text" class="form-control only-name  @error('city_name') is-invalid @enderror"
                               wire:model.defer="city_name" placeholder="City"
                                {{ $customer['is_verified'] == 't' ? 'disabled':'' }}>
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>


                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <input type="text"
                               style="background: rgb(204 204 204 / 31%);"
                               class="form-control" value="{{ $country }}"
                               placeholder="Country" disabled>
                    </div>
                </div>


                {{--                    <div class="form-group boxed">--}}
                {{--                        <div class="input-wrapper">--}}
                {{--                            <label class="label" for="gender">Address</label>--}}
                {{--                            <div--}}
                {{--                                role="button"--}}
                {{--                                class="form-control d-flex align-items-center @error('city.id') is-invalid @enderror"--}}

                {{--                                wire:click.prevent="adOpenModel('address','0')"--}}

                {{--                            >--}}
                {{--                                @if(!empty($address))--}}
                {{--                                    <span>--}}
                {{--                                        {{ $address }}--}}
                {{--                                    </span>--}}
                {{--                                @else--}}
                {{--                                    <span class="text-placeholder">Address</span>--}}
                {{--                                @endif--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}


                <div class="mt-1 mb-2">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                    <span wire:loading wire:target="addressUpdate">
                        <span class="spinner-grow spinner-grow-sm me-05" role="status" aria-hidden="true"></span>
                    </span>
                        {{ $modal == false ? 'Update':'Next' }}
                    </button>
                </div>

            </form>
        </div>
    </div>

    @if($modal==false)
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
        <div class="toast-box toast-bottom bg-warning  {{ !empty($alert) ? 'show' :'' }}">
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

    @include('inner.partials.modals.search-cities')
    @include('inner.partials.modals.address')
    @include('mobile.messages.error-messages')

</div>
