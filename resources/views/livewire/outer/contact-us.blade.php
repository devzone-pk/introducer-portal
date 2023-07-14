<div class="">

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $e)
                <p class="m-0">{{ $e }}</p>
            @endforeach
        </div>
    @endif


    @if(!empty($success))
        <div class="alert alert-success">
            {{ $success }}
        </div>
    @endif


        <form wire:submit.prevent="sendMessage">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group mb-5">

                        <!-- Label -->
                        <label class="form-label" for=" ">
                            Full name
                        </label>

                        <!-- Input -->
                        <input class="form-control"  wire:model.defer="name" type="text" placeholder="Full name">

                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group mb-5">

                        <!-- Label -->
                        <label class="form-label" for=" ">
                            Email
                        </label>

                        <!-- Input -->
                        <input class="form-control" wire:model.defer="email" type="email" placeholder="hello@domain.com">

                    </div>
                </div>
            </div> <!-- / .row -->

            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group mb-5">

                        <!-- Label -->
                        <label class="form-label" >
                            Contact #
                        </label>

                        <!-- Input -->
                        <input class="form-control" wire:model.defer="contact" type="text" placeholder="+44">

                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group mb-5">

                        <!-- Label -->
                        <label class="form-label" for=" ">
                            Preferred Time
                        </label>

                        <!-- Input -->
                        <input class="form-control" wire:model.defer="time" type="text" placeholder="13:00 PM">

                    </div>
                </div>
            </div> <!-- / .row -->
            <div class="row">
                <div class="col-12">
                    <div class="form-group mb-7 mb-md-9">

                        <!-- Label -->
                        <label class="form-label"  >
                            What can we help you with?
                        </label>

                        <!-- Input -->
                        <textarea class="form-control"  wire:model.defer="message"  rows="5" placeholder="Tell us what we can help you with!"></textarea>

                    </div>
                </div>
            </div> <!-- / .row -->
            <div class="row justify-content-center">
                <div class="col-auto">

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary lift">
                        Send message
                    </button>

                </div>
            </div> <!-- / .row -->
        </form >


</div>
