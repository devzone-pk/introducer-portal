<div class="bg-primary py-1 header_info_base hide-max-1199">
    <div class="container-fluid ">
        <div class="d-flex bd-highlight">
            <div class="p-2 flex-grow-1 text-white align-self-center">
                <i class="fas  fa-map-marker-alt"></i> {{ $company['address'] }}
            </div>
            <div class="p-2 text-white  align-self-center"><i class="fas fa-envelope"></i> {{ $company['email'] }}
            </div>
            <div class="align-self-center">
                <ul class="social-icons social-icons-colored">
                    @if(!empty($company['facebook']))
                        <li class="social-icons-facebook">
                            <a data-toggle="tooltip" class="text-white" href="{{ $company['facebook'] }}"
                               target="_blank" title="" data-original-title="Facebook">
                                <i
                                    class="fab fa-facebook-f"></i></a>
                        </li>
                    @endif
                    @if(!empty($company['linkedin']))
                        <li class="social-icons-linkedin">
                            <a data-toggle="tooltip"
                               class="text-white"
                               href="{{ $company['linkedin'] }}"
                               target="_blank" title=""
                               data-original-title="Linkedin"><i
                                    class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                    @endif
                    @if(!empty($company['instagram']))
                        <li class="social-icons-instagram">
                            <a data-toggle="tooltip"
                               class="text-white"
                               href="{{ $company['instagram'] }}"
                               target="_blank" title=""
                               data-original-title="Instagram"><i
                                    class="fab fa-instagram"></i>
                            </a>
                        </li>
                    @endif
                    @if(!empty($company['twitter']))
                        <li class="social-icons-twitter">
                            <a data-toggle="tooltip"
                               class="text-white"
                               href="{{ $company['twitter'] }}"
                               target="_blank" title=""
                               data-original-title="Twitter"><i
                                    class="fab fa-twitter"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
