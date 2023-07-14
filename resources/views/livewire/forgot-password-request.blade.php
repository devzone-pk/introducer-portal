<div>
    {{-- Success is as dangerous as failure. --}}


    <div class="modal fade" wire:ignore.self id="modalForgot" tabindex="-1" role="dialog"
         aria-labelledby="modalForgot" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="card card-row">
                    <div class="row gx-0">
                        <div class="card-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-10 col-lg-8 text-center">


                                    @if(!empty($success))
                                        <svg width="85" height="85" viewBox="0 0 85 85" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M27.7734 45.5951L35.6369 53.5453L59.0689 29.6135" stroke="#42BA96"
                                                  stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                            <circle cx="42.5" cy="42.5" r="40.5" stroke="#42BA96" stroke-width="3"
                                                    stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>


                                        <h2 class="mt-4 fw-bold">
                                            Check your Email
                                        </h2>
                                        <p class="fs-lg text-muted mb-7 mb-md-9">
                                            For your security, please look for an email from us to reset your password.
                                        </p>
                                    @else

                                        <h2 class="fw-bold">
                                            Password Reset
                                        </h2>
                                        <p class="fs-lg text-muted mb-7 mb-md-9">
                                            Enter your valid email below, We will send you an email which will allow you
                                            to change your password.
                                        </p>
                                        <form wire:submit.prevent="resetPassword">
                                            <div class="mb-3">

                                                <input type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       wire:model.defer="email" id="emailAddress" required
                                                       placeholder="Enter Your Email">
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>


                                            @if(!empty($error))
                                                <div class="alert alert-danger mb-3">{{ $error }}</div>
                                            @endif
                                            <div class="d-grid mb-3">
                                                <button class="btn btn-primary shadow-none btn-block" type="submit">
                                                    Reset
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>


                        </div>

                    </div> <!-- / .row -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="success-register" tabindex="-1" role="dialog"
         aria-labelledby="success-register" aria-hidden="true">
        <div class="modal-dialog   modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="card card-row">
                    <div class="row gx-0">
                        <div class="card-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-10 col-lg-8 text-center">


                                    <svg width="85" height="85" viewBox="0 0 85 85" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M27.7734 45.5951L35.6369 53.5453L59.0689 29.6135" stroke="#42BA96"
                                              stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                        <circle cx="42.5" cy="42.5" r="40.5" stroke="#42BA96" stroke-width="3"
                                                stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>


                                    <h2 class="mt-4 fw-bold">
                                        Registration Successful
                                    </h2>


                                    <div class="d-grid mt-5">

                                        <a class="btn btn-primary shadow-none btn-block"  href="{{ url('sign-in') }}">Click to Login</a>
                                    </div>


                                </div>
                            </div>


                        </div>

                    </div> <!-- / .row -->
                </div>
            </div>
        </div>
    </div>


</div>
