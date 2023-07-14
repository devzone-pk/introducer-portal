<div id="appCapsule">
    <div class="px-3 mt-4">
        <p class="fs-20px text-full-black fw-bold">Address Details</p>
        <ul class="listview profile-listview image-listview">
            <li class="profile-list">
                <a href="#" class="item">

                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ $customer['house_no'] }}</p>
                            <p class="fs-16px m-0 text-muted">House #</p>
                        </div>

                    </div>
                </a>
            </li>
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ $customer['street_name'] }}</p>
                            <p class="fs-16px m-0 text-muted">Street</p>
                        </div>
                    </div>
                </a>
            </li>
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ $customer['postal_code'] }}</p>
                            <p class="fs-16px m-0 text-muted">Postal Code</p>
                        </div>
                    </div>
                </a>
            </li>
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ $customer['city_name'] }}</p>
                            <p class="fs-16px m-0 text-muted">City</p>
                        </div>
                    </div>
                </a>
            </li>


            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ session('country_name') }}</p>
                            <p class="fs-16px m-0 text-muted">Country</p>
                        </div>
                    </div>
                </a>
            </li>

        </ul>
    </div>


    <div class="form-button-group padding-bottom-100">
        <a href="{{ url('mobile/address') }}" class="btn btn-danger py-4 btn-block btn-lg">Edit</a>
    </div>
</div>
