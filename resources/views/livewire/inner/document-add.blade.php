<div class="row g-3">

    @livewire('inner.sidebar')
    <div class="col-md-9 col-12">
        <div class="card card-border border-primary shadow-light-lg mb-6">
            <div class="card-header px-5">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Heading -->
                        <h4 class="mb-0">
                            Add New Document
                        </h4>
                    </div>

                </div>
            </div>
            <div class="card-body px-4">

                @if($incomplete_profile)
                    <div class="alert alert-warning">
                        Identity documents not found. Please add identity document to make transaction.
                    </div>
                @endif


                <form wire:submit.prevent="add">
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


                    <div class="form-group mb-3 row">
                        <label for="" class="col-sm-3 fs-16px col-form-label">Document Type<span
                                    class="text-danger">*</span></label>
                        <div class="col-sm-6">

                            <select wire:model="doc_type"
                                    class="form-select  fs-16px  @error('doc_type') is-invalid @enderror">
                                <option value=""></option>
                                @foreach ($document_types as $dt)
                                    <option value="{{ $dt['secondary_name'] }}">{{ $dt['secondary_name'] }}</option>
                                @endforeach
                            </select>
                            @error('doc_type')
                            <span class="invalid-feedback" role="alert">
                      {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label for="" class="col-sm-3 fs-16px col-form-label">Document Name<span
                                    class="text-danger">*</span></label>
                        <div class="col-sm-6">

                            <select wire:model.defer="type"
                                    class="form-select  fs-16px  @error('type') is-invalid @enderror">
                                <option value=""></option>
                                @if(!empty($doc_type))
                                    @foreach ($options as $o)
                                        <option value="{{ $o->id }}">{{ $o->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('type')
                            <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label for="" class="col-sm-3  fs-16px  col-form-label">Document No</label>
                        <div class="col-sm-6">
                            <input type="text" wire:model.defer="document_no"
                                   class="form-control  fs-16px  only-alphanum  @error('document_no') is-invalid @enderror">
                            @error('document_no')
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
                            <input type="date" class="form-control  fs-16px    @error('issuance') is-invalid @enderror"
                                   wire:model.defer="issuance"
                                   placeholder="Issuance Date">
                            @error('issuance')
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
                            <input type="date" class="form-control  fs-16px   @error('expiry') is-invalid @enderror"
                                   wire:model.defer="expiry"
                                   placeholder="Expiry Date">
                            @error('expiry')
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

                                <input class="form-control  @error('front') is-invalid @enderror" type="file"
                                       id="formFilefront" wire:model="front" wire:loading.remove
                                       accept="image/*, .pdf"
                                       capture
                                       @change="setImage">

                                <p wire:loading wire:target="front" class="text-danger pt-3 btn-submit">
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

                                <input class="form-control  @error('back') is-invalid @enderror" type="file"
                                       id="formFilefront" wire:model="back" wire:loading.remove
                                       accept="image/*, .pdf"
                                       capture
                                       @change="setImage"
                                >

                                <p wire:loading wire:target="back" class="text-danger pt-3 btn-submit">
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
                            <input type="text" wire:model.defer="issuer_authority"
                                   class="form-control  fs-16px    @error('issuer_authority') is-invalid @enderror">
                            @error('issuer_authority')
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

                            <select wire:model.defer="issuer_country_id"
                                    class="form-select fs-16px   @error('issuer_country_id') is-invalid @enderror">
                                <option value=""></option>
                                @foreach ($countries as $o)
                                    <option value="{{ $o->id }}">{{ $o->name }}</option>
                                @endforeach
                            </select>
                            @error('issuer_country_id')
                            <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                            @enderror
                        </div>
                    </div>


                    {{--                <div class="form-group mb-3 row d-none">--}}
                    {{--                    <label for="" class="col-sm-3 col-form-label">Issuer City</label>--}}
                    {{--                    <div class="col-sm-6">--}}

                    {{--                        <select wire:model.defer="issuer_city_id"--}}
                    {{--                                class="form-select form-select-sm  @error('issuer_city_id') is-invalid @enderror">--}}
                    {{--                            <option value=""></option>--}}
                    {{--                            @foreach ($cities as $o)--}}
                    {{--                                <option value="{{ $o->id }}">{{ $o->name }}</option>--}}
                    {{--                            @endforeach--}}
                    {{--                        </select>--}}
                    {{--                        {{ $issuer_city_id }}--}}
                    {{--                        @error('issuer_city_id')--}}
                    {{--                        <span class="invalid-feedback" role="alert">--}}
                    {{--                    <strong>{{ $message }}</strong>--}}
                    {{--                </span>--}}
                    {{--                        @enderror--}}
                    {{--                    </div>--}}
                    {{--                    <div class="col-sm-6">--}}
                    {{--                        <p wire:loading>--}}
                    {{--                            Loading...--}}
                    {{--                        </p>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}


                    <div class="form-group  mb-3 row">

                        <div class="col-sm-12 d-grid">

                            <button type="submit" id="submit" wire:loading.remove wire:target="front"
                                    wire:loading.attr="disabled"
                                    class="btn btn-primary shadow-none">Add Document
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
