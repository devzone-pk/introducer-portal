@extends('mobile.layout.master')

@section('title') Rate Calculator @endsection

@section('content')

    <div class="appHeader bg-secondary">
        <div class="left">
            <a href="{{ url('mobile/welcome') }}" class="headerButton">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 14.5L10.5 12L13 9.5" stroke="#FF885B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.95043 20.6471C6.17301 19.9956 4.00437 17.827 3.35288 15.0496C2.88237 13.0437 2.88237 10.9563 3.35288 8.95043C4.00437 6.17301 6.17301 4.00437 8.95044 3.35288C10.9563 2.88237 13.0437 2.88238 15.0496 3.35288C17.827 4.00437 19.9956 6.17301 20.6471 8.95043C21.1176 10.9563 21.1176 13.0437 20.6471 15.0496C19.9956 17.827 17.827 19.9956 15.0496 20.6471C13.0437 21.1176 10.9563 21.1176 8.95043 20.6471Z" stroke="#FF885B" stroke-width="1.5"/>
                    <path d="M8.95046 20.6471C10.9563 21.1176 13.0438 21.1176 15.0496 20.6471C17.827 19.9956 19.9957 17.827 20.6472 15.0496C21.1177 13.0437 21.1177 10.9563 20.6472 8.95043C19.9957 6.17301 17.827 4.00437 15.0496 3.35288C13.0438 2.88237 10.9563 2.88237 8.95046 3.35288C6.17304 4.00437 4.0044 6.17301 3.35291 8.95043" stroke="#0F5ABB" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </a>
        </div>
        <div class="pageTitle">
            Today's Rates
        </div>
        <div class="right">

        </div>
    </div>
    @livewire('mobile.rate-calculator')


@endsection

