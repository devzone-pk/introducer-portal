
<div class="appHeader">
    <div class="left">
        <a href="{{ url('mobile/account') }}" class="headerButton goBack">

            <img src="{{asset('icons/left-arrow.png')}}" style="width: 30px;" alt="">
        </a>
    </div>
    <div class="pageTitle"> Privacy Policy</div>
    {{--        <div class="right">--}}
    {{--            <a href="#" class="headerButton">--}}
    {{--                <ion-icon name="notifications-outline" role="img" class="md hydrated"--}}
    {{--                          aria-label="notifications outline"></ion-icon>--}}
    {{--                <div class="badge badge-danger">0</div>--}}
    {{--            </a>--}}
    {{--        </div>--}}
</div>
<div id="appCapsule" class="pt-0">
    <div class="section full ">

        <div class="container">

            <div class="row">

                @include('include.terms-and-conditions')

            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </div>


</div>
