<div id="appCapsule">

    @include('mobile.include.work-time-alert',['margin' => true])

    <div class="section  ">
        <ul class="nav nav-tabs capsuled" role="tablist">
            <li class="nav-item">
                <a   class="nav-link success-tab " data-bs-toggle="tab" href="#amounts" role="tab">
                    <p class="mb-1 d-flex justify-content-between align-items-center fw-normal align-middle fs-10px">
                        <span>STEP 01</span>

                        <span class="">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.77289 9.07333L7.22909 10.5456L11.5683 6.11377" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <circle cx="8.5" cy="8.5" r="7.5" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg>
                                </span>

                    </p>
                    <div>
                        TRANSACTION<br>
                        DETAILS
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a   class="nav-link success-tab   " data-bs-toggle="tab" href="#beneficiary" role="tab">
                    <p class="mb-1 fw-normal d-flex justify-content-between align-items-center fs-10px">
                        <span>STEP 02</span>

                        <span class="">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.77289 9.07333L7.22909 10.5456L11.5683 6.11377" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <circle cx="8.5" cy="8.5" r="7.5" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg>
                                </span>
                    </p>
                    <div>
                        RECEIVER<br>
                        DETAILS
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a   class="nav-link  success-tab " data-bs-toggle="tab" href="#confirm" role="tab">
                    <p class="mb-1 fw-normal d-flex justify-content-between align-items-center fs-10px">
                        <span>STEP 03</span>
                        <span class="">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.77289 9.07333L7.22909 10.5456L11.5683 6.11377" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <circle cx="8.5" cy="8.5" r="7.5" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg>
                                </span>
                    </p>
                    <div>
                        CONFIRM<br>
                        &amp; SEND
                    </div>
                </a>
            </li>
        </ul>




        <div class="text-center mt-4">

            <svg width="85" height="85" viewBox="0 0 85 85" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M27.7725 45.5953L35.636 53.5455L59.0679 29.6136" stroke="#42BA96" stroke-width="3"
                      stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="42.5" cy="42.5" r="40.5" stroke="#42BA96" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round"/>
            </svg>


            <p class="fs-20px mt-3 fw-bold">
                Your transaction is being processed
            </p>
            <p class="   text-gray fw-bold">
                Transaction Code: {{ $transfer->transfer_code }}
            </p>

            <p>
                Thank you for using {{ config('app.company_name') }}!
            </p>





        </div>





    </div>


</div>
