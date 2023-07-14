<div id="error-notification" class="validation-error notification-box {{ $errors->any() ? 'show' : '' }}">
    <div class="notification-dialog ios-style text-white" style="background: #DB0811;">
        <div class="notification-header">
            <div class="in">

                <strong style="    font-weight: 600;">Error</strong>
            </div>
            <div class="right">

                <a href="#" id="error-notification-close" class="close-button" wire:ignore
                   wire:click.prevent="resetErrors" style="opacity: 1;">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g opacity="0.5">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M0 8C0 3.58885 3.58885 0 8 0C12.4112 0 16 3.58885 16 8C16 12.4112 12.4112 16 8 16C3.58885 16 0 12.4112 0 8ZM11.0684 10.6269C11.1245 10.4104 11.0587 10.1806 10.8965 10.0265L8.87038 8L10.8965 5.97346C11.1264 5.73151 11.1215 5.35044 10.8855 5.11446C10.6496 4.87848 10.2685 4.8736 10.0265 5.10346L8 7.12961L5.97346 5.10346C5.73151 4.8736 5.35044 4.87848 5.11446 5.11446C4.87848 5.35044 4.8736 5.73151 5.10346 5.97346L7.12961 8L5.10346 10.0265C4.8736 10.2685 4.87848 10.6496 5.11446 10.8855C5.35044 11.1215 5.73151 11.1264 5.97346 10.8965L8 8.87038L10.0265 10.8965C10.1806 11.0587 10.4104 11.1245 10.6269 11.0684C10.8434 11.0124 11.0124 10.8434 11.0684 10.6269Z"
                                  fill="white"/>
                        </g>
                    </svg>

                </a>
            </div>
        </div>
        <div class="notification-content">
            <div class="in">

                <div class="text" style="
    color: #fff;
    font-size: 14px;
">

                    @if($errors->any())
                        @foreach($errors->all() as $e)
                            <p class=" m-0 ">* {{ $e }}</p>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>


{{--@if($errors->any())--}}
{{--    <script>--}}
{{--        setTimeout(() => {--}}
{{--            resetError();--}}
{{--        }, 5000);--}}
{{--    </script>--}}

{{--@endif--}}
