<div>
    <form wire:submit.prevent="register">

        <div class="mb-3">
            <label for="emailAddress" class="form-label">Email Address</label>
            <input type="email" class="form-control  @error('email') is-invalid @enderror" wire:model.defer="email" id="emailAddress" required
                   placeholder="Enter Your Email">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="loginPassword" class="form-label">Password</label>
            <input type="password" wire:model.defer="password" class="form-control  @error('password') is-invalid @enderror" id="loginPassword" required
                   placeholder="Enter Password">
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Sending Country</label>
            <select class=" form-select  @error('country') is-invalid @enderror" wire:model.defer="country" required>
                <option value="">Choose Country</option>
                @foreach($countries as $c)
                    <option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
                @endforeach
            </select>
            @error('country')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

        </div>


        @if(!empty($title))

            <div class="alert alert-success mb-3" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p>{{ $title }}</p>
                <hr>
                <p class="mb-0">{{ $description }}</p>
            </div>
        @endif

        @if(!empty($error))
            <div class="alert alert-danger mb-3">{{ $error }}</div>
        @endif
        <div class="d-grid mt-4 mb-3">
            <button class="btn btn-primary" type="submit">Sign Up</button>
        </div>
    </form>
</div>
