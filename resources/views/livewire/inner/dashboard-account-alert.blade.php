<div>
@if($alert)
<div class="section mt-2">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Complete your profile to send money</h5>

            <p class="card-text">We need some details to verify your identity before you send your first
                transfer.</p>

            <a href="{{ $link }}" class="btn btn-danger">Update Profile</a>
        </div>
    </div>
</div>
@endif
</div>
