<div>
    <div class="  px-3 mb-5 mt-3">

        <p class="fs-20px text-full-black fw-bold">Add a Ticket</p>
        <div class="rounded bg-white shadow-c form-padding">
            <form wire:submit.prevent="submitComplaint">


                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <div
                                class="d-flex form-control justify-content-between pe-2 align-items-center @error('type.id') is-invalid @enderror"
                                role="button"
                                wire:click.prevent="ctOpenModel('type','0')">
                                    <span
                                            class="{{ empty($type['id']) ? 'text-placeholder' : '' }} ">{{ empty($type['id']) ? 'Type' : $type['name']  }}</span>

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17 9.5L14.5 12L12 14.5L7 9.5" stroke="#85a555" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7 9.5L12 14.5L14.5 12" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        </div>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">

                        <div
                                class="d-flex form-control justify-content-between pe-2 align-items-center @error('transfer.id') is-invalid @enderror"
                                role="button"
                                wire:click.prevent="ctxOpenModel('transfer','0')">
                                    <span
                                            class="{{ empty($transfer['id']) ? 'text-placeholder' : '' }} ">{{ empty($transfer['id']) ? 'Transaction Code' : $transfer['transfer_code']. ' - '. $transfer['beneficiary_name']  }}</span>

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17 9.5L14.5 12L12 14.5L7 9.5" stroke="#85a555" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7 9.5L12 14.5L14.5 12" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        </div>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">

                            <textarea
                                    class="form-control only-alphanum   @error('message') is-invalid @enderror"

                                    wire:model.defer="message" placeholder="Message"
                                    cols="30" rows="5"></textarea>
                    </div>
                </div>


                <div class="mt-2 transparent">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                    <span wire:loading wire:target="addTicket">
                        <span class="spinner-grow spinner-grow-sm me-05" role="status" aria-hidden="true"></span>
                    </span>
                        Create Ticket
                    </button>
                </div>

            </form>
        </div>
    </div>


    <div class="toast-box toast-bottom bg-success  {{ !empty($success) ? 'show' :'' }}">
        <div class="in">
            <div class="text">
                {{ $success }}
            </div>
        </div>
        <button type="button"
                class="btn btn-sm btn-text-light close-button">OK
        </button>
    </div>
    <div class="toast-box toast-bottom bg-warning  {{ !empty($alert) ? 'show' :'' }}">
        <div class="in">
            <div class="text">
                {{ $alert }}
            </div>
        </div>
        <button type="button"
                class="btn btn-sm btn-text-light close-button">OK
        </button>
    </div>


    @include('inner.partials.modals.complain-types')
    @include('inner.partials.modals.customer-transfer')
    @include('mobile.messages.error-messages')

</div>
