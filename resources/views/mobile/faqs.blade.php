@extends('mobile.layout.master')

@section('title') FAQs @endsection

@section('content')

    <div class="appHeader">
        <div class="left">
            <a href="{{ url('mobile/account') }}" class="headerButton goBack">
                <img src="{{asset('icons/left-arrow.png')}}" style="width: 30px;" alt="">
            </a>
        </div>
        <div class="pageTitle">FAQs</div>
{{--        <div class="right">--}}
{{--            <a href="#" class="headerButton">--}}
{{--                <ion-icon name="notifications-outline" role="img" class="md hydrated"--}}
{{--                          aria-label="notifications outline"></ion-icon>--}}
{{--                <div class="badge badge-danger">0</div>--}}
{{--            </a>--}}
{{--        </div>--}}
    </div>

    @livewire('mobile.account.faqs')
    @include('inner.partials.bottom-menu')
@endsection
