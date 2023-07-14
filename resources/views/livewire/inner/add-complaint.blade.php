<div class="row g-3">
    @livewire('inner.sidebar')

    <div class="col-md-9 col-12">
        <div class="card card-border border-primary shadow-light-lg mb-6">
            <div class="card-header px-5">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Heading -->
                        <h4 class="mb-0">
                            Add a Ticket
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-info px-5 py-1" href="{{ url('customer-support') }}">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body px-5">
                <form wire:submit.prevent="submitComplaint">

                    @if($success)
                        <div class="alert fs-12px alert-success" role="alert">
                            {{ $success }}
                        </div>
                    @elseif($error)
                        <div class="alert fs-12px  alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert  fs-12px alert-danger">
                            @foreach($errors->all() as $e)
                                <p class="m-0">{{ $e }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="mb-2">
                        <label for="complaint_type" class="form-label"> Type</label>
                        <select wire:model.debounce.500ms="complaint.complain_type" class="form-control"
                                id="complaint_type"
                                name="complaint_type">
                            <option value="">Select your option</option>
                            @foreach($options as $option)
                                <option value="{{ $option->id }}">{{ $option->name }}</option>
                            @endforeach
                        </select>
                        @error('complain_type') <span class="text text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4 mt-4">
                        <label for="sender_name" class="form-label">Sender Name</label>
                        <input type="text" class="form-control" value="{{ session('name') }}"
                               id="sender_name"
                               placeholder="Sender Name" disabled>
                    </div>
                    @if($show_payment_type)
                        <div class="mt-4">
                            <label for="payment" class="form-label">Payment Number</label>
                            <select wire:model.defer="complaint.payment_number" class="form-control" id="payment"
                                    name="payment_number">
                                <option>Select Payment Number</option>
                                @foreach($payment_types as $payment_type)
                                    <option value="{{ $payment_type->id }}">
                                        {{ $payment_type->transfer_code . ' ' }}
                                        -{{ ' ' . $payment_type->beneficiary_name . ' ' }}
                                        -{{ ' ' . $payment_type->receiving_amount }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="mt-4">
                        <label for="message" class="form-label">Message</label>
                        <textarea wire:model.defer="complaint.message" class="form-control"
                                  placeholder="Enter your message here."
                                  id="message"
                                  rows="5"></textarea>
                    </div>
                    <div class="row">

                        <div class="mt-4 d-grid">
                            <button class="btn btn-primary shadow-none" type="submit">
                                Create
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>


    </div>
</div>