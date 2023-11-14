<div id="appCapsule">

    <div class=" px-3 mt-2">

{{--        <ul class="nav nav-tabs lined" role="tablist">--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link nav-link-faq active" data-bs-toggle="tab" href="#home11" role="tab"--}}
{{--                   aria-selected="true">--}}
{{--                    Contact Us--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link nav-link-faq" data-bs-toggle="tab" href="#profile12" role="tab"--}}
{{--                   aria-selected="false">--}}
{{--                    FAQs--}}
{{--                </a>--}}
{{--            </li>--}}

{{--        </ul>--}}
        <div class="tab-content mt-2">
            <div class="tab-pane fade active show" id="home11" role="tabpanel">
                <div class="rounded bg-white shadow-c form-padding">
                <ul class="listview profile-listview image-listview bg-white">
{{--                    <li class="profile-list">--}}
{{--                        <a target="_blank"--}}
{{--                           href="whatsapp://send?phone=+447562781703&text=Hello, {{ session('name') }} is here. My customer code {{ session('user_id') }} and email {{session('email')}}. "--}}
{{--                           class="item">--}}
{{--                            <img src="{{ asset('mobile/assets/img/icon/whatsapp1.png') }}" alt="image"--}}
{{--                                 class="image me-1 rounded-0">--}}
{{--                            <div class="in">--}}
{{--                                <div>--}}
{{--                                    <p class="fs-16px mb-0">+44 7562 781703</p>--}}
{{--                                    <p class="fs-16px m-0 text-muted">WhatsApp</p>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    <li class="profile-list">
                        <a href="tel:+447377993520" class="item">
                            <img src="{{ asset('mobile/assets/img/icon/phone1.png') }}" alt="image"
                                 class="image me-1 rounded-0">
                            <div class="in">
                                <div>
                                    <p class="fs-16px mb-0 ">+44 737 799 3520</p>
                                    <p class="fs-16px m-0 text-muted">Call Anytime</p>

                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="profile-list">
                        <a target="_blank" href="mailto: info@oriumpay.com" class="item">
                            <img src="{{ asset('mobile/assets/img/icon/email11.png') }}" alt="image"
                                 class="image me-1 rounded-0">
                            <div class="in">
                                <div>
                                    <p class="fs-16px mb-0 "> info@oriumpay.com</p>
                                    <p class="fs-16px m-0 text-muted">Email</p>

                                </div>
                            </div>
                        </a>
                    </li>
{{--                    <li class="profile-list">--}}
{{--                        <a target="_blank" href="skype:live:.cid.e8940a52cff9db59?chat" class="item">--}}
{{--                            <img src="{{ asset('mobile/assets/img/icon/skype.png') }}" alt="image"--}}
{{--                                 class="image me-1 rounded-0">--}}
{{--                            <div class="in">--}}
{{--                                <div>--}}
{{--                                    <p class="fs-16px mb-0 ">Roze Remit</p>--}}
{{--                                    <p class="fs-16px m-0 text-muted">Skype</p>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    <li class="profile-list">
                        <a href="#" class="item">
                            <img src="{{ asset('mobile/assets/img/icon/location1.png') }}" alt="image"
                                 class="image me-1 rounded-0">
                            <div class="in">
                                <div>
                                    <p class="fs-16px mb-0 ">{{ config('app.company_address') }}</p>
                                    <p class="fs-16px m-0 text-muted">Address</p>

                                </div>
                            </div>
                        </a>
                    </li>

                </ul>
                </div>
            </div>
            <div class="tab-pane fade" id="profile12" role="tabpanel">
{{--                @include('outer.includes.faqs')--}}
            </div>

        </div>


        <div class="mt-1 padding-bottom-100">
            <a href="{{ url('mobile/customer-support/add') }}" class="btn btn-primary  btn-block btn-lg">
                Open Ticket
            </a>
        </div>

    </div>
</div>
