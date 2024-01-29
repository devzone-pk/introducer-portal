@extends('inner.layouts.master')


@section('title') Payment Request Form @endsection

@section('content')
    <main class="pb-8 pb-md-11 pt-5">
        <div class="container-md">
            <div class="row">

                <div class="col-12 ">
                    @livewire('inner.payment-introduction')
                </div>
            </div>
        </div>
    </main>

@endsection
