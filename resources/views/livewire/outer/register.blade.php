<div>

    <section>
        <div class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center gx-0 min-vh-100">
                <div class="col-12 col-md-6 col-lg-4 py-8 py-md-11">

                    <!-- Heading -->
                    <h1 class="mb-0 fw-bold">
                        Sign up
                    </h1>

                    <!-- Text -->
                    <p class="mb-6 text-muted">
                        Secure & Reliable Money Transfers
                    </p>

                    <!-- Form -->
                    <form wire:submit.prevent="signup">
                        <div class="form-group text-start">
                            <label class="form-label mb-1 d-none" for="">First Name</label>
                            <input type="text" class="only-name form-control @error('first_name') is-invalid @enderror"
                                   placeholder="First Name" wire:model.lazy="first_name">
                            @error('first_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @endif

                        </div>

                        <div class="form-group text-start">
                            <label class="form-label  mb-1  d-none" for="">Last Name</label>

                            <input type="text" class="only-name form-control @error('last_name') is-invalid @enderror"
                                   placeholder="Last Name" wire:model.lazy="last_name">
                            @error('last_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @endif

                        </div>


                        {{--        <div--}}
                        {{--                class="form-control  @error('receiving_country.id') is-invalid @enderror align-items-center d-flex justify-content-between align-items-center @error('receiving_country.iso2') is-invalid @enderror"--}}
                        {{--                role="button"--}}
                        {{--                wire:click.prevent="rcOpenModel('receiving_country','0')">--}}
                        {{--            <div class="d-flex align-items-center">--}}
                        {{--                @if(!empty($receiving_country['currency']))--}}
                        {{--                    <i class="currency-flag currency-flag-{{ empty($receiving_country['currency']) ? ''  : strtolower($receiving_country['currency'])  }} me-2"></i>--}}
                        {{--                @endif--}}
                        {{--                <span--}}
                        {{--                        class="{{ empty($receiving_country['name']) ? 'placeholder-color' : '' }} ">{{ $receiving_country['name'] ?? 'Send Money to'  }}</span>--}}
                        {{--            </div>--}}
                        {{--            <img src="{{url('images/dropdown.svg')}}" width="10px">--}}
                        {{--        </div>--}}


                        <div class="form-group text-start">
                            <label class="form-label   mb-1 d-none" for="">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Email" wire:model.lazy="email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group text-start">
                            <label class="form-label   mb-1 d-none" for="">Password</label>
                            <input type="password" wire:model.lazy="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group text-start d-none">
                            <label class="form-label  mb-1 " for="">Sending From</label>
                            <select name="" wire:model="sending_country"
                                    class="form-control   @error('sending_country') is-invalid @enderror">
                                <option value="">Sending From</option>
                                @foreach($sending_countries as $s)
                                    <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                                @endforeach
                            </select>
                            @error('sending_country')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @endif
                        </div>


                        <div class="form-group text-start">
                            <label class="form-label  mb-1  d-none" for="">Sending To</label>
                            <select name="" wire:model="receiving_country"
                                    class="form-control   @error('receiving_country') is-invalid @enderror">
                                <option value="">Sending To</option>
                                @foreach($rc_data as $s)
                                    <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                                @endforeach
                            </select>
                            @error('receiving_country')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @endif
                        </div>


                        <div class="form-group text-start">
                            <label class="form-label  mb-1  d-none" for="">Phone</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">{{ $code  }}</span>
                                <input type="tel" class="form-control only-just-numbers @error('phone') is-invalid @enderror"
                                       wire:model.lazy="phone"
                                       placeholder="Mobile number">
                                @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-check text-start mb-3">
                            <input wire:model="show_referral" type="checkbox"
                                   class="form-check-input @error('show_referral') is-invalid @enderror"
                                   value="" id="flexCheckDefault2">
                            <label class="form-check-label" for="flexCheckDefault2">
                                Do you have any Referral code?
                            </label>
                            {{-- @error('referral_code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @endif --}}
                        </div>

                        @if($show_referral)
                        <div class="form-group text-start">
                            <input @if(!empty(request('referral'))) readonly @endif type="text"
                                   class="form-control @error('referral_code') is-invalid @enderror"
                                   placeholder="Referral Code " wire:model.lazy="referral_code">
                                   @error('referral_code')
                                   <div class="invalid-feedback">
                                       {{ $message }}
                                   </div>
                                   @enderror
                        </div>
                        @endif

                        <div class="form-check text-start mb-3">
                            <input wire:model="agree" type="checkbox"
                                   class="form-check-input @error('agree') is-invalid @enderror"
                                   value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                I agree to the <a href="/terms-and-conditions" class="text-primary">terms and
                                    conditions</a> and
                                <a href="/privacy-policy" class="text-primary">privacy policy</a>
                            </label>
                            @error('agree')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @endif
                        </div>

                        <div class="form-check text-start mb-3">
                            <input wire:model="promotion" type="checkbox"
                                   class="form-check-input @error('promotion') is-invalid @enderror"
                                   value="" id="flexCheckDefault1">
                            <label class="form-check-label" for="flexCheckDefault1">
                                Yes, I'd like to receive the latest information and offers
                                from {{ config('app.company_name') }} via email, SMS or other electronic means. I can
                                opt-out at any time.
                            </label>
                            @error('promotion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @endif
                        </div>


                        <div class="d-grid">
                            <button class="btn btn-primary shadow-none btn-block my-4" type="submit">Sign Up</button>
                        </div>

                    </form>

                    <!-- Text -->
                    <p class="mb-0 fs-sm text-muted">
                        Already have an account? <a href="{{ url('sign-in') }}">Log in</a>.
                    </p>

                </div>
                <div class="col-lg-7 offset-lg-1 align-self-stretch d-none d-lg-block">

                    <!-- Image -->
                    <div class="h-100 w-cover "
                         style="background-image: url(/assets/login.webp);"></div>

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
