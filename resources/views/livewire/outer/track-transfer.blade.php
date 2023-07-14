<div class="col-12 col-md-6">
    <form wire:submit.prevent="search">
        <h2 class="   text-center">Track Your Transaction</h2>
        <div class="form-group my-5">
            <input type="text" wire:model.defer="transfer_code"
                   class=" @error('transfer_code') is-invalid @enderror form-control bg-light"
                   placeholder="Transfer Code">
        </div>
        <div class="m-0">
            @if(!empty($success))
                <div class="alert alert-success">
                    {{ $success }} <strong>{{ $success_status }}</strong>
                </div>
            @endif

            @if(!empty($error))
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endif
        </div>
        <div class="mx-auto d-grid " style="width: 170px;">
            <button class="btn   btn-secondary shadow lift" type="submit">
                Track Now <i class="fe fe-arrow-right d-none d-md-inline "></i>
            </button>
        </div>

    </form>

</div>
