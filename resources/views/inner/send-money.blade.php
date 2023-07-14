@extends('inner.layouts.master')


@section('title') Send Money @endsection

@section('content')
    <main class="pb-8 pb-md-11 pt-5">
        <div class="container-md">
            <div class="row">
                <div class="col-12">
{{--                    <div class="alert alert-danger">--}}
{{--                        Dear valued customer,--}}
{{--<br>--}}
{{--                        We apologize for the inconvenience. Our website is currently undergoing scheduled maintenance to improve your browsing experience. We'll be back online shortly. Thank you for your patience.--}}

{{--                    </div>--}}
                    @livewire('inner.send-money',['request'=>request()->json()->all(),'redirect'=>'web'])
                </div>
            </div>
        </div>
    </main>



@endsection
