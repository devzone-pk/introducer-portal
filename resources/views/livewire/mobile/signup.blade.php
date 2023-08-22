<div id="appCapsule">

    <div class="section mt-0 text-center">
        <img style="width: 40%; margin-bottom: 30px;" src="{{ asset('assets/img/ogr-crop.png') }}" alt="">
    </div>

    <div class="section mb-5 p-2">
        <div class="rounded bg-white shadow-c form-padding mb-4">

            @if(!$is_signed_up)
                <form wire:submit.prevent="signup">

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            {{--                            <label class="label">Email</label>--}}
                            <input type="text"
                                   class="form-control only-name  form-control-sign @error('first_name') is-invalid @enderror"
                                   wire:model.lazy="first_name" placeholder="First Name">

                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            {{--                            <label class="label">Email</label>--}}
                            <input type="text"
                                   class="form-control only-name  form-control-sign @error('last_name') is-invalid @enderror"
                                   wire:model.lazy="last_name" placeholder="Last Name">

                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            {{--                            <label class="label">Email</label>--}}
                            <input type="text"
                                   class="form-control form-control-sign @error('email') is-invalid @enderror"
                                   wire:model.lazy="email" placeholder="Email Address">

                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">

                            <input type="text" wire:model.defer="password"
                                   class="form-control  form-control-sign @error('password') is-invalid @enderror"
                                   placeholder="Set Password" id="signup-password">
                            <div class="show-hide" role="button" id="signup-password-btn"
                                 onclick="showHidePassword()">
                             <span id="eye-show">
                                 <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_101_1118)">
                            <path d="M15.18 12C15.18 13.76 13.76 15.18 12 15.18C10.24 15.18 8.82001 13.76 8.82001 12C8.82001 10.24 10.24 8.82001 12 8.82001C13.76 8.82001 15.18 10.24 15.18 12Z"
                                  stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 19.5C15.45 19.5 18.63 17.22 20.67 13.34C21.11 12.51 21.11 11.49 20.67 10.66C18.63 6.78 15.45 4.5 12 4.5C8.54998 4.5 5.37 6.78 3.33 10.66C2.89 11.49 2.89 12.51 3.33 13.34C5.37 17.22 8.54998 19.5 12 19.5Z"
                                  stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_101_1118">
                            <rect width="24" height="24" fill="white"/>
                            </clipPath>
                            </defs>
                            </svg>

                             </span>
                                <span class="d-none" id="eye-hide">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_101_1073)">
<path d="M15.18 12C15.18 12.88 14.82 13.69 14.23 14.26L9.73999 9.76001C10.32 9.18001 11.12 8.82001 12 8.82001C13.75 8.82001 15.18 10.24 15.18 12Z"
      stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M12 19.34C15.45 19.34 18.63 17.11 20.67 13.31C21.11 12.49 21.11 11.5 20.67 10.68C18.63 6.87999 15.45 4.64999 12 4.64999C8.55 4.64999 5.37 6.87999 3.33 10.68C2.89 11.5 2.89 12.49 3.33 13.31C5.37 17.11 8.55 19.34 12 19.34V19.34Z"
      stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M3 3L20.95 21" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
<path d="M11.16 15.07C10.04 14.76 9.15999 13.86 8.89999 12.71" stroke="black" stroke-width="1.5" stroke-linecap="round"
      stroke-linejoin="round"/>
