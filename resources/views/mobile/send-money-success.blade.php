@extends('mobile.layout.master')
@section('title') Home @endsection
@section('content')


    <div class="appHeader  bg-secondary ">
        <div class="left">
            <a href="{{ url('mobile/dashboard') }}" class="headerButton">
                <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 2L2 9L9 16" stroke="white" stroke-width="2.4" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
        <div class="pageTitle">
            Transaction Created
        </div>
        <div class="right">
            <a href="{{ url('mobile/customer-support') }}" class="headerButton  toggle-searchbox">
                <svg width="38" height="38" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.15068 14.7672C1.56221 13.4999 1.25132 12.1214 1.25132 10.7318C1.25132 9.27552 1.57332 7.84145 2.2062 6.52967C2.83909 5.21789 3.74956 4.06174 4.8821 3.15016C6.01464 2.23859 7.33592 1.5938 8.75714 1.2603C10.1784 0.926796 11.644 0.915703 13.0763 1.21586C14.4975 1.52713 15.841 2.14965 16.9847 3.03899C18.1394 3.92833 19.0721 5.07336 19.7272 6.37402C20.3823 7.67469 20.7265 9.10876 20.7598 10.5539C20.782 12.0102 20.4822 13.4443 19.8826 14.7672"
                          stroke="#EC3439" stroke-width="1.648"/>
                    <path d="M15.5745 17.5686C14.9417 18.658 15.3192 20.0587 16.4184 20.6924C17.5176 21.326 18.9166 20.9481 19.5495 19.8586L20.6932 17.8798C21.3261 16.7904 20.9485 15.3897 19.8493 14.756C18.7501 14.1224 17.3511 14.5003 16.7182 15.5898L15.5745 17.5686Z"
                          stroke="#EC3439" stroke-width="1.648"/>
                    <path d="M5.28182 15.5898C4.64894 14.5003 3.24991 14.1224 2.15069 14.756C1.05146 15.3897 0.673955 16.7904 1.30684 17.8798L2.45048 19.8586C3.08337 20.9481 4.48237 21.326 5.5816 20.6924C6.68082 20.0587 7.05835 18.658 6.42546 17.5686L5.28182 15.5898Z"
                          stroke="#EC3439" stroke-width="1.648"/>
                </svg>

            </a>
        </div>
    </div>
    <div id="" class="mt-2">
        @livewire('mobile.send-money-success',['transfer_code' => request('transfer_code')])
    </div>
    @include('inner.partials.bottom-menu')



@endsection
