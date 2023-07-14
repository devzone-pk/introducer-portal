@extends('inner.layouts.master')


@section('title') Customer Document Add @endsection

@section('content')

    <main class="pb-8 pb-md-11 pt-5">
        <div class="container-md">
            <div class="row">

                <div class="col-12  ">
                    @livewire('inner.document-add',['primary_id' => session('customer_id')])
                </div>
            </div>
        </div>
    </main>

@endsection
