@extends('inner.layouts.master')


@section('title') Customer Support @endsection

@section('content')
    <main class="pb-8 pb-md-11 pt-5">
        <div class="container-md">
            <div class="row">

                <div class="col-12  ">
                    @livewire('inner.customer-support',['type'=>'portal'])
                </div>
            </div>
        </div>
    </main>
@endsection
