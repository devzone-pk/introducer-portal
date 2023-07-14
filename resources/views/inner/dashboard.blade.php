@extends('inner.layouts.master')


@section('title') Dashboard @endsection

@section('content')


    <main class="pb-8 pb-md-11  mt-5 ">
        <div class="container-md">
            <div class="row">

                <div class="col-12 ">


                    @livewire('inner.dashboard')


                </div>
            </div>
        </div>
    </main>

@endsection
