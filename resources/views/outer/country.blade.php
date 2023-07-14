@extends('outer.layouts.master')
@section('title')
    Send Money to {{ $iso2 }}
@endsection
@section('content')


    @if (view()->exists('outer.country-pages.'.strtolower($iso2)))
        @include('outer.country-pages.'.strtolower($iso2))
    @else
        @include('outer.country-pages.default')
    @endif


@endsection
