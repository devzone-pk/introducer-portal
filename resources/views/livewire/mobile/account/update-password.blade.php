<div id="appCapsule">

    <div class="px-3 mt-4">


        <p class="fs-20px text-full-black fw-bold">Update Password</p>
        <div class="rounded bg-white shadow-c form-padding">
        <form wire:submit.prevent="updatePassword">

            <div class="form-group boxed">
                <div class="input-wrapper">

                    <input type="email" class="form-control " value="{{ session('email') }}"
                             placeholder="Email" disabled>


                </div>
            </div>


            <div class="form-group boxed">
                <div class="input-wrapper">

                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                           wire:model.defer="current_password" placeholder="Current Password">
                    <i class="clear-input">
                        <ion-icon name="close-circle"></ion-icon>
                    </i>

                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">

                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                           wire:model.defer="new_password" placeholder="New Password">
                    <i class="clear-input">
                        <ion-icon name="close-circle"></ion-icon>
                    </i>

                </div>
            </div>


            <div class="form-group boxed">
                <div class="input-wrapper">

                    <input type="password" class="form-control @error('repeat_password') is-invalid @enderror"
                           wire:model.defer="repeat_password" placeholder="Confirm Password">
                    <i class="clear-input">
                        <ion-icon name="close-circle"></ion-icon>
                    </i>

                </div>
            </div>




            <div class="form-button-group padding-bottom-100">

                <button type="submit" class="btn btn-primary py-4 btn-block btn-lg">
                    <span wire:loading wire:target="updatePassword">
                        <span class="spinner-grow spinner-grow-sm me-05" role="status" aria-hidden="true"></span>
                    </span>
                    Update
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


    @include('mobile.messages.error-messages')
</div>
