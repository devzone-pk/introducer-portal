@extends('mobile.layout.master')

@section('title') Send Money @endsection

@section('content')



    @livewire('mobile.send-money',['request'=>request()->json()->all(),'redirect' => 'mobile'])
    
{{--    @include('inner.partials.bottom-menu')--}}

@endsection
