<div>
    <section>
        <div class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center gx-0 min-vh-100">
                <div class="col-12 col-md-6 col-lg-4 py-8 py-md-11">

                    <!-- Heading -->
                    <h1 class="mb-0 fw-bold">
                        Verify Your Account
                    </h1>

                    <!-- Text -->
                    <p class="mb-6 text-muted">
                        A one-time password has been sent to your phone. Please enter it here to verify your account.
                    </p>

                    <!-- Form -->
                    <!-- Form -->
                    <form class="mb-2" wire:submit.prevent="verify">

                        <!-- Email -->
                        <div class="form-group">
                            <label class="visually-hidden" for="modalSigninHorizontalEmail">
                                Your email
                            </label>
                            <input type="email" readonly class="form-control @error('email') is-invalid @enderror"
                                   value="{{ $email }}"
                                   placeholder="Your email">

                        </div>

                        <!-- Password -->
                        <div class="form-group  mb-2">
                            <label class="visually-hidden">
                                Enter your OTP
                            </label>
                            <input type="number" required
                                   class="form-control @error('password') is-invalid @enderror"
                                   wire:model.defer="otp"
                                   placeholder="Enter your OTP">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        @if(!empty($success))
                            <div class="alert alert-success mb-3">
                                Your account has been verified. Please <a href="{{ url('sign-in') }}">click here</a> to
                                login
                            </div>
                        @endif

                        @if(!empty($error))
                            <div class="alert alert-danger fs-12px mb-3">{{ $error }}</div>
                    @endif
                    <!-- Submit -->
                        <button class="btn w-100 btn-primary" type="submit">
                            Verify
                        </button>


                    </form>

                    <!-- Text -->


                </div>
                <div class="col-lg-7 offset-lg-1 align-self-stretch d-none d-lg-block">

                    <!-- Image -->
                    <div class="h-100 w-cover bg-cover"
                         style="background-image: url(/assets/img/covers/xmg-login.png);"></div>

                    <!-- Shape -->
                    <div class="shape shape-start shape-fluid-y text-white">
                        <svg viewBox="0 0 100 1544" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0h100v386l-50 772v386H0V0z" fill="currentColor"></path>
                        </svg>
                    </div>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>


</div>
