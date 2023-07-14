@extends('mobile.layout.master')

@section('title') Transfer Details @endsection

@section('content')

    <div class="appHeader">
        <div class="left">
            <a href="{{ url('mobile/dashboard') }}" class="headerButton goBack">
                <img src="{{asset('icons/left-arrow.png')}}" style="width: 30px;" alt="">
            </a>
        </div>
        <div class="pageTitle">Transfer Details</div>

    </div>
    <div id="appCapsule" class="full-height bg-white">

        <div class="section mt-2 mb-2">


            <div class="listed-detail mt-3">
                <div class="icon-wrapper">
                    <div class="iconbox">
                        <ion-icon name="checkmark-outline"></ion-icon>
                    </div>
                </div>
                <h3 class=" mt-2 mb-0">Transfer Details</h3>
            </div>

            <ul class="listview flush transparent simple-listview no-space mt-1">
                <li>
                    <strong>Transfer Code</strong>
                    <h3 class="m-0">{{ optional($details)->transfer_code }}</h3>
                </li>
                <li>
                    <strong>Status</strong>
                    <span class="badge badge-success">{{ optional($details)->paymentStatus->secondary_name }}</span>
                </li>
                <li>
                    <strong>Receiver</strong>
                    <span>{{ optional($details->beneficiary)->first_name }} {{ optional($details->beneficiary)->last_name }}</span>
                </li>
                <li>
                    <strong>Sending Amount</strong>
                    <span>{{ optional($details)->sending_currency }} {{ number_format(optional($details)->sending_amount,2) }}</span>
                </li>
                <li>
                    <strong>Rate: 1 {{ optional($details)->sending_currency }} </strong>
                    <span>{{ optional($details)->customer_rate }} {{ optional($details)->receiving_currency }}</span>
                </li>
                <li>
                    <strong>Recipient Gets</strong>
                    <span>
                        @if(!empty(optional($details)->receiving_amount))

                            {{ number_format(optional($details)->receiving_amount,2) }} {{ optional($details)->receiving_currency }}
                        @endif
                    </span>
                </li>
                <li>
                    <strong>Date & Time</strong>
                    <span>{{ date('d M, Y h:i A',strtotime($details->created_at)) }}</span>
                </li>

            </ul>


        </div>

    </div>

    @include('inner.partials.bottom-menu')

@endsection

