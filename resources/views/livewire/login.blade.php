<div>
    <section>
        <div class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center gx-0 min-vh-100">
                <div class="col-12 col-md-6 col-lg-4 py-8 py-md-11">

                    <!-- Heading -->
                    <h1 class="mb-0 fw-bold">
                        Login here
                    </h1>

                    <!-- Text -->
                    <p class="mb-6 text-muted">
                        Secure & Reliable Money Transfers
                    </p>

                    <!-- Form -->
                    <!-- Form -->
                    <form class="mb-2" wire:submit.prevent="login">

                        <!-- Email -->
                        <div class="form-group">
                            <label class="visually-hidden" for="modalSigninHorizontalEmail">
                                Your email
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   wire:model.defer="email"
                                   placeholder="Your email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group  mb-2">
                            <label class="visually-hidden" for="modalSigninHorizontalPassword">
                                Enter your password
                            </label>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   wire:model.defer="password"
                                   placeholder="Enter your password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <p class="mb-3  fs-14px text-gray ">
                            <a class="text-decoration-underline" data-bs-toggle="modal" href="#modalForgot">Forgot my Password</a>
                        </p>

                        @if(!empty($success))
                            <div class="alert alert-success mb-3">{{ $success }}</div>
                        @endif

                        @if(!empty($error))
                            <div class="alert alert-danger fs-12px mb-3">{{ $error }}</div>
                    @endif
                    <!-- Submit -->
                        <button class="btn w-100 btn-primary" type="submit">
                            Login
                        </button>


                    </form>




                </div>
                <div class="col-lg-7 offset-lg-1 align-self-stretch d-none d-lg-block">

                    <!-- Image -->
                    <div class="h-100 w-cover " style="background-image: url(/assets/login.jpeg);"></div>

                    <!-- Shape -->
                    <div class="shape shape-start shape-fluid-y text-white">
                        <svg viewBox="0 0 100 1544" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h100v386l-50 772v386H0V0z" fill="currentColor"></path></svg>            </div>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>







</div>
