@extends('mobile.layout.master')

@section('title') Signup @endsection

@section('content')




    @livewire('mobile.signup',['data'=>request()->all(),'token'=>request()->header('notificationToken')])



    <!-- Terms Modal -->
    <div class="modal fade modalbox" id="termsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terms and Conditions</h5>
                    <a href="#" data-bs-dismiss="modal">Close</a>
                </div>
                <div class="modal-body">
                   @include('include.terms-and-conditions')
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade modalbox" id="privacy" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Privacy Policy</h5>
                    <a href="#" data-bs-dismiss="modal">Close</a>
                </div>
                <div class="modal-body">
                    @include('include.privacy-policy')
                </div>
            </div>
        </div>
    </div>
    <!-- * Terms Modal -->





@endsection

