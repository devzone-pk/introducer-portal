

    <div class="card card-bleed shadow-light-lg mb-6">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <!-- Heading -->
                    <h4 class="mb-0">
                        Customer Preference
                    </h4>
                </div>

            </div>
        </div>
        <div class="card-body ">
            <form wire:submit.prevent="preferenceUpdate">

                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Heading -->
                                <p class="mb-0">
                                    Email
                                </p>

                                <!-- Text -->
                                <small class="text-gray-700">
                                    May we contact you by email?
                                </small>

                            </div>
                            <div class="col-auto">

                                <!-- Switch -->
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="switchTwo"
                                           wire:model.defer="preference.email">
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Heading -->
                                <p class="mb-0">
                                    Telephone
                                </p>

                                <!-- Text -->
                                <small class="text-gray-700">
                                    May we contact you by telephone?
                                </small>

                            </div>
                            <div class="col-auto">

                                <!-- Switch -->
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" wire:model.defer="preference.phone">
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Heading -->
                                <p class="mb-0">
                                    Post
                                </p>

                                <!-- Text -->
                                <small class="text-gray-700">
                                    May we contact you by post?
                                </small>

                            </div>
                            <div class="col-auto">

                                <!-- Switch -->
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" wire:model.defer="preference.post">
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Heading -->
                                <p class="mb-0">
                                    SMS
                                </p>

                                <!-- Text -->
                                <small class="text-gray-700">
                                    May we contact you by sms?
                                </small>

                            </div>
                            <div class="col-auto">

                                <!-- Switch -->
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" wire:model.defer="preference.sms">
                                </div>


                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12 mt-4 d-grid">
                    <button class="btn btn-primary mt-1 shadow-none" type="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
