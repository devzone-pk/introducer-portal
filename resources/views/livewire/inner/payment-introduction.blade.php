<div class="row g-3">

    @if (session()->has('form_success'))
        <div class="alert fs-12px  alert-success">
            {{ session('form_success') }}
        </div>
    @endif
    <div class="card mt-2 card-border border-primary p-0">
        <div class="card-header ">
            <div class="row align-items-center">
                <div class="col">
                    <!-- Heading -->
                    <h4 class="mb-0 text-center fw-bold">
                        Payment Request Form
                    </h4>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="col-12 jumbotron">
                <div class="list-group list-group-flush mb-4">
                    <div class="list-group-item">
                        <div class="d-flex align-items-center justify-content-between text-center pt-5">
                            <div class="col ">

                                <!-- Heading -->
                                <p class="mb-0 fw-bold">
                                    Affiliate No
                                </p>
                                <!-- Text -->
                                <small class="fw-normal text-gray-700">
                                    {{session('customer_id')}}
                                </small>

                            </div>
                            <div class="col">

                                <!-- Heading -->
                                <p class="mb-0 fw-bold">
                                    Affiliate Name
                                </p>

                                <!-- Text -->
                                <small class=" fw-normal text-gray-900">
                                    {{session('name')}}
                                </small>

                            </div>
                            <div class="col">

                                <!-- Heading -->
                                <p class="mb-0 fw-bold">
                                    Affiliate Email
                                </p>

                                <!-- Text -->
                                <small class="fw-normal text-gray-900">
                                    {{session('email')}}
                                </small>

                            </div>

                        </div>
                    </div>
                </div>


                <div class="accordion card-border border-primary mb-4" id="accordionExample"
                     style="box-shadow: 0 2px 10px #00000010">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button @if($selected_window != 'customer_info'  && (!$details_completed['customer_info'])) bg-gray-200  @endif "
                                    @if($selected_window != 'customer_info' && (!$details_completed['customer_info'])) disabled
                                    @endif
                                    {{--                            @if($transfer->sub_status == 't') style="background-color: #dc3545;color: white" @endif--}}
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >
                                <div class="w-100 d-flex justify-content-between align-items-center ">
                                    <strong>Customer Info </strong>
                                    @if($details_completed['customer_info'])
                                        <div class="fs-14px align-middle">
                                            {{$customer['first_name'] }} {{$customer['last_name']}}
                                            <span>&nbsp;</span>
                                        </div>
                                        <div class=" fs-14px  align-middle">
                                            {{$customer['email'] }}
                                            <span>&nbsp;</span>
                                        </div>
                                        <div class=" fs-14px align-middle">
                                            {{$customer['phone_code'] }}{{$customer['phone'] }}
                                            <span>&nbsp;</span>
                                        </div>

                                        <div class=" fs-14px align-middle">
                                         <span class="bg-success badge">
                                          Details Completed
                                        </span>
                                            <span>&nbsp;</span>
                                        </div>
                                    @endif

                                </div>
                            </button>
                        </h2>
                        <div id="collapseOne"
                             class="accordion-collapse collapse @if($selected_window == 'customer_info') show  @endif"
                             wire:ignore.self
                             aria-labelledby="headingOne"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                                @if(!$customer_check)
                                    <form wire:submit.prevent="customerExistsCheck">
                                        <div class="row pt-3">
                                            <div class="col-12 col-sm-6">
                                                <label class="form-label fs-16px  mb-1">Email<span
                                                            class="text-danger">*</span></label>
                                                <input
                                                        {{--                                                    value="{{ $customer['email'] }}"--}}
                                                        type="email" wire:model.defer="customer.email"
                                                        class=" fs-16px form-control form-control-sm  @error('customer.email') is-invalid @enderror"
                                                        placeholder="Email">
                                                @error('customer.email')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label class="form-label fs-16px  mb-1">Mobile Number<span
                                                            class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                <span class="input-group-text fs-14px"
                                                      id="basic-addon1">
                                                    {{ $customer['phone_code'] }}
                                                </span>
                                                    <input type="text"
                                                           class="form-control only-just-numbers form-control-sm  @error('customer.phone') is-invalid @enderror"
                                                           wire:model.defer="customer.phone"
                                                           placeholder="Mobile number">
                                                    @error('customer.phone')
                                                    <span class="invalid-feedback" role="alert">
                                                         {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 d-grid">
                                                @error('cus_check')
                                                <div class="alert alert-danger mb-3 fade show d-flex justify-content-between"
                                                     role="alert">
                                                    <div>
                                                        <p class="m-0"> {{ $message }}</p>
                                                    </div>
                                                </div>
                                                @enderror
                                                <button type="submit" id="submit_check"
                                                        wire:loading.attr="disabled"
                                                        class="btn btn-primary shadow-none">Continue
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                @else
                                    @if(empty($customer_id))
                                        <form wire:submit.prevent="validateCustomerDetails">
                                            <div class="row pt-3">
                                                <div class="col-12 col-sm-4">
                                                    <label class="form-label fs-16px mb-1">First Name<span
                                                                class="text-danger">*</span></label>
                                                    <input wire:model.defer="customer.first_name" type="text"
                                                           class="only-name form-control form-control-sm  @error('customer.first_name') is-invalid @enderror"
                                                           {{--                                                   {{ $customer['is_verified'] == 't' ? 'readonly':'' }}--}}
                                                           placeholder="First Name">
                                                    @error('customer.first_name')
                                                    <span class="invalid-feedback" role="alert">
                                              {{ $message }}
                                            </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <label class="form-label fs-16px  mb-1">Last Name<span
                                                                class="text-danger">*</span></label>
                                                    <input wire:model.defer="customer.last_name" type="text"
                                                           class="only-name form-control form-control-sm  @error('customer.last_name') is-invalid @enderror"
                                                           {{--                                                   {{ $customer['is_verified'] == 't' ? 'readonly':'' }}--}}
                                                           placeholder="Last Name">
                                                    @error('customer.last_name')
                                                    <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <label class="form-label fs-16px  mb-1">Email<span
                                                                class="text-danger">*</span></label>
                                                    <input
                                                            disabled value="{{ $customer['email'] }}"
                                                            type="email"
                                                            class=" fs-16px form-control form-control-sm  @error('customer.email') is-invalid @enderror"
                                                            placeholder="Email">
                                                    @error('customer.email')
                                                    <span class="invalid-feedback" role="alert">
                                          {{ $message }}
                                            </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-sm-4 mt-3">
                                                    <label for="birthDate" class="form-label fs-16px  mb-1">Date of
                                                        Birth<span
                                                                class="text-danger">*</span></label>
                                                    <div class="position-relative">
                                                        <input wire:model.defer="customer.dob" id="birthDate"
                                                               type="date"
                                                               class=" form-control form-control-sm  @error('customer.dob') is-invalid @enderror"
                                                               {{--                                                       {{ $customer['is_verified'] == 't' ? 'readonly':'' }}--}}
                                                               placeholder="Date of Birth">

                                                        @error('customer.dob')
                                                        <span class="invalid-feedback" role="alert">
                                                       {{ $message }}
                                                       </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4 mt-3">

                                                    <label class="form-label fs-16px  mb-1">Mobile Number<span
                                                                class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                <span class="input-group-text fs-14px"
                                                      id="basic-addon1">
                                                    {{ $customer['phone_code'] }}
                                                </span>
                                                        <input type="text"
                                                               value="{{$customer['phone']}}"
                                                               class="form-control only-just-numbers form-control-sm  @error('customer.phone') is-invalid @enderror"
{{--                                                               wire:model.defer="customer.phone"--}}
                                                               placeholder="Mobile number">
                                                        @error('customer.phone')
                                                        <span class="invalid-feedback" role="alert">
                                                   {{ $message }}
                                                     </span>
                                                        @enderror
                                                    </div>


                                                </div>
                                                <div class="col-12 col-sm-4 mt-3">
                                                    <label for="gender" class="form-label  fs-16px mb-1">Gender<span
                                                                class="text-danger">*</span></label>
                                                    <select wire:model.defer="customer.gender"
                                                            {{--                                                    {{ $customer['is_verified'] == 't' ? 'readonly':'' }} --}}
                                                            class="form-control form-control-sm @error('customer.gender') is-invalid @enderror "
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
                                                <div class="col-xs-12 col-sm-4">

                                                    <label class="form-label   fs-16px mb-1">Nationality<span
                                                                class="text-danger">*</span></label>

                                                    <select wire:model.defer="customer.nationality_country_id"
                                                            {{--                                                    {{ $customer['is_verified'] == 't' ? 'readonly':'' }} --}}
                                                            class="form-control form-control-sm  @error('customer.nationality_country_id') is-invalid @enderror ">
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
                                                <div class="col-xs-12 col-sm-4">

                                                    <label class="form-label  fs-16px  mb-1">Place of Birth<span
                                                                class="text-danger">*</span></label>
                                                    <select wire:model.defer="customer.place_of_birth"
                                                            class="only-name form-control-sm   form-control @error('customer.place_of_birth') is-invalid @enderror"
                                                            {{--                                                    {{ $customer['is_verified'] == 't' ? 'readonly':'' }}--}}
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
                                                <div class="col-12 col-sm-4">
                                                    <label for="occupation"
                                                           class="form-label fs-16px  mb-1">Occupation<span
                                                                class="text-danger">*</span></label>
                                                    <select wire:model.defer="customer.occupation_id"
                                                            {{--                                                    {{ $customer['is_verified'] == 't' ? 'readonly':'' }} --}}
                                                            class="form-control form-control-sm  @error('customer.occupation_id') is-invalid @enderror">
                                                        <option value="">Choose Occupation</option>
                                                        @foreach($oc_data as $n)
                                                            <option value="{{ $n['id'] }}">{{ $n['name'] }}</option>
                                                        @endforeach
                                                    </select>

                                                    @error('customer.occupation_id')
                                                    <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                                    @enderror


                                                </div>
                                                <div class="col-12 col-sm-12 mt-5">
                                                    <h4 class="mt-4 fw-bold">Address</h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-4 mt-3">
                                                    <label class="form-label mb-1">House No</label>
                                                    <input wire:model.defer="customer.house_no" type="text"
                                                           class="only-alphanum form-control form-control-sm  @error('customer.house_no') is-invalid @enderror "
                                                           {{--                                                   {{ $customer['is_verified'] == 't' ? 'readonly':'' }}--}}
                                                           placeholder="House No # ">
                                                    @error('customer.house_no')
                                                    <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-sm-4 mt-3">
                                                    <label class="form-label mb-1">Street</label>
                                                    <input wire:model.defer="customer.street_name" type="text"
                                                           class="only-alphanum form-control form-control-sm  @error('customer.street_name') is-invalid @enderror"
                                                           {{--                                                   {{ $customer['is_verified'] == 't' ? 'readonly':'' }}--}}
                                                           placeholder="Street Address">
                                                    @error('customer.street_name')
                                                    <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-sm-4 mt-3">
                                                    <label class="form-label mb-1">Post Code</label>
                                                    <input wire:model.defer="customer.postal_code" type="text"
                                                           class="only-alphanum form-control form-control-sm  @error('customer.postal_code') is-invalid @enderror"
                                                           {{--                                                   {{ $customer['is_verified'] == 't' ? 'readonly':'' }}--}}
                                                           oninput="this.value = this.value.toUpperCase()"
                                                           placeholder="Post Code">
                                                    @error('customer.postal_code')
                                                    <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                                    @enderror
                                                </div>
                                                <div class="col-xs-12 col-sm-4 mt-3">

                                                    <label class="form-label mb-1">City</label>
                                                    <input wire:model.defer="customer.city_name" type="text"
                                                           class="only-name form-control form-control-sm  @error('customer.city_name') is-invalid @enderror"
                                                           {{--                                                   {{ $customer['is_verified'] == 't' ? 'readonly':'' }}--}}
                                                           placeholder="City Name">
                                                    @error('customer.city_name')
                                                    <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                                    @enderror

                                                </div>
                                                <div class="col-xs-12 col-sm-4 mt-3">

                                                    <label class="form-label mb-1">Country</label>
                                                    <input type="text" class="form-control form-control-sm" readonly
                                                           placeholder="Country"
                                                           value="{{ $customer['country_name'] }}"
                                                    >

                                                </div>

                                            </div>

                                            <div class="form-group  mb-3 mt-5 row">
                                                @error('cus_info')
                                                <div class="alert alert-danger mb-3 fade show d-flex justify-content-between"
                                                     role="alert">
                                                    <div>
                                                        <p class="m-0"> {{ $message }}</p>
                                                    </div>
                                                </div>
                                                @enderror


                                                @error('cus_info')
                                                <div class="alert alert-danger mb-3 fade show d-flex justify-content-between"
                                                     role="alert">
                                                    <div>
                                                        <p class="m-0"> {{ $message }}</p>
                                                    </div>
                                                </div>
                                                @enderror
                                                <div class="col-sm-12 d-grid">
                                                    <button type="submit" id="submit"
                                                            wire:loading.attr="disabled"
                                                            class="btn btn-primary shadow-none">Continue
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    @else

                                        <div class="list-group list-group-flush"  >
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col">

                                                        <!-- Heading -->
                                                        <p class="mb-0">
                                                            Customer Code
                                                        </p>

                                                        <!-- Text -->
                                                        <small class="text-gray-700 fw-light">
                                                            {{ $customer['id'] ?? null }}
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
                                                            {{ $customer['phone_code'] }} {{ $customer['phone'] }}
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

                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion card-border border-primary mb-4 " id="accordionExample"
                     style="box-shadow: 0 5px 15px #00000010">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button  @if($selected_window != 'cus_docs' && (!$details_completed['customer_docs'])) bg-gray-200  @endif "
                                    @if($selected_window != 'cus_docs' && (!$details_completed['customer_docs'])) disabled
                                    @endif
                                    {{--                            @if($transfer->sub_status == 't') style="background-color: #dc3545;color: white" @endif--}}
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                <div class="w-100 d-flex justify-content-between align-items-center ">
                                    <strong>Customer Documents Info </strong>
                                    @if($details_completed['customer_docs'])
                                        <div class="fs-14px align-middle">
                                            {{optional($this->options->where('id',$customer_documents['type'])->first())->name}}
                                            <span>&nbsp;</span>
                                        </div>

                                        <div class=" fs-14px align-middle">
                                         <span class="bg-success badge">
                                          Details Completed
                                        </span>
                                            <span>&nbsp;</span>
                                        </div>
                                    @endif
                                </div>
                            </button>
                        </h2>
                        <div id="collapseTwo"
                             class="accordion-collapse collapse @if($selected_window == 'cus_docs') show  @endif"
                             aria-labelledby="headingTwo"
                             wire:ignore.self
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body bg-white">

                                @if($details_completed['docs_found'])
                                    <span class="bg-success  badge text-white">
                                         Identification document found.
                                    </span>
                                @else
                                    <p class="fw-bold">Please add customer identification documents below:</p>
                                    <form wire:submit.prevent="validateCustomerDocs">
                                        @if(!empty($success))
                                            <div class="alert  fs-12px alert-success">
                                                <strong>Success!</strong> {{ $success }}
                                            </div>
                                        @endif
                                        @if (session()->has('success'))
                                            <div class="alert fs-12px  alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        @if(!empty($error))
                                            <div class="alert fs-12px alert-danger">
                                                <strong>oops!</strong> {{ $error }}
                                            </div>
                                        @endif

                                        <div class="form-group mb-3 mt-3 row">
                                            <label for="" class="col-sm-3 fs-16px col-form-label">Document Name<span
                                                        class="text-danger">*</span></label>
                                            <div class="col-sm-6">

                                                <select wire:model.defer="customer_documents.type"
                                                        class="form-select form-select-sm  fs-16px  @error('customer_documents.type') is-invalid @enderror">
                                                    <option value=""></option>
                                                    @foreach ($options as $o)
                                                        <option value="{{ $o->id }}">{{ $o->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('customer_documents.type')
                                                <span class="invalid-feedback" role="alert">
                                                   {{ $message }}
                                               </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group mb-3 row">
                                            <label for="" class="col-sm-3  fs-16px  col-form-label">Document No</label>
                                            <div class="col-sm-6">
                                                <input type="text" wire:model.defer="customer_documents.document_no"
                                                       class="form-control form-control-sm  fs-16px  only-alphanum  @error('customer_documents.document_no') is-invalid @enderror">
                                                @error('customer_documents.document_no')
                                                <span class="invalid-feedback" role="alert">
                                                  {{ $message }}
                                            </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group mb-3 row">
                                            <label for="" class="col-sm-3  fs-16px  col-form-label">Issuance Date<span
                                                        class="text-danger">*</span></label>
                                            <div class="col-sm-6  ">
                                                <input type="date"
                                                       class="form-control form-control-sm fs-16px    @error('customer_documents.issuance') is-invalid @enderror"
                                                       wire:model.defer="customer_documents.issuance"
                                                       placeholder="Issuance Date">
                                                @error('customer_documents.issuance')
                                                <span class="invalid-feedback" role="alert">
                                               {{ $message }}
                                             </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group mb-3 row">
                                            <label for="" class="col-sm-3  fs-16px  col-form-label">Expiry Date<span
                                                        class="text-danger">*</span></label>
                                            <div class="col-sm-6  ">
                                                <input type="date"
                                                       class="form-control form-control-sm  fs-16px   @error('customer_documents.expiry') is-invalid @enderror"
                                                       wire:model.defer="customer_documents.expiry"
                                                       placeholder="Expiry Date">
                                                @error('customer_documents.expiry')
                                                <span class="invalid-feedback" role="alert">
                                              {{ $message }}
                                              </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group mb-3 row">
                                            <label for="" class="col-sm-3 col-form-label">Front Side<span
                                                        class="text-danger">*</span></label>
                                            <div class="col-sm-6">

                                                <div class="mb-3">

                                                    <input class="form-control  form-control-sm @error('front') is-invalid @enderror"
                                                           type="file"
                                                           id="formFilefront" wire:model="front" wire:loading.remove
                                                           accept=".pdf, .jpg, .jpeg, .png, .bmp, .svg, .webp"
                                                           capture
                                                           @change="setImage">

                                                    <p wire:loading wire:target="front"
                                                       class="text-danger pt-3 btn-submit">
                                                        <i class="fa fa-spinner fa-spin"></i>
                                                    </p>


                                                    @error('front')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>


                                            </div>
                                            <div class="col-sm-6">


                                                @if ($front)
                                                    <span class="bg-success badge">
                                Document Attached
                            </span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="form-group  mb-3 row">
                                            <label for="" class="col-sm-3 col-form-label">Back Side</label>
                                            <div class="col-sm-6">


                                                <div class="mb-3">

                                                    <input class="form-control form-control-sm  @error('back') is-invalid @enderror"
                                                           type="file"
                                                           id="formFilefront" wire:model="back" wire:loading.remove
                                                           accept=".pdf, .jpg, .jpeg, .png, .bmp, .svg, .webp"
                                                           capture
                                                           @change="setImage"
                                                    >

                                                    <p wire:loading wire:target="back"
                                                       class="text-danger pt-3 btn-submit">
                                                        <i class="fa fa-spinner fa-spin"></i>
                                                    </p>
                                                    @error('back')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>


                                            </div>
                                            <div class="col-sm-6">

                                                @if ($back)
                                                    <span class="bg-success badge">
                                Document Attached
                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group mb-3 row d-none">
                                            <label for=""
                                                   class="col-sm-3 fs-16px col-form-label">Issuer Authority</label>
                                            <div class="col-sm-6">
                                                <input type="text"
                                                       wire:model.defer="customer_documents.issuer_authority"
                                                       class="form-control form-control-sm  fs-16px    @error('customer_documents.issuer_authority') is-invalid @enderror">
                                                @error('customer_documents.issuer_authority')
                                                <span class="invalid-feedback" role="alert">
                     {{ $message }}
                </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group mb-3 row">
                                            <label for=""
                                                   class="col-sm-3 fs-16px  col-form-label">Issuer Country<span
                                                        class="text-danger">*</span></label>
                                            <div class="col-sm-6">

                                                <select wire:model.defer="customer_documents.issuer_country_id"
                                                        class="form-select form-select-sm fs-16px   @error('customer_documents.issuer_country_id') is-invalid @enderror">
                                                    <option value=""></option>
                                                    @foreach ($countries as $io)
                                                        <option value="{{ $io['id'] }}">{{ $io['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                @error('customer_documents.issuer_country_id')
                                                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group  mb-3 row">

                                            <div class="col-sm-12 d-grid">

                                                <button type="submit" id="submit" wire:loading.remove
                                                        wire:target="front"
                                                        wire:loading.attr="disabled"
                                                        class="btn btn-primary shadow-none">Add Document
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion card-border border-primary mb-4" id="accordionExample"
                     style="box-shadow: 0 5px 15px #00000010">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button @if($selected_window != 'payments' && (!$details_completed['payments']) ) bg-gray-200  @endif "
                                    @if($selected_window != 'payments' && (!$details_completed['payments'])) disabled
                                    @endif
                                    {{--                            @if($transfer->sub_status == 't') style="background-color: #dc3545;color: white" @endif--}}
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                <div class="w-100 d-flex justify-content-between align-items-center ">
                                    <strong>Payment Details </strong>
                                    @if($details_completed['payments'])
                                        <div class="fs-14px align-middle">
                                            <b>Sending Amount</b> : {{$amounts['sending_amount']}}
                                            <span>&nbsp;</span>
                                        </div>

                                        <div class="fs-14px align-middle">
                                            <b> Receiving Amount </b>: {{$amounts['receive_amount']}}
                                            <span>&nbsp;</span>
                                        </div>

                                        <div class=" fs-14px align-middle">
                                         <span class="bg-success badge">
                                          Details Completed
                                        </span>
                                            <span>&nbsp;</span>
                                        </div>
                                    @endif
                                </div>
                            </button>
                        </h2>
                        <div id="collapseThree"
                             class="accordion-collapse collapse @if($selected_window == 'payments') show  @endif"
                             aria-labelledby="headingThree"
                             wire:ignore.self
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body bg-white">
                                <p class="fw-bold">Please add payment details below:</p>

                                <form wire:submit.prevent="validateSendingDetails">

                                    <div class="row g-4">

                                        <div class="col-xs-12  ">
                                            <div class="mb-3">
                                                <label class="form-label fs-16px mb-1">Source of Funds</label>
                                                <select name="" wire:model="source_of_funds"
                                                        class="form-select fs-16px  @error('source_of_funds') is-invalid @enderror">
                                                    <option value="">Select</option>
                                                    @php
                                                        $sources = ['SALARY', 'SAVINGS', 'BUSINESS', 'GIFT', 'PENSION', 'BANK LOAN', 'SALES OF PROPERTY OR ASSETS'];
                                                    @endphp
                                                    @foreach (collect($sources)->sort() as $s)
                                                        <option value="{{ $s }}">{{ $s }}</option>
                                                    @endforeach
                                                </select>
                                                @error('source_of_funds')
                                                <span class="invalid-feedback fs-14px" role="alert">
                                                {{ $message }}
                                               </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group country-page" wire:ignore>
                                                <label class="form-label mb-1 " for="">You Send</label>
                                                <div class="input-group   mb-3">
                                                    <input
                                                            onclick="this.select()" type="text" autocomplete="off"
                                                            wire:model.debounce.500ms="amounts.sending_amount"
                                                            class="form-control country-calculator  only-numbers leading-zero @error('amounts.sending_amount') is-invalid @enderror"
                                                            id="youSend"
                                                            style="border: 1px solid #ced4da;"
                                                            value="" placeholder="" autocorrect="off"
                                                            autocapitalize="off">


                                                    <select wire:model="sending_iso2" id="sending"
                                                            class="form-select select-dropdown"
                                                            data-placeholder="Sending From">
                                                        <option></option>
                                                        @foreach($sending as $s)
                                                            <option data-iso2="{{ $s['iso2'] }}"
                                                                    value="{{ $s['iso2']  }}">{{ $s['currency']  }}</option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group d-none" wire:ignore>
                                                <label class="form-label mb-1  " for="">Receiving
                                                    Method</label>
                                                <select class="form-select   select-dropdown-simple"
                                                        id="receiving_method"
                                                        data-placeholder="Select" wire:model="receiving_method">
                                                    <option></option>
                                                    @foreach($receiving_methods as $s)
                                                        <option
                                                                {{ $receiving_method == $s ? 'selected' : '' }}   value="{{ $s   }}">{{ $s }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group country-page" wire:ignore>
                                                <label class="form-label  mb-1 " for="">Recipient Gets</label>
                                                <div class="input-group mb-3">
                                                    <input
                                                            onclick="this.select()" type="text" autocomplete="off"
                                                            wire:model.debounce.500ms="amounts.receive_amount"
                                                            class="form-control  country-calculator only-numbers leading-zero "
                                                            id="recipient_gets"
                                                            style="border: 1px solid #ced4da;"
                                                            value="" placeholder="" autocorrect="off"
                                                            autocapitalize="off" maxlength="10">


                                                    <select class="form-select  select-dropdown" id="receiving"
                                                            data-placeholder="Sending To" wire:model="receiving_iso2">
                                                        <option></option>
                                                        @foreach($receiving as $s)
                                                            <option data-iso2="{{ $s['iso2'] }}"
                                                                    value="{{ $s['iso2']  }}">{{ $s['currency']  }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div wire:key="select-field-model-version-{{ $iteration }}">
                                                <div class="form-group rate-select d-none" wire:ignore>
                                                    <label class="form-label mb-1  " for="">Payout
                                                        Using</label>
                                                    <select class="form-select   select-dropdown-rate" id="payout"
                                                            data-placeholder="Select" wire:model="payer_id">

                                                        @foreach($payers as $s)
                                                            <option
                                                                    data-rate="{{$s['currency']}} {{ $s['rate_after_spread'] }}"
                                                                    {{ $payer_id == $s['id'] ? 'selected' : '' }}       value="{{ $s['id']   }}">{{ $s['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            @if(!empty($selected_payer))
                                                <div class="row   ">
                                                    <div class="col-12 mt-2">

                                                        <div class="d-flex my-2 justify-content-between">
                                                            <div>
                                                                <h5 class="fw-bold m-0">
                                                                    1 {{ $high_rate['source_currency'] }}</h5>
                                                            </div>
                                                            <div>
                                                                <h5 class="fw-bold m-0"> {{ number_format($high_rate['rate_after_spread'],2) }} {{ $high_rate['currency'] }}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex my-2 justify-content-between">
                                                            <div>
                                                                <h5 class="fw-bold m-0">Fee</h5>
                                                            </div>
                                                            <div>
                                                                @if(empty($amounts['fees']))
                                                                    <span class="badge bg-success">No Fee</span>
                                                                @else
                                                                    <h5 class="fw-bold m-0"> {{ $selected_payer['source_currency'] ?? '' }} {{ number_format($amounts['fees'],2) }}</h5>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <hr>

                                                        <div class="d-flex my-2 justify-content-between">
                                                            <div>
                                                                <h3 class="fw-bold m-0">Total To Pay</h3>
                                                            </div>
                                                            <div>
                                                                <h3 class="fw-bold m-0">{{$selected_payer['source_currency'] ?? ''}} {{ number_format($amounts['total'],2) }} </h3>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex my-2 justify-content-between">
                                                            <div>
                                                                <h3 class="fw-bold m-0">Recipient Gets</h3>
                                                            </div>
                                                            <div>
                                                                <h3 class="fw-bold m-0">{{$selected_payer['currency'] ?? ''}} {{ $amounts['receive_amount'] }}</h3>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    @error('error')
                                    <div class="alert alert-danger mb-3 fade show d-flex justify-content-between"
                                         role="alert">
                                        <div>
                                            <p class="m-0"> {{ $message }}</p>
                                        </div>
                                    </div>
                                    @enderror

                                    <div class="d-grid">
                                        <button type="submit" class="btn  btn-primary mt-2 "> Continue</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion card-border border-primary mb-4" id="accordionExample"
                     style="box-shadow: 0 5px 15px #00000010">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button @if($selected_window != 'beneficiary') bg-gray-200  @endif "
                                    @if($selected_window != 'beneficiary') disabled @endif
                                    {{--                            @if($transfer->sub_status == 't') style="background-color: #dc3545;color: white" @endif--}}
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                <div class="w-100 d-flex justify-content-between ">
                                    <strong>Beneficiary Payments</strong>
                                    <div class="text-right align-middle">
                                        {{--                                <strong>  {{$transfer->transfer_code}} </strong>--}}
                                        <span>&nbsp;</span>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseFour"
                             class="accordion-collapse collapse @if($selected_window == 'beneficiary') show  @endif"
                             aria-labelledby="headingFour"
                             wire:ignore.self
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body bg-white">

                                <p class="fw-bold">Please add beneficiary details below:</p>
                                <form wire:submit.prevent="newBeneCard">
                                    @foreach($selected_beneficiary as $key => $sb)
                                        <div class="d-flex pt-3 pb-2 ps-2"
                                             style="border: 1px solid #00000010;border-radius: 10px;background-color: #f5f5f530">

                                            <div>
                                            <span role="button" wire:click="deleteBeneficiaryCard('{{$key}}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     width="26px" height="26px" style="color: gray" class=""
                                                     stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                            </span>
                                            </div>
                                            <div class="row g-2 pe-2 ps-2">
                                                <p class="fw-bold">Beneficiary
                                                    # {{$loop->iteration}}</p>
                                                <p class="fw-bold fs-14px">Personal Details:</p>

                                                @if(!empty($customer_id))
                                                    <div class="col-xs-12  ">
                                                        <div class="mb-3">
                                                            <label class="form-label fs-16px mb-1">Choose From Existing
                                                                Receivers</label>
                                                            <select name=""
                                                                    wire:model="existing_beneficiary_id.{{$key}}"
                                                                    class="form-select form-select-sm fs-16px  @error('existing_beneficiary_id'. $key) is-invalid @enderror">
                                                                <option value="">Select</option>
                                                                @foreach ($bene_data as $s)
                                                                    <option value="{{ $s['id'] }}">
                                                                        {{ $s['first_name'] . ' ' . $s['last_name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="mb-3">
                                                        <label class="form-label fs-16px  mb-1">First Name</label>
                                                        <input type="text" placeholder="First Name" autocomplete="false"
                                                               autocorrect="off" autocapitalize="off"
                                                               wire:model.defer="selected_beneficiary.{{$key}}.first_name"
                                                               class="form-control form-control-sm  fs-16px  only-name  @error('selected_beneficiary.' . $key . '.first_name') is-invalid @enderror">

                                                        @error('selected_beneficiary.' . $key . '.first_name')
                                                        <span class="invalid-feedback fs-14px" role="alert">
                                                    {{ $message }}
                                                </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="mb-3">
                                                        <label class="form-label fs-16px  mb-1">Last Name</label>
                                                        <input type="text" placeholder="Last Name" autocomplete="false"
                                                               autocorrect="off" autocapitalize="off"
                                                               wire:model.defer="selected_beneficiary.{{$key}}.last_name"
                                                               class="form-control fs-16px form-control-sm  only-name  @error('selected_beneficiary.' . $key . '.last_name') is-invalid @enderror">
                                                        @error('selected_beneficiary.' . $key . '.last_name')
                                                        <span class="invalid-feedback fs-14px" role="alert">
                                                    {{ $message }}
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 ">
                                                    <div class="mb-3">
                                                        <label class="form-label   fs-12px mb-1">Phone</label>
                                                        <div class="input-group mb-3">
                                                <span
                                                        class="input-group-text fs-12px">
                                                    {{ $selected_beneficiary[$key]['code'] ?? '' }}
                                                </span>
                                                            <input type="text"
                                                                   class="form-control form-control-sm only-just-numbers fs-16px   @error('selected_beneficiary.' . $key . '.phone') is-invalid @enderror"
                                                                   wire:model.defer="selected_beneficiary.{{$key}}.phone"
                                                                   placeholder="Phone number">
                                                            @error('selected_beneficiary.' . $key . '.phone')
                                                            <span class="invalid-feedback fs-14px" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="mb-3">
                                                        <label class="form-label fs-16px  mb-1">Your
                                                            Relationship</label>
                                                        <select name=""
                                                                wire:model="selected_beneficiary.{{$key}}.relationship_id"
                                                                class="form-select form-select-sm @error('selected_beneficiary.' . $key . '.relationship_id') is-invalid @enderror">
                                                            <option value="">Select</option>
                                                            @foreach ($rl_data as $s)
                                                                <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('selected_beneficiary.' . $key . '.relationship_id')
                                                        <span class="invalid-feedback fs-14px" role="alert">
                                                    {{ $message }}
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 mb-2">
                                                    <div class="mb-3">
                                                        <label class="form-label fs-16px  mb-1">Sending Reason</label>
                                                        <select name=""
                                                                wire:model="selected_beneficiary.{{$key}}.selected_sending_reason"
                                                                class="form-select form-select-sm  @error('selected_beneficiary.' . $key . '.selected_sending_reason') is-invalid @enderror">
                                                            <option value="">Select</option>
                                                            @foreach ($sr_data as $s)
                                                                <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('selected_beneficiary.' . $key . '.selected_sending_reason')
                                                        <span class="invalid-feedback fs-14px" role="alert">
                                                    {{ $message }}
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <p class="fw-bold fs-14px">Bank Details:</p>

                                                @if(!empty($existing_beneficiary_id[$key]))
                                                    <div class="col-xs-12">
                                                        <div class="mb-3">
                                                            <label class="form-label fs-16px mb-1">Select Existing
                                                                Receiver Account</label>
                                                            <select name=""
                                                                    wire:model="existing_beneficiary_bank_id.{{$key}}"
                                                                    class="form-select form-select-sm fs-16px  ">
                                                                <option value="">Select</option>
                                                                @foreach ($existing_beneficiary_bank_data as $s)
                                                                    <option value="{{ $s['id'] }}">{{ $s['old_name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="mb-3">
                                                        <label class="form-label mb-1">Bank Name</label>
                                                        <select name=""
                                                                wire:model="selected_beneficiary.{{$key}}.bank_id"
                                                                class="form-select form-select-sm fs-16px @error('selected_beneficiary.' . $key . '.bank_id') is-invalid @enderror">
                                                            <option value="">Select</option>
                                                            @foreach (collect($sb_data)->sortBy('name')->toArray() as $s)
                                                                <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('selected_beneficiary.' . $key . '.bank_id')
                                                        <span class="invalid-feedback fs-14px" role="alert">
                                                    {{ $message }}
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="mb-3">
                                                        <label class="form-label fs-16px  mb-1">Account Number</label>
                                                        <input type="text" placeholder="Account Number"
                                                               autocomplete="false"
                                                               autocorrect="off" autocapitalize="off"
                                                               wire:model.defer="selected_beneficiary.{{$key}}.account_no"
                                                               class="form-control fs-16px form-control-sm  @error('selected_beneficiary.' . $key . '.account_no') is-invalid @enderror">
                                                        @error('selected_beneficiary.' . $key . '.account_no')
                                                        <span class="invalid-feedback fs-14px" role="alert">
                                                    {{ $message }}
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="mb-3">
                                                        @php
                                                            $remaining = $amounts['receive_amount'];
                                                            if(!empty($selected_beneficiary)){
                                                                $remaining = ((floatval(preg_replace("/[^0-9.]/", "", $this->amounts['receive_amount']))) - array_sum(array_column($this->selected_beneficiary, 'receiving_amount')));
                                                            }
                                                        @endphp
                                                        <div class="d-flex justify-content-between">
                                                        <label class="form-label fs-16px  mb-1">Receiving Amount
                                                            (NGN) </label>

                                                            <label class="form-label fs-14px  mb-1">Remaining</label>
                                                        </div>
                                                        <div class="input-group">
                                                        <input type="number" placeholder="Receiving Amount"
                                                               autocomplete="false"
                                                               autocorrect="off" autocapitalize="off"
                                                               wire:model.lazy="selected_beneficiary.{{$key}}.receiving_amount"
                                                               class="form-control fs-16px form-control-sm  @error('selected_beneficiary.' . $key . '.receiving_amount') is-invalid @enderror">

                                                            <div class="input-group-append ">
                                                                <span class="input-group-text fs-14px" style="border-bottom-left-radius: 0; border-top-left-radius: 0 " >{{$remaining}}</span>
                                                            </div>
                                                            @error('selected_beneficiary.' . $key . '.receiving_amount')
                                                            <span class="invalid-feedback fs-14px" role="alert">
                                                            {{ $message }}
                                                            </span>
                                                            @enderror
                                                            @if($remaining < 0)
                                                                <span class="text-danger fs-14px">
                                                                 You have allocated more funds than you have available!
                                                                </span>
                                                            @endif
{{--                                                        <input type="text" value="" disabled  class="form-control fs-16px form-control-sm bg-gray-200" style="width: 10%;padding: 10px 3px 10px 3px;">--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    @endforeach
                                    @error('error')
                                    <div class="alert alert-danger mb-3 fade show d-flex justify-content-between"
                                         role="alert">
                                        <div>
                                            <p class="m-0"> {{ $message }}</p>
                                        </div>
                                    </div>
                                    @enderror
                                        <div class="d-flex align-items-center mt-2 fs-14px">
                                            <button class="btn btn-sm btn-outline-primary"
                                                    style="padding: 5px 9px 5px 9px">
                                                <span> +</span>
                                                <span class="fs-14px p-0">Add Beneficiary</span>
                                            </button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group  mb-3 mt-5 row">
                    <form wire:submit.prevent="saveRequestForm">
                        <div class="col-sm-12 d-grid">

                            @error('request_form')
                            <div class="alert alert-danger mb-3 fade show d-flex justify-content-between"
                                 role="alert">
                                <div>
                                    <p class="m-0"> {{ $message }}</p>
                                </div>
                            </div>
                            @enderror
                            <div class="d-flex gap-2 ps-2 pe-4">
                                <div class="col-6 ">
                                    <a href="{{'/paymentrequest'}}"
                                            wire:loading.attr="disabled"
                                            class="btn btn-danger shadow-none w-100">Reset Form
                                    </a>
                                </div>
                                <div class="col-6">
                                    <button type="submit" id="submit"
                                            wire:loading.attr="disabled"
                                            class="btn btn-primary shadow-none w-100">Submit Request Form
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('open-accord', event => {
            if (event.detail.id === 'collapseTwo') {
                $('#collapseOne').removeClass('show');
            }
            if (event.detail.id === 'collapseThree') {
                $('#collapseTwo').removeClass('show');
            }
            if (event.detail.id === 'collapseFour') {
                $('#collapseThree').removeClass('show');
            }

            $('#' + event.detail.id).addClass('show');
        });
    </script>
</div>

