@extends('mobile.layout.master')

@section('title') Address View @endsection

@section('content')
    <div class="appHeader  bg-secondary">
        <div class="left">
            <a href="{{ url('mobile/account') }}" class="headerButton" >
                <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 2L2 9L9 16" stroke="white" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
        <div class="pageTitle">
            Address
        </div>
        <div class="right">

        </div>
    </div>


    @livewire('mobile.account.address-view')
    @include('inner.partials.bottom-menu')

@endsection
