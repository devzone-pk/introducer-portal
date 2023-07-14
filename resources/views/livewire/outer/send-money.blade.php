<div class=" ">
    <form wire:submit.prevent="proceed" class="row">
        <div class="col-12 col-md-4">
            <div class="form-group" wire:ignore>
                <label class="form-label text-color-calculator" for="">Sending From</label>
                <select wire:model="sending_id" id="sending" class="form-select select-dropdown"
                        data-placeholder="Sending From">
                    <option></option>
                    @foreach($sending as $s)
                        <option data-iso2="{{ $s['iso2'] }}" value="{{ $s['id']  }}">{{ $s['name']  }}</option>
                    @endforeach


                </select>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group" wire:ignore>
                <label class="form-label text-color-calculator" for="">Sending To</label>
                <select class="form-select select-dropdown" id="receiving"
                        data-placeholder="Sending To" wire:model="receiving_id">
                    <option></option>
                    @foreach($receiving as $s)
                        <option data-iso2="{{ $s['iso2'] }}" value="{{ $s['id']  }}">{{ $s['name']  }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="d-grid ">
                <label class="form-label mb-2 text-color-calculator" for="">&nbsp;</label>
                <button type="submit" class="btn  btn-primary">Send Now</button>
            </div>
        </div>
        <div class="alert alert-danger {{ $errors->any() ? '':'d-none' }}">
            @foreach($errors->all() as $error)
                <p class="m-0">{{ $error }}</p>
            @endforeach
        </div>


    </form>
</div>

@push('scripts')

    <script>
        $(document).ready(function () {

            $('#sending').on('change', function (e) {
                var data = $('#sending').select2("val");
                @this.
                set('sending_id', data);
            });

            $('#receiving').on('change', function (e) {
                var data = $('#receiving').select2("val");
                @this.
                set('receiving_id', data);
            });
        });
    </script>

@endpush
