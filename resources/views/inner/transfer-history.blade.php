@extends('inner.layouts.master')


@section('title') Transaction History @endsection

@section('content')
    <main class="pb-8 pb-md-11 pt-5">
        <div class="container-md">
            <div class="row">

                <div class="col-12 ">
                    @livewire('inner.transfer-history')
                </div>
            </div>
        </div>
    </main>
@endsection
