<div class="row g-3">

    @livewire('inner.sidebar')
    <div class="col-md-9 col-12">
    <div class="card card-border border-primary shadow-light-lg mb-6">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <!-- Heading -->
                    <h4 class="mb-0">
                        Refer a Friend
                    </h4>
                </div>

            </div>
        </div>
        <div class="card-body text-center">
            <p class="mb-1 fs-18px">Refer your Friends to {{ config('app.company_name') }}:</p>
            <p class="fs-12px text-gray">All Invite your friends by sharing your unique Referral Link. They'll get
                reward on their First transfer, you'll also get reward for every new friend that signs up, join
                {{ config('app.company_name') }}.</p>

            <p class="text-danger fs-18px fw-bold">3 Steps to the Referral Reward:</p>


            <p class="mb-1 fs-18px">Refer Friends</p>
            <p class="fs-12px text-gray">Invite your Friends by Sharing Referral Link.</p>

            <p class="mb-1 fs-18px">Your Friend Joins {{ config('app.company_name') }}</p>
            <p class="fs-12px text-gray">By using referral link they can sign-up.</p>

            <p class="mb-1 fs-18px">Both Get Rewarded</p>
            <p class="fs-12px text-gray">Anyone who Participates & you'll get rewards on next transfer for every new
                friend.</p>


            <div class="d-grid justify-content-center">
                <div role="button" data-clipboard-text="{{ $message }}"
                     class="d-flex   btn btn-success justify-content-center copy" wire:click.prevent="copy">
                    <img src="{{ url('images/clipboard.svg') }}" alt="" class="px-1 mt-1">
                    <span wire:loading>Copied</span>
                    <span wire:loading.remove>Copy Link</span>
                </div>
            </div>
        </div>
    </div>


</div>
</div>
