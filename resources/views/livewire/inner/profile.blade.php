<div class="row g-3">

    @livewire('inner.sidebar')
    <div class="col-md-9 col-12">
        @if(!$edit)

            <div class="card card-border border-primary shadow-light-lg mb-6">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Heading -->
                            <h4 class="mb-0">
                                Personal Details
                            </h4>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-light px-5 py-1" wire:click.prevent="toggleEdit">Edit</button>
                        </div>
                    </div>
                </div>
                <div class="card-body ">

                    <!-- List group -->
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Heading -->
                                    <p class="mb-0">
                                        Customer Code
                                    </p>

                                    <!-- Text -->
                                    <small class="text-gray-700 fw-light">
                                        {{ $customer['id'] }}
                                    </small>

                                </div>

                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Heading -->
                                    <p class="mb-0">
                                        Name
                                    </p>

                                    <!-- Text -->
                                    <small class="fw-light text-gray-700">
                                        {{ $customer['first_name'] }} {{ $customer['last_name'] }}
                                    </small>

                                </div>

                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Heading -->
                                    <p class="mb-0">
                                        Date of Birth
                                    </p>

                                    <!-- Text -->
                                    <small class="fw-light text-gray-700">
                                        @if(!empty( $customer['dob']))
                                            {{ date('d M, Y',strtotime( $customer['dob']))  }}
                                        @endif
                                    </small>

                                </div>

                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Heading -->
                                    <p class="mb-0">
                                        Phone
                                    </p>

                                    <!-- Text -->
                                    <small class="fw-light text-gray-700">
                                        {{ $customer['phonecode'] }} {{ $customer['phone'] }}
                                    </small>

                                </div>

                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Heading -->
                                    <p class="mb-0">
                                        Address
                                    </p>

                                    <!-- Text -->
                                    <small class="fw-light text-gray-700">
                                        {{ $customer['house_no'] }} {{ $customer['street_name'] }} {{ $customer['postal_code'] }}  {{ $customer['city_name'] }}
                                        , {{ $customer['country_name'] }}
                                    </small>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>


        @endif
        @if($edit)


            <div class="card card-border border-primary shadow-light-lg mb-6">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Heading -->
                            <h4 class="mb-0">
                                Update Personal Details
                            </h4>
                        </div>

                    </div>
                </div>
                <div class="card-body ">

                    @if($incomplete_profile)
                        <div class="alert alert-warning">
                            Your profile is incomplete please update your profile to make transaction.
                        </div>
                    @endif


                    <form wire:submit.prevent="update">
                        <div class="row">

                            <div class="col-12 col-sm-6">
                                <label class="form-label fs-16px mb-1">First Name<span
                                            class="text-danger">*</span></label>
                                <input wire:model.defer="customer.first_name" type="text"
                                       class="only-name  fs-16px form-control  @error('customer.first_name') is-invalid @enderror"
                                       {{ $customer['is_verified'] == 't' ? 'readonly':'' }}
                                       placeholder="First Name">
                                @error('customer.first_name')
                                <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6">
                                <label class="form-label fs-16px  mb-1">Last Name<span
                                            class="text-danger">*</span></label>
                                <input wire:model.defer="customer.last_name" type="text"
                                       class="only-name  fs-16px form-control @error('customer.last_name') is-invalid @enderror"
                                       {{ $customer['is_verified'] == 't' ? 'readonly':'' }}
                                       placeholder="Last Name">
                                @error('customer.last_name')
                                <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-6 mt-3">
                                <label class="form-label fs-16px  mb-1">Email<span class="text-danger">*</span></label>
                                <input value="{{ $customer['email'] }}" type="email" readonly
                                       class=" fs-16px form-control @error('customer.email') is-invalid @enderror"
                                       placeholder="Email">
                                @error('customer.email')
                                <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6 mt-3">
                                <label for="birthDate" class="form-label fs-16px  mb-1">Date of Birth<span
                                            class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input wire:model.defer="customer.dob" id="birthDate" type="date"
                                           class=" fs-16px form-control @error('customer.dob') is-invalid @enderror"
                                           {{ $customer['is_verified'] == 't' ? 'readonly':'' }}
                                           placeholder="Date of Birth">

                                    @error('customer.dob')
                                    <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 mt-3">

                                <label class="form-label fs-16px  mb-1">Mobile Number<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">{{ $customer['phonecode'] }}</span>
                                    <input type="text"
                                           class="form-control @error('customer.phone') is-invalid @enderror"
                                           wire:model.defer="customer.phone"
                                           placeholder="Mobile number">
                                    @error('customer.phone')
                                    <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                    @enderror
                                </div>


                            </div>

                            <div class="col-12 col-sm-6 mt-3">
                                <label for="gender" class="form-label  fs-16px mb-1">Gender<span
                                            class="text-danger">*</span></label>
                                <select wire:model.defer="customer.gender"
                                        {{ $customer['is_verified'] == 't' ? 'readonly':'' }} class="form-control fs-16px @error('customer.gender') is-invalid @enderror "
                                        id="gender"
                                        name="gender">
                                    <option value="">Choose Gender</option>
                                    <option value="m">Male</option>
                                    <option value="f">Female</option>
                                </select>
                                @error('customer.gender')
                                <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                @enderror
                            </div>
                            <div class="col-xs-12 col-sm-6 mt-3">

                                <label class="form-label   fs-16px mb-1">Nationality<span
                                            class="text-danger">*</span></label>

                                <select wire:model.defer="customer.nationality_country_id"
                                        {{ $customer['is_verified'] == 't' ? 'readonly':'' }} class="form-control fs-16px @error('customer.nationality_country_id') is-invalid @enderror ">
                                    <option value="">Choose Nationality</option>
                                    @foreach($n_data as $n)
                                        <option value="{{ $n['id'] }}">{{ $n['nationality'] }}</option>
                                    @endforeach
                                </select>

                                @error('customer.nationality_country_id')
                                <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                @enderror

                            </div>


                            <div class="col-xs-12 col-sm-6 mt-3">

                                <label class="form-label  fs-16px  mb-1">Place of Birth<span
                                            class="text-danger">*</span></label>
                                <select wire:model.defer="customer.place_of_birth"
                                        class="only-name fs-16px  form-control @error('customer.place_of_birth') is-invalid @enderror"
                                        {{ $customer['is_verified'] == 't' ? 'readonly':'' }}
                                        placeholder="Place of Birth">
                                    <option value="">Choose Place of Birth</option>
                                    @foreach($countries as $co)
                                        <option value="{{$co['name']}}">{{$co['name']}}</option>
                                    @endforeach
                                </select>

                                @error('customer.place_of_birth')
                                <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                @enderror

                            </div>
                            <div class="col-12 col-sm-6 mt-5">
                                <label for="occupation" class="form-label fs-16px  mb-1">Occupation<span
                                            class="text-danger">*</span></label>
                                <select wire:model.defer="occupation_id"
                                        {{ $customer['is_verified'] == 't' ? 'readonly':'' }} class="form-control fs-16px @error('occupation_id') is-invalid @enderror">
                                    <option value="">Choose Occupation</option>
                                    @foreach($oc_data as $n)
                                        <option value="{{ $n['id'] }}">{{ $n['name'] }}</option>
                                    @endforeach
                                </select>

                                @error('occupation_id')
                                <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                @enderror


                            </div>


                            <div class="col-12 col-sm-12 mt-5">
                                <h4 class="mt-4">Address</h4>
                                <hr>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 mt-3">
                                <label class="form-label mb-1">House No</label>
                                <input wire:model.defer="customer.house_no" type="text"
                                       class="only-alphanum form-control @error('customer.house_no') is-invalid @enderror "
                                       {{ $customer['is_verified'] == 't' ? 'readonly':'' }}
                                       placeholder="House No # ">
                                @error('customer.house_no')
                                <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6 mt-3">
                                <label class="form-label mb-1">Street</label>
                                <input wire:model.defer="customer.street_name" type="text"
                                       class="only-alphanum form-control @error('customer.street_name') is-invalid @enderror"
                                       {{ $customer['is_verified'] == 't' ? 'readonly':'' }}
                                       placeholder="Street Address">
                                @error('customer.street_name')
                                <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6 mt-3">
                                <label class="form-label mb-1">Post Code</label>
                                <input wire:model.defer="customer.postal_code" type="text"
                                       class="only-alphanum form-control @error('customer.postal_code') is-invalid @enderror"
                                       {{ $customer['is_verified'] == 't' ? 'readonly':'' }}
                                       oninput="this.value = this.value.toUpperCase()"
                                       placeholder="Post Code">
                                @error('customer.postal_code')
                                <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                @enderror
                            </div>
                            <div class="col-xs-12 col-sm-6 mt-3">

                                <label class="form-label mb-1">City</label>
                                <input wire:model.defer="customer.city_name" type="text"
                                       class="only-name form-control @error('customer.city_name') is-invalid @enderror"
                                       {{ $customer['is_verified'] == 't' ? 'readonly':'' }}
                                       placeholder="City Name">
                                @error('customer.city_name')
                                <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                @enderror

                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">

                                <label class="form-label mb-1">Country</label>
                                <input type="text" class="form-control" readonly
                                       placeholder="Country" value="{{ $customer['country_name'] }}">

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                @if(session()->has('success'))
                                    <div class="alert  mt-4 fs-14px alert-success"
                                         role="alert">{{ session()->get('success') }}</div>
                                @elseif(session()->has('error'))
                                    <div class="alert mt-4 fs-14px alert-danger"
                                         role="alert">{{ session()->get('error') }}</div>
                                @endif

                                {{--                            @if($errors->any())--}}
                                {{--                                <div class="alert mt-4 alert-danger">--}}
                                {{--                                    @foreach($errors->all() as $e)--}}
                                {{--                                        <p class="mb-0  fs-14px">{{ $e }}</p>--}}
                                {{--                                    @endforeach--}}
                                {{--                                </div>--}}
                                {{--                            @endif--}}
                            </div>
                        </div>
                        <div class="row">
                            @if($show_password)
                                <div class="col-6 mt-5 d-grid">
                                    <button wire:click.prevent="toggleEdit" class="btn btn-light shadow-none"
                                            type="submit">
                                        Back
                                    </button>
                                </div>
                            @endif
                            <div class="@if($show_password) col-6 @else col-12 @endif mt-4 d-grid">
                                <button class="btn btn-primary shadow-none" type="submit">Update
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>



        @endif

        <div class="card card-border border-primary shadow-light-lg mb-6">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Heading -->
                        <h4 class="mb-0">
                            Password
                        </h4>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-light px-5 py-1" href="#password-change-modal"
                                data-bs-toggle="modal">Update
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Heading -->
                                <p class="mb-0">
                                    Email
                                </p>

                                <!-- Text -->
                                <small class="text-gray-700 fw-light">
                                    {{ session('email') }}
                                </small>

                            </div>

                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Heading -->
                                <p class="mb-0">
                                    Password
                                </p>

                                <!-- Text -->
                                <small class="fw-light text-gray-700">
                                    *********
                                </small>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

