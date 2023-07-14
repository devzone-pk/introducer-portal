<div>
    <form wire:submit.prevent="addressUpdate" class="">
        <div class="bg-white p-3 mb-4 ">


            <div class="mb-3">
                <label class="form-label">House #</label>
                <input type="text" wire:model.defer="house_no"
                       class="form-control @error('house_no') is-invalid @enderror"

                       placeholder="House #" {{ !empty($customer['house_no']) ? 'disabled': '' }}>

                @error('house_no')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Street</label>
                <input type="text" wire:model.defer="street_name"
                       class="form-control @error('street_name') is-invalid @enderror"
                       placeholder="Street Name" {{ !empty($customer['street_name']) ? 'disabled': '' }}>
                @error('street_name')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>


            <div class="mb-3">
                <label class="form-label">Postal Code</label>
                <input type="text" wire:model.defer="postal_code"
                       class="form-control @error('postal_code') is-invalid @enderror"
                       placeholder="Postal Code" {{ !empty($customer['postal_code']) ? 'disabled': '' }}>
                @error('postal_code')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>


            <div class="mb-3">
                <label class="form-label">Country</label>
                <input type="text"
                       class="form-control" value="{{ $country }}"
                       placeholder="Country" disabled>

            </div>
            <div class="mb-3">
                <label class="form-label mb-1">City</label>
                @if(empty($customer['city_id']))
                    <div
                        class="d-flex form-control align-items-center @error('city.name') is-invalid @enderror"
                        role="button"
                        wire:click.prevent="scOpenModal('city','1')">

                    <span
                        class="{{ empty($city['name']) ? 'placeholder-color' : '' }} ">{{ $city['name'] ?? 'Choose Country'  }}</span>
                    </div>
                    @error('city.name')
                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                @else

                    <input type="text"
                           class="form-control" value="{{ $city['name']}}"
                           placeholder="City" disabled>
                @endif
            </div>


            @if(!empty($success))
                <div class="mb-3">
                    <div class="alert alert-success">
                        {{ $success }}
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-6 mt-4 d-grid">
                    <button class="btn btn-light shadow-none" type="button" onclick="history.back()">Back</button>
                </div>
                <div class="col-6 mt-4 d-grid">
                    <button class="btn btn-primary shadow-none" type="submit">
                        {{ $modal == false ? 'Update':'Next' }}
                    </button>
                </div>
            </div>
        </div>
    </form>

    @include('inner.partials.modals.search-cities')
</div>
