<form wire:submit.prevent="updatePassword">

    <div class="bg-white shadow-sm rounded p-4 mb-4 ">

        <div class="g-3">
            <div class="col-12 col-sm-12">
                <label for="current_password" class="form-label">Current Password</label>
                <input wire:model.defer="current_password" type="password"
                       class="form-control @error('current_password') is-invalid @enderror"
                       data-bv-field="current_password" id="current_password" required
                       placeholder="Current Password">

            </div>
            <div class="col-12 col-sm-12 mt-2">
                <label for="new_password" class="form-label">New Password</label>
                <input wire:model.defer="new_password" type="password"
                       class="form-control  @error('new_password') is-invalid @enderror"
                       data-bv-field="new_password" id="new_password" required
                       placeholder="New Password">

            </div>
            <div class="col-12 col-sm-12 mt-2">
                <label for="repeat_password" class="form-label">Repeat Password</label>
                <input wire:model.defer="repeat_password" type="password"
                       class="form-control  @error('repeat_password') is-invalid @enderror"
                       data-bv-field="repeat_password" id="repeat_password" required
                       placeholder="Repeat Password">

            </div>
            <div class="col-12 mt-4 d-grid">
                <button wire:click.prevent="updatePassword" class="btn btn-primary shadow-none" type="button">
                    Update
                </button>
            </div>
        </div>

        @include('mobile.messages.error-messages')

        @if(!empty($success))
            <div class="alert alert-success mt-4" role="alert">
                {{ $success }}
            </div>
        @endif
    </div>
</form>
