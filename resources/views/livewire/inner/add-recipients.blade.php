<div class="row g-3">

    @livewire('inner.sidebar')
    <div class="col-md-9 col-12">
    <div class="card card-border border-primary shadow-light-lg mb-6">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <!-- Heading -->
                    <h4 class="mb-0">
                        Add New Receiver
                    </h4>
                </div>

            </div>
        </div>
        <div class="card-body ">
            @if(!empty($success))
                <div class="alert fs-14px alert-success"
                     role="alert">{{$success}}</div>
            @endif

            <div class=" mb-5 section  p-2  ">
                <form wire:submit.prevent="addNew">
                    <div class="row">


                        <div class="col-12 col-sm-6">
                            <label class="form-label fs-16px mb-1">First Name<span class="text-danger">*</span></label>
                            <input wire:model.defer="first_name" type="text"
                                   class="only-name  fs-16px form-control  @error('first_name') is-invalid @enderror"
                                   placeholder="First Name">
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label fs-16px  mb-1">Last Name<span class="text-danger">*</span></label>
                            <input wire:model.defer="last_name" type="text"
                                   class="only-name  fs-16px form-control @error('last_name') is-invalid @enderror"
                                   placeholder="Last Name">
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                            @enderror
                        </div>


                        <div class="col-xs-12 col-sm-6 mt-3">

                            <label class="form-label   fs-16px mb-1">Receiver Country<span
                                        class="text-danger">*</span></label>

                            <select wire:model="country"
                                    class="form-control fs-16px @error('country') is-invalid @enderror ">
                                <option value="">Choose Country</option>
                                @foreach($rc_data as $n)
                                    <option value="{{ $n['id'] }}">{{ $n['name'] }}</option>
                                @endforeach
                            </select>

                            @error('country')
                            <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                            @enderror

                        </div>


                        <div class="col-12 col-sm-6 mt-3">

                            <label class="form-label fs-16px  mb-1">Phone<span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">{{$code}}</span>

                                <input type="text" class="form-control only-just-numbers @error('phone') is-invalid @enderror"
                                       wire:model.defer="phone"
                                       placeholder="Phone number">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                                @enderror
                            </div>


                        </div>

                        <div class="col-xs-12 col-sm-6 mt-3">

                            <label class="form-label   fs-16px mb-1"> Relationship<span
                                        class="text-danger">*</span></label>

                            <select wire:model.defer="relation"
                                    class="form-control fs-16px @error('relation') is-invalid @enderror ">
                                <option value="">Choose Relationship</option>
                                @foreach($rl_data as $d)
                                    <option value="{{ $d['id'] }}">{{ $d['name'] }}</option>
                                @endforeach
                            </select>

                            @error('relation')
                            <span class="invalid-feedback" role="alert">
                              {{ $message }}
                               </span>
                            @enderror

                        </div>

                        <div class="col-12">
                        <div class="row">
                            <div class="col-6 mt-5 d-grid">
                                <a href="{{url('recipients')}}" class="btn btn-light shadow-none">
                                    Back
                                </a>
                            </div>
                            <div class="col-6 mt-5 d-grid">
                                <button class="btn btn-primary shadow-none" type="submit">Add
                                </button>
                            </div>
                        </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>


</div>
</div>
