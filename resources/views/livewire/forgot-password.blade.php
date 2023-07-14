<div>

    @if(!empty($details))
        <form wire:submit.prevent="resetPassword">
            <div class="mb-3">
                <label for="emailAddress" class="form-label text-start">Email Address</label>
                <input type="email" readonly class="form-control @error('email') is-invalid @enderror"
                       wire:model.defer="email"
                       required
                       placeholder="Enter Your Email">
                @error('email')
                <div class="invalid-feedback  text-start">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="loginPassword" class="form-label text-start">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       wire:model.defer="password" required
                       placeholder="Enter Password">
                @error('password')
                <div class="invalid-feedback  text-start">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="loginPassword" class="form-label text-start">Confirm Password</label>
                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"
                       wire:model.defer="confirm_password" required
                       placeholder="Enter Confirm Password">
                @error('confirm_password')
                <div class="invalid-feedback  text-start">
                    {{ $message }}
                </div>
                @enderror
            </div>

            @if(!empty($success))
                <div class="alert alert-success mb-3">{{ $success }}</div>
            @endif





            <div class="d-grid mb-3">
                <button class="btn btn-primary shadow-none btn-block" type="submit">Reset Password</button>
            </div>
        </form>
    @else
        <div class="alert alert-danger">
            Error! Invalid reset link.
        </div>
    @endif
</div>
