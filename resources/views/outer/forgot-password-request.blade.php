@extends('outer.layouts.master')

@section('content')
    <section class="section">
        <div class="container ">
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
                    <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
                        <h3 class="font-weight-400 text-center mb-4">Reset Password</h3>
                        <hr class="mx-n5">
                        @livewire('forgot-password-request')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
