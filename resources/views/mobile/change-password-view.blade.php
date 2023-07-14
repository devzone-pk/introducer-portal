@extends('mobile.layout.master')

@section('title') Password View @endsection

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
            Profile
        </div>
        <div class="right">

        </div>
    </div>


    <div id="appCapsule">
        <div class="px-3 mt-4">
            <p class="fs-20px text-full-black fw-bold">Password</p>
            <ul class="listview profile-listview image-listview">
                <li class="profile-list">
                    <a href="#" class="item">

                        <div class="in">
                            <div>
                                <p class="fs-16px mb-0">{{ session('email') }}</p>
                                <p class="fs-16px m-0 text-muted">Email</p>
                            </div>

                        </div>
                    </a>
                </li>
                <li class="profile-list">
                    <a href="#" class="item">
                        <div class="in">
                            <div>

                                <p class="fs-16px mb-0">********</p>
                                <p class="fs-16px m-0 text-muted">Password</p>

                            </div>
                        </div>
                    </a>
                </li>


            </ul>
        </div>
        <div class="form-button-group padding-bottom-100">
            <a href="{{ url('mobile/change-password') }}" class="btn btn-danger py-4 btn-block btn-lg">Update Password</a>
        </div>
    </div>
    @include('inner.partials.bottom-menu')

@endsection
