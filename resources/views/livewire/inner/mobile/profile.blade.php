<div class="">
    <form wire:submit.prevent="profileUpdate" class="">
        <div class="bg-white  p-3 mb-4 ">


            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" wire:model.defer="first_name" class="form-control @error('first_name') is-invalid @enderror"

                       placeholder="First Name" {{ !empty($customer['first_name']) ? 'disabled': '' }}>

                @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" wire:model.defer="last_name"
                       class="form-control @error('last_name') is-invalid @enderror"
                       placeholder="Last Name" {{ !empty($customer['last_name']) ? 'disabled': '' }}>
                @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>


            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control"
                       placeholder="Email" value="{{ $customer['email'] }}" disabled>

            </div>


            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <div class="input-group">
                    <input type="number" @if(!empty($customer['dob'])) disabled @endif  wire:model.lazy="day"
                           aria-label="DD" placeholder="DD" class="form-control @error('day') is-invalid @enderror">
                    <input type="number" @if(!empty($customer['dob'])) disabled @endif   wire:model.lazy="month"
                           aria-label="MM" placeholder="MM" class="form-control  @error('month') is-invalid @enderror">
                    <input type="number" @if(!empty($customer['dob'])) disabled @endif   wire:model.lazy="year"
                           aria-label="YYYY" placeholder="YYYY"
                           class="form-control  @error('year') is-invalid @enderror">
                </div>
                @error('dob')
                <div class="invalid-feedback">{{ $message }}</div> @enderror

            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select
                    {{ !empty($customer['gender']) ? 'disabled': '' }} class="form-select  @error('gender') is-invalid @enderror"
                    wire:model.defer="gender">
                    <option value=""></option>
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                </select>
                @error('gender')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>


            <div class="mb-3">
                <div wire:ignore class=" @error('phone') is-invalid @enderror">
                    <label class="form-label d-block">Phone</label>
                    <input wire:model.defer="phone" class="form-control  @error('phone') is-invalid @enderror"
                           placeholder="Phone" type="tel" id="phone">
                </div>
                @error('phone')
                <div class="error">{{ $message }}</div> @enderror
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
                        Update
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

