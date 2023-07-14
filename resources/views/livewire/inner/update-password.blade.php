<div>
    {{--    Change Password Card--}}






    {{--    Change Password Modal--}}
    <div id="password-change-modal" wire:ignore.self class="modal fade " role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header p-4">
                    <h5 class="modal-title ">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="updatePassword" id="password-change-modal">
                        <div class="g-3">
                            <div class="col-12 col-sm-12">
                                <label for="current_password" class="form-label fs-16px">Current Password</label>
                                <input wire:model.defer="current_password" type="password" class=" fs-16px form-control @error('current_password') is-invalid @enderror"
                                       id="current_password" required
                                       placeholder="Current Password">
                                @error('current_password')
                                <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12 col-sm-12 mt-2">
                                <label for="new_password" class="form-label fs-16px">New Password</label>
                                <input wire:model.defer="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror fs-16px"
                                       data-bv-field="new_password" id="new_password" required
                                       placeholder="New Password">
                                @error('new_password')
                                <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12 col-sm-12 mt-2">
                                <label for="repeat_password" class="form-label fs-16px">Repeat Password</label>
                                <input wire:model.defer="repeat_password" type="password" class="form-control fs-16px @error('repeat_password') is-invalid @enderror"
                                       data-bv-field="repeat_password" id="repeat_password" required
                                       placeholder="Repeat Password">
                                @error('repeat_password')
                                <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12 mt-4 d-grid">
                                <button wire:click.prevent="updatePassword" class="btn btn-primary  shadow-none"
                                        type="button">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

