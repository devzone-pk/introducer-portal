<div id="appCapsule">

    <div class=" px-3 mt-4">

        <p class="fs-20px text-full-black fw-bold">Customer Preferences</p>
        <div class="rounded bg-white shadow-c form-padding">
            <form wire:submit.prevent="preferenceUpdate">


                <ul class="listview profile-listview simple-listview bg-white">
                    <li class="p-0">
                        <div>
                            <strong>Email</strong><br>
                            <span class="fs-12px">May we contact you by email?</span>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox" name="notifications" class="form-check-input" id="customCheckd1"
                                   value="{{ $preference['email'] }}" wire:model.defer="preference.email">
                            <label class="form-check-label" for="customCheckd1"></label>
                        </div>
                    </li>
                    <li class="p-0">
                        <div>
                            <strong>Telephone</strong><br>
                            <span class="fs-12px">May we contact you by telephone?</span>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox" name="notifications" class="form-check-input" id="customCheckd2"
                                   value="{{ $preference['phone'] }}" wire:model.defer="preference.phone">
                            <label class="form-check-label" for="customCheckd2"></label>
                        </div>
                    </li>
                    <li class="p-0">
                        <div>
                            <strong>Post</strong> <br>
                            <span class="fs-12px">    May we contact you by post?</span>

                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox" name="notifications" class="form-check-input" id="customCheckd3"
                                   value="{{ $preference['post'] }}" wire:model.defer="preference.post">
                            <label class="form-check-label" for="customCheckd3"></label>
                        </div>
                    </li>
                    <li class="p-0">
                        <div>
                            <strong>SMS</strong> <br>
                            <span class="fs-12px">May we contact you by sms?</span>
                        </div>
                        <div class="form-check  form-switch">
                            <input type="checkbox" name="notifications" class="form-check-input" id="customCheckd4"
                                   value="{{ $preference['sms'] }}" wire:model.defer="preference.sms">
                            <label class="form-check-label" for="customCheckd4"></label>
                        </div>
                    </li>

                </ul>

                <div class="form-button-group padding-bottom-100">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Save</button>
                </div>
            </form>
        </div>
    </div>


    <div class="toast-box toast-top bg-success  {{ !empty($success) ? 'show' :'' }}">
        <div class="in">
            <div class="text">
                {{ $success }}
            </div>
        </div>
        <button type="button"
                class="btn btn-sm btn-text-light close-button">OK
        </button>
    </div>
</div>
