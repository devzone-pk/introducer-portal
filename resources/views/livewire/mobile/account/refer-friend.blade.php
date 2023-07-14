<div id="appCapsule">
    <div class=" px-3 mt-4">

        <div class="splash-page">

            <h1 class="mt-5 text-dark-blue">Refer your Friends
                to {{ config('app.company_name') }}:</h1>
            <p class="mb-1">
                Invite your friends by sharing your unique Referral Link. They'll get reward on their First transfer, you'll also get reward for every new friend that signs up, join {{ config('app.company_name') }}.

            </p>
            <h3 class="">3 Steps to the Referral Reward:</h3>
            <h3>Refer Friends:</h3>
            <p>
                Invite your Friends by Sharing Referral Link.
            </p>
            <h3>Your Friend Joins {{ config('app.company_name') }}: </h3>
            <p>By using referral link they can sign-up.
            </p>
            <h3>Both Get Reward:
            </h3>
            <p>Anyone who Participates will get reward on their transfers & you'll get rewards on next transfer for every new friend.</p>

            <div class="form-button-group padding-bottom-100">
                <a href="#" class="btn btn-primary btn-block btn-lg" data-bs-toggle="modal" data-bs-target="#actionSheetShare">

                    Invite Friends
                </a>
            </div>



        </div>

    </div>

    <div class="modal fade action-sheet inset" id="actionSheetShare" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Share with</h5>
                </div>
                <div class="modal-body">
                    <ul class="action-button-list">


                        <li>
                            <a href="" data-clipboard-text="{{ $message }}" class="btn btn-list copy"
                               data-bs-dismiss="modal">
                                <span>
                                    <ion-icon name="share-social-outline"></ion-icon>
                                    Copy
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
