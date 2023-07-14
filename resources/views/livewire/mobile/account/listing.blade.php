<div id="appCapsule">


    <div class="d-flex flex-column justify-content-center align-items-center mt-3">
        <div class="image-wrapper text-center">
            <img src="{{ asset('mobile/assets/img/roze-icon.png') }}" alt="image"
                 class="imaged   rounded">
        </div>
        <div>
            <p class="fw-bold fs-32px text-center mt-3 mb-1 text-full-black">{{ session('name') }}</p>
            <p class="fs-18px text-full-black  text-center ">Customer
                Code: {{ str_pad(session('customer_id'), 6, '0', STR_PAD_LEFT) }}</p>
        </div>
    </div>



    <ul class="listview image-listview text inset mt-5">
        <li class="account-listing">
            <a href="{{ url('mobile/profile') }}" class="item profile-account-listing">
                <div class="in">
                    <div class="fs-16px">Personal Details</div>
                </div>
            </a>
        </li>
        <li class="account-listing">
            <a href="{{ url('mobile/address') }}" class="item profile-account-listing">
                <div class="in">
                    <div class="fs-16px">Address Details</div>
                </div>
            </a>
        </li>
        <li class="account-listing">
            <a href="{{ url('mobile/change-password') }}" class="item profile-account-listing">
                <div class="in">
                    <div  class="fs-16px">Update Password</div>
                </div>
            </a>
        </li>
    </ul>


</div>
