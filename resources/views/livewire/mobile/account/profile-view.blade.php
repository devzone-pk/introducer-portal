<div id="appCapsule">

    <div class="px-3 mt-4">
        <p class="fs-20px text-full-black fw-bold">Personal Details</p>
        <ul class="listview profile-listview image-listview">
            <li class="profile-list">
                <a href="#" class="item">

                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ str_pad(session('customer_id'), 6, '0', STR_PAD_LEFT) }}</p>
                            <p class="fs-16px m-0 text-muted">Customer Code</p>
                        </div>

                    </div>
                </a>
            </li>
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ $customer['first_name'] }} {{ $customer['last_name'] }}</p>
                            <p class="fs-16px m-0 text-muted">Name</p>
                        </div>
                    </div>
                </a>
            </li>
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">@if(!empty($customer['dob'])) {{ date('d M, Y',strtotime($customer['dob'])) }}  @endif </p>
                            <p class="fs-16px m-0 text-muted">Date of Birth </p>
                        </div>
                    </div>
                </a>
            </li>
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ $customer['phone_code'] }} {{ $customer['phone'] }}</p>
                            <p class="fs-16px m-0 text-muted">Phone</p>
                        </div>
                    </div>
                </a>
            </li>

             
            <li class="profile-list">
                <a href="#" class="item">
                    <div class="in">
                        <div>
                            <p class="fs-16px mb-0">{{ optional($customer->nationality)->nationality }}</p>
                            <p class="fs-16px m-0 text-muted">Nationality</p>
                        </div>
                    </div>
                </a>
            </li>

        </ul>
    </div>


    <div class="form-button-group padding-bottom-100">
        <a href="{{ url('mobile/profile') }}" class="btn btn-danger py-4 btn-block btn-lg">Edit</a>
    </div>
</div>