</g>
<defs>
<clipPath id="clip0_101_1073">
<rect width="24" height="24" fill="white"/>
</clipPath>
</defs>
</svg>

                        </span>

                            </div>
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            {{--                            <label class="label">Send Money To</label>--}}
                            <div role="button"
                                 class="form-control d-flex form-control-sign justify-content-between align-items-center @error('receiving_country.id') is-invalid @enderror"
                                 wire:click.prevent="rcOpenModel('receiving_country','0')"
                                 style="padding-right: 16px;">
                                <div>
                                    @if(!empty($receiving_country['iso2']))
                                        <img class="imaged rounded w24 me-1"
                                             src="{{ url('images/flags') }}/{{ strtolower($receiving_country['iso2']) }}.svg"
                                             alt="">
                                        <span>
                                        {{ $receiving_country['name'] }}
                                    </span>
                                    @else
                                        <span class="text-placeholder">Sending Money To</span>
                                    @endif
                                </div>
                                <ion-icon wire:ignore name="chevron-down-outline"></ion-icon>
                            </div>
                        </div>
                    </div>
                    <div class="form-group boxed d-none">
                        <div class="input-wrapper">
                            {{--                            <label class="label">From</label>--}}
                            <div class="form-control d-flex align-items-center justify-content-between  @error('sending_country.id') is-invalid @enderror"
                                 wire:click.prevent="scOpenModel('sending_country','0')"
                                 style="padding-right: 16px;">
                                <div>
                                    @if(!empty($sending_country['iso2']))

                                        <img class="imaged rounded w24 me-1"
                                             src="{{ url('images/flags') }}/{{ strtolower($sending_country['iso2']) }}.svg"
                                             alt="">
                                        <span>
                                        {{ $sending_country['name'] }}
                                    </span>
                                    @else
                                        <span class="text-placeholder">From</span>
                                    @endif
                                </div>
                                <ion-icon wire:ignore name="chevron-down-outline"></ion-icon>
                            </div>
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <div class="row ">
                                <div class="col-4">
                                    <input type="text" readonly class="form-control  form-control-sign"
                                           style="background: rgb(204 204 204 / 31%);padding-right: 5px;"
                                           wire:model="phone_code" placeholder="Code">
                                </div>
                                <div class="col-8">
                                    <input type="number" wire:model="phone_number"
                                           class="form-control  form-control-sign @error('phone_number') is-invalid @enderror"
                                           placeholder="Enter Mobile # ">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>


                            </div>

                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" class="form-control  form-control-sign " wire:model.lazy="referral_code"
                                   placeholder="Referral Code (if any)">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="custom-control custom-checkbox mt-2 mb-1">
                        <div class="form-check">
                            <input type="checkbox" wire:model="agree" id="customCheckb1"
                                   class="form-check-input  @error('agree') is-invalid @enderror">
                            <label class="form-check-label" for="customCheckb1">
                                I accept <a href="#" class="text-decoration-underline" data-bs-toggle="modal"
                                            data-bs-target="#termsModal">Terms & Conditions</a> and <a href="#"
                                                                                                       class="text-decoration-underline"
                                                                                                       data-bs-toggle="modal"
                                                                                                       data-bs-target="#privacy">Privacy
                                    Policy</a>
                            </label>
                        </div>

                    </div>
                    <div class="custom-control custom-checkbox mt-2 mb-1">
                        <div class="form-check">
                            <input type="checkbox" wire:model="promotion" id="customCheckb12"
                                   class="form-check-input  @error('promotion') is-invalid @enderror">
                            <label class="form-check-label" for="customCheckb12">
                                Yes, I'd like to receive the latest information and offers from Orium Global Resources via email, SMS or other electronic means. I can opt-out at any time.</a>
                            </label>
                        </div>

                    </div>



                    <div class="mt-3 transparent">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">
                    <span wire:loading wire:target="signup">
                        <span class="spinner-grow spinner-grow-sm me-05" role="status" aria-hidden="true"></span>
                    </span>
                            Sign up
                        </button>
                    </div>

                </form>
            @else

                <!-- Heading -->
                <h2 class="text-center mt-1 mb-1 fw-bold">
                    Verify Your Account
                </h2>

                <!-- Text -->
                <p class="text-center mb-6 text-muted">
                    A one-time password has been sent to your phone. Please enter it here to verify your account.
                </p>

                <form class="mb-2" wire:submit.prevent="verify">

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="email" value="{{ $unverified_email }}"
                                   class="form-control @error('email') is-invalid @enderror" placeholder="Email Address"
                                   readonly disabled>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="number" class="form-control @error('password') is-invalid @enderror"
                                   wire:model.defer="otp" placeholder="Enter your OTP" required>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>



                    @if(!empty($verify_success))
                        <div class="form-group boxed">
                            <div class="alert alert-success">
                                Your account has been verified. Please <a class="fw-bold" href="{{ url('user/login') }}">click here</a> to
                                login
                            </div>
                        </div>
                    @endif

                    <div class="mt-1 transparent">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">
                            <span wire:loading wire:target="verify">
                                <span class="spinner-grow spinner-grow-sm me-05" role="status"
                                      aria-hidden="true"></span>
                            </span>
                            Verify
                        </button>
                    </div>

                </form>
            @endif

        </div>

        @if(!$is_signed_up)
            <p class="text-center  mt-2  text-decoration-underline">
                Already have an account? <a class="fw-bold" href="{{ url('user/login') }}">Log in</a>
            </p>
        @endif

    </div>


    @include('inner.partials.modals.receiving-countries')
    @include('inner.partials.modals.sending-countries')
    @include('mobile.messages.error-messages')


    <div class="modal fade dialogbox " id="signup-success" data-bs-backdrop="static" tabindex="-1" role="dialog"
         aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-icon text-success">
                    <ion-icon name="checkmark-circle" role="img" class="md hydrated"
                              aria-label="checkmark circle"></ion-icon>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title">Sign up Successful</h5>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        {{--                        <a href="{{ url('user/login') }}" class="btn">Go to Login</a>--}}
                        <a data-bs-dismiss="modal" data-dismiss="modal" class="btn">Okay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    --}}
    {{--        <div class="toast-box toast-center show">--}}
    {{--            <div class="in">--}}
    {{--                <ion-icon name="checkmark-circle" class="text-success md hydrated" role="img"--}}
    {{--                          aria-label="checkmark circle"></ion-icon>--}}
    {{--                <div class="text">--}}
    {{--                    Registration has been done.--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <a href="{{ url('user/login') }}" class="btn btn-sm btn-text-light close-button">Go To Login</a>--}}
    {{--        </div>--}}

</div>
