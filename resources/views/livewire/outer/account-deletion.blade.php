

<section class="">
    <div class="container">
        <div class="row align-items-center mb-5 gx-0">
            <div class="col-12">
                @if($success)
                <div class="alert alert-success" role="alert">
                    {{ $success }}
                </div>
            @endif
            

            <p>
                When you delete your Orium Pay account, we take this matter seriously and exert our utmost
                effort to erase the data referenced in the provided points linked to your account. Nevertheless,
                we are obligated to retain transaction information for a minimum of 5 years due to financial
                regulatory processes.
            </p>

            <ul>
                <li>Login Information</li>
                <li>Marketing Preferences</li>
                <li>Transaction History</li>
                <li>Cookie Policy</li>
            </ul>
                <form wire:submit.prevent="deleteAccount" class="row mb-5">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input wire:model.defer="email" type="email" id="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Your email">
                            @error('email') 
                            <span class="text-danger">{{ $message }}
                            </span> @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="reason">Reason</label>
                            <select wire:model.defer="reason" id="reason" class="form-select @error('reason') is-invalid @enderror">
                                <option value="">Select Reason</option>
                                <option value="dublicate-account">Duplicate Account</option>
                                <option value="wrong-Information">Wrong Information</option>
                                <option value="too-Many-Adds">Too Many Adds</option>
                                <option value="too-busy-too-distracting">Too busy/too distracting</option>
                                <option value="want-to-remove-something">Want to remove something</option>
                                <option value="concerned-about-my-data">Concerned about my data</option>
                                <option value="privacy-concerns">Privacy concerns</option>
                            </select>
                            @error('reason')
                             <span class="text-danger">{{ $message }}</span>
                              @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Proceed</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
