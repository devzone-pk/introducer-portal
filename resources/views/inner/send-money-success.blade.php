@extends('inner.layouts.master')


@section('title') Transfer Complete @endsection

@section('content')

    <main class="pb-8 pb-md-11 pt-5">
        <div class="container-md">
            <div class="row">
                <div class="col-12 col-md-3">
                    <!-- Card -->
                    <div class="card card-bleed border-bottom border-bottom-md-0 shadow-light-lg">
                        @include('inner.partials.sidebar')
                    </div>
                </div>
                <div class="col-12 col-md-9">

                    @if(!empty(request('error')))
                        <div class="alert alert-danger">
                            Your Payment is still incomplete. Please retry
                        </div>
                        <a
                                href="{{ url('gateway/swipen/payment') }}/{{request('transfer_code')}}"
                                target="_blank" class="btn fs-12px btn-success mb-2 py-1" style="">Retry</a>
                    @else
                        @livewire('inner.send-money-success',['transfer_code' => request('transfer_code'),'redirect'=>'web'])
                    @endif
                </div>
            </div>
        </div>
    </main>


@endsection
