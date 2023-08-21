


<div class="modal fade action-sheet inset" id="optionwindow" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h2 class="title text-primary mb-0">{{ session('name') }}</h2>
                        <h4 class="subtitle mb-0">Welcome to {{ config('app.company_name') }}</h4>
                        <h6 class="  text-muted">{{ date('l, F jS, Y') }}</h6>
                    </div>
                    <div role="button"  data-bs-dismiss="modal">
                        <svg width="38" height="38" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.0496 3.35288C17.827 4.00437 19.9956 6.17301 20.6471 8.95043C21.1176 10.9563 21.1176 13.0437 20.6471 15.0496C19.9956 17.827 17.827 19.9956 15.0496 20.6471C13.0437 21.1176 10.9563 21.1176 8.95044 20.6471C6.17301 19.9956 4.00437 17.827 3.35288 15.0496C2.88237 13.0437 2.88237 10.9563 3.35288 8.95044C4.00437 6.17301 6.173 4.00437 8.95043 3.35288C10.9563 2.88237 13.0437 2.88237 15.0496 3.35288Z" stroke="#FF885B" stroke-width="1.5"/>
                            <path d="M15.0496 3.35288C13.0437 2.88237 10.9563 2.88237 8.95043 3.35288C6.173 4.00437 4.00437 6.17301 3.35288 8.95044C2.88237 10.9563 2.88237 13.0437 3.35288 15.0496C4.00437 17.827 6.17301 19.9956 8.95044 20.6471C10.9563 21.1176 13.0437 21.1176 15.0496 20.6471C17.827 19.9956 19.9956 17.827 20.6471 15.0496" stroke="#0F5ABB" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M13.7678 10.2322L10.2322 13.7677M13.7678 13.7677L10.2322 10.2322" stroke="#FF885B" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>


                    </div>
                </div>

                <ul class="listview flush  transparent  no-line image-listview mt-1">
                    <li>
                        <a href="{{ url('mobile/dashboard') }}" class="item p-0">
                            <div class="icon-box bg-dark-blue">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.96444 1.391L14.5644 6.76768C14.8444 7.03224 15 7.40572 15 7.79478V13.5839C15 14.3697 14.37 15 13.6 15H2.4C1.63 15 1 14.362 1 13.5839V7.79478C1 7.40572 1.15556 7.03224 1.43556 6.76768L7.03556 1.391C7.57222 0.869668 8.42 0.869668 8.96444 1.391Z"
                                          stroke="#FFFFFF" stroke-width="1.2" stroke-miterlimit="10"/>
                                </svg>
                            </div>
                            <div class="in">
                                Home
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('mobile/transactions') }}" class="item p-0">
                            <div class="icon-box bg-dark-blue">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 12L14.672 12" stroke="#FFFFFF" stroke-width="1.2" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                    <path d="M10.4652 9L14.8581 11.7884C15.0473 11.9064 15.0473 12.0936 14.8581 12.2116L10.4652 15"
                                          stroke="#FFFFFF" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15 4L1.32805 4" stroke="#FFFFFF" stroke-width="1.2" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                    <path d="M5.5348 1L1.14188 3.78843C0.952709 3.90635 0.952709 4.09365 1.14188 4.21157L5.5348 7"
                                          stroke="#FFFFFF" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="in">
                                Transactions
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('mobile/receivers') }}" class="item p-0">
                            <div class="icon-box bg-dark-blue">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.49999 8C8.43147 8 9.99999 6.43148 9.99999 4.5C9.99999 2.56852 8.43147 1 6.49999 1C4.5685 1 2.99999 2.56852 2.99999 4.5C2.99999 6.43148 4.5685 8 6.49999 8Z"
                                          stroke="#FFFFFF" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1 15C3.47265 11.0166 9.47094 10.9986 11.9718 14.9549L12 15" stroke="#FFFFFF"
                                          stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.8 9.1H15.0001" stroke="#FFFFFF" stroke-width="1.2" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                    <path d="M12.9 11.2V7" stroke="#FFFFFF" stroke-width="1.2" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="in">
                                Receivers
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('mobile/documents') }}" class="item p-0">
                            <div class="icon-box bg-dark-blue">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.50943 4H3.49057C2.11506 4 1 4.96566 1 6.15686V12.8431C1 14.0343 2.11506 15 3.49057 15H9.50943C10.8849 15 12 14.0343 12 12.8431V6.15686C12 4.96566 10.8849 4 9.50943 4Z"
                                          stroke="#FFFFFF" stroke-width="1.2"/>
                                    <path d="M7.17753 1H12.6812C13.9587 1 15 1.94111 15 3.1V9.76556" stroke="#FFFFFF"
                                          stroke-width="1.2" stroke-linecap="round"/>
                                    <path d="M4.13257 12.2H7.23004" stroke="#FFFFFF" stroke-width="1.2" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="in">
                                Documents
                            </div>
                        </a>
                    </li>
                </ul>

                <div class="listview-title mt-1  p-0 mb-1">
                    <span>General</span>
                </div>

                <ul class="listview image-listview flush  transparent  no-line">
                    <li>
                        <a href="{{ url('mobile/account') }}" class="item p-0">
                            <div class="icon-box bg-dark-blue">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5C12 5.78518 11.7763 6.51852 11.3663 7.14074C11.3364 7.2 11.2992 7.25185 11.2619 7.3037C10.5461 8.32593 9.34577 9 8.00373 9C5.79683 9 4 7.20741 4 5C4 2.79259 5.79683 1 8.00373 1C9.35322 1 10.5536 1.67407 11.2619 2.6963C11.2992 2.74815 11.3364 2.8 11.3663 2.86667C11.7763 3.48889 12 4.22222 12 5.00741V5Z"
                                          stroke="#FFFFFF" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1 15C4.14187 11.5622 11.7859 11.5467 14.9639 14.9611L15 15" stroke="#FFFFFF"
                                          stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                            </div>
                            <div class="in">
                                Profile
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('mobile/contact-preferences') }}" class="item p-0">
                            <div class="icon-box bg-dark-blue">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.1433 7.82643L10.7402 7.76606L10.7401 7.76505L10.1433 7.82643ZM13.3974 8.03315L13.9974 8.03676V8.03315H13.3974ZM13.3459 8.71642L12.7521 8.6301C12.7208 8.84526 12.8084 9.06052 12.981 9.19274L13.3459 8.71642ZM14.8673 9.88182L15.2448 9.41548C15.2406 9.4121 15.2364 9.40878 15.2321 9.40551L14.8673 9.88182ZM14.9497 10.3337L14.4339 10.0271L14.4333 10.0281L14.9497 10.3337ZM13.5104 12.7657L14.0233 13.0772L14.0268 13.0713L13.5104 12.7657ZM13.0682 12.9166L12.8486 13.4751L12.8594 13.4791L13.0682 12.9166ZM11.5573 12.3224L11.7769 11.764L11.7747 11.7632L11.5573 12.3224ZM11.0468 12.3799L11.3816 12.8778L11.3844 12.8759L11.0468 12.3799ZM10.322 12.792L10.0652 12.2497L10.0647 12.25L10.322 12.792ZM10.0251 13.191L10.619 13.2765L10.6191 13.2756L10.0251 13.191ZM9.79867 14.7649L10.3893 14.8706C10.3905 14.8639 10.3916 14.8572 10.3926 14.8504L9.79867 14.7649ZM9.43927 15.0663V15.6664L9.45168 15.6662L9.43927 15.0663ZM6.56073 15.0663L6.55059 15.6663H6.56073V15.0663ZM6.20099 14.7748L5.60711 14.8602C5.60895 14.873 5.61121 14.8858 5.61387 14.8984L6.20099 14.7748ZM5.97486 13.2032L6.56874 13.1177L6.56844 13.1157L5.97486 13.2032ZM5.67199 12.8016L5.41614 13.3443L5.41909 13.3457L5.67199 12.8016ZM4.94983 12.3885L5.28811 11.8929L5.28705 11.8922L4.94983 12.3885ZM4.44136 12.3323L4.22194 11.7738L4.22183 11.7739L4.44136 12.3323ZM2.93074 12.9261L3.13993 13.4886L3.15027 13.4845L2.93074 12.9261ZM2.48856 12.7756L1.97217 13.0812L1.97599 13.0875L2.48856 12.7756ZM1.04929 10.3436L1.56565 10.038L1.5648 10.0366L1.04929 10.3436ZM1.13174 9.89168L0.766642 9.41555C0.762579 9.41866 0.758556 9.42183 0.754574 9.42505L1.13174 9.89168ZM2.41756 8.90573L2.78266 9.38187L2.78518 9.37991L2.41756 8.90573ZM2.61947 8.44298L2.02178 8.49582L2.02226 8.50074L2.61947 8.44298ZM2.61947 7.62628L3.21691 7.68176L3.21723 7.67809L2.61947 7.62628ZM2.4152 7.16814L2.04999 7.64419L2.0504 7.6445L2.4152 7.16814ZM1.13006 6.18219L0.747998 6.64482C0.753531 6.64939 0.759146 6.65386 0.764839 6.65823L1.13006 6.18219ZM1.0503 5.73259L1.56612 6.03907L1.56666 6.03817L1.0503 5.73259ZM2.48957 3.30056L1.97669 2.98912L1.97322 2.99499L2.48957 3.30056ZM2.93175 3.14971L3.15138 2.59124L3.14064 2.58725L2.93175 3.14971ZM4.4427 3.74392L4.22311 4.30229L4.22525 4.30313L4.4427 3.74392ZM4.9532 3.6864L4.61835 3.18852L4.61561 3.19038L4.9532 3.6864ZM5.67805 3.27427L5.93478 3.81657L5.93534 3.81631L5.67805 3.27427ZM5.97486 2.87529L5.38097 2.78983L5.38085 2.79068L5.97486 2.87529ZM6.20133 1.30137L5.61071 1.19568C5.60951 1.20241 5.60842 1.20916 5.60745 1.21592L6.20133 1.30137ZM6.56073 1V0.399872L6.54832 0.400128L6.56073 1ZM9.43927 1L9.44941 0.4H9.43927V1ZM9.79901 1.29151L10.3929 1.20606C10.391 1.19326 10.3888 1.18052 10.3861 1.16786L9.79901 1.29151ZM10.0251 2.86313L9.43126 2.94858L9.43156 2.95065L10.0251 2.86313ZM10.328 3.26474L10.5839 2.72202L10.5809 2.72064L10.328 3.26474ZM11.0502 3.67786L10.7119 4.17341L10.7129 4.17412L11.0502 3.67786ZM11.5586 3.73406L11.7781 4.2925L11.7782 4.29245L11.5586 3.73406ZM13.0693 3.14018L12.8601 2.57772L12.8497 2.58178L13.0693 3.14018ZM13.5114 3.2907L14.0278 2.9851L14.024 2.97882L13.5114 3.2907ZM14.9507 5.72273L14.4344 6.02831L14.4352 6.02973L14.9507 5.72273ZM14.8683 6.17463L15.2334 6.65076C15.2374 6.64765 15.2414 6.64448 15.2454 6.64126L14.8683 6.17463ZM13.5824 7.16058L13.2173 6.68445L13.2166 6.68505L13.5824 7.16058ZM13.3788 7.62332L13.9769 7.57451L13.9762 7.56698L13.3788 7.62332ZM8.26929 5.34274C7.12054 5.23194 6.01456 5.8372 5.51325 6.87201L6.5932 7.39518C6.8701 6.82359 7.492 6.47334 8.15408 6.5372L8.26929 5.34274ZM5.51325 6.87201C5.01044 7.9099 5.23183 9.14295 6.0579 9.94972L6.89634 9.09122C6.43573 8.64137 6.31778 7.9637 6.5932 7.39518L5.51325 6.87201ZM6.0579 9.94972C6.88107 10.7537 8.12669 10.9625 9.17277 10.4791L8.66942 9.3898C8.07067 9.66647 7.35986 9.5439 6.89634 9.09122L6.0579 9.94972ZM9.17277 10.4791C10.2214 9.99457 10.8561 8.91166 10.7402 7.76606L9.54632 7.8868C9.60932 8.50973 9.26559 9.11433 8.66942 9.3898L9.17277 10.4791ZM10.7401 7.76505C10.6074 6.47408 9.56576 5.46991 8.27026 5.34283L8.15311 6.5371C8.9002 6.61039 9.47404 7.18393 9.54643 7.88781L10.7401 7.76505ZM12.7974 8.02954C12.7962 8.23048 12.781 8.43112 12.7521 8.6301L13.9396 8.80275C13.9765 8.549 13.9958 8.29309 13.9973 8.03676L12.7974 8.02954ZM12.981 9.19274L14.5024 10.3581L15.2321 9.40551L13.7107 8.24011L12.981 9.19274ZM14.4897 10.3482C14.3977 10.2737 14.369 10.1364 14.4339 10.0271L15.4655 10.6403C15.7089 10.2308 15.6104 9.71145 15.2448 9.41548L14.4897 10.3482ZM14.4333 10.0281L12.9941 12.4602L14.0268 13.0713L15.4661 10.6393L14.4333 10.0281ZM12.9976 12.4543C13.0598 12.3518 13.1786 12.3176 13.2771 12.3541L12.8594 13.4791C13.2885 13.6384 13.7805 13.4769 14.0233 13.0772L12.9976 12.4543ZM13.2878 12.3582L11.7769 11.764L11.3377 12.8808L12.8487 13.475L13.2878 12.3582ZM11.7747 11.7632C11.4223 11.6262 11.0229 11.6704 10.7092 11.8839L11.3844 12.8759C11.3697 12.886 11.3537 12.887 11.3398 12.8816L11.7747 11.7632ZM10.712 11.882C10.5063 12.0203 10.2901 12.1433 10.0652 12.2497L10.5787 13.3343C10.8577 13.2023 11.1261 13.0497 11.3816 12.8778L10.712 11.882ZM10.0647 12.25C9.72609 12.4107 9.48482 12.7296 9.43114 13.1064L10.6191 13.2756C10.6148 13.3064 10.5961 13.3261 10.5792 13.3341L10.0647 12.25ZM9.43126 13.1056L9.20479 14.6795L10.3926 14.8504L10.619 13.2765L9.43126 13.1056ZM9.20805 14.6592C9.22944 14.5397 9.32891 14.4685 9.42687 14.4664L9.45168 15.6662C9.90593 15.6568 10.3065 15.333 10.3893 14.8706L9.20805 14.6592ZM9.43927 14.4663H6.56073V15.6663H9.43927V14.4663ZM6.57086 14.4664C6.66645 14.468 6.76379 14.5357 6.78811 14.6511L5.61387 14.8984C5.70872 15.3488 6.10501 15.6587 6.55059 15.6662L6.57086 14.4664ZM6.79488 14.6893L6.56874 13.1177L5.38097 13.2886L5.60711 14.8602L6.79488 14.6893ZM6.56844 13.1157C6.51251 12.7363 6.26725 12.4166 5.92489 12.2575L5.41909 13.3457C5.40353 13.3384 5.38562 13.3202 5.38127 13.2907L6.56844 13.1157ZM5.92784 12.2589C5.70478 12.1537 5.49086 12.0313 5.28811 11.8929L4.61156 12.884C4.86685 13.0583 5.13592 13.2122 5.41614 13.3443L5.92784 12.2589ZM5.28705 11.8922C4.97333 11.679 4.57375 11.6356 4.22194 11.7738L4.66078 12.8907C4.64568 12.8966 4.62841 12.8955 4.61261 12.8847L5.28705 11.8922ZM4.22183 11.7739L2.71122 12.3677L3.15027 13.4845L4.66088 12.8907L4.22183 11.7739ZM2.7216 12.3638C2.82004 12.3271 2.93881 12.3613 3.00114 12.4637L1.97599 13.0875C2.219 13.4869 2.71093 13.648 3.13989 13.4885L2.7216 12.3638ZM3.00492 12.47L1.56565 10.038L0.532938 10.6492L1.97221 13.0812L3.00492 12.47ZM1.5648 10.0366C1.63003 10.1461 1.60117 10.2837 1.5089 10.3583L0.754574 9.42505C0.388443 9.72098 0.289834 10.2409 0.533781 10.6506L1.5648 10.0366ZM1.49683 10.3678L2.78266 9.38186L2.05246 8.42959L0.766642 9.41555L1.49683 10.3678ZM2.78518 9.37991C3.08817 9.14502 3.25404 8.77147 3.21668 8.38523L2.02226 8.50074C2.01927 8.46985 2.0332 8.44452 2.04994 8.43154L2.78518 9.37991ZM3.21714 8.39015C3.2062 8.26642 3.19995 8.14777 3.19995 8.03217H1.99995C1.99995 8.19066 2.00851 8.34545 2.0218 8.49582L3.21714 8.39015ZM3.19995 8.03217C3.19995 7.91585 3.20594 7.79974 3.2169 7.68176L2.02204 7.57081C2.00809 7.72101 1.99995 7.8744 1.99995 8.03217H3.19995ZM3.21723 7.67809C3.25055 7.29359 3.08268 6.92358 2.78001 6.69179L2.0504 7.6445C2.03329 7.63139 2.01899 7.60583 2.02171 7.57448L3.21723 7.67809ZM2.78042 6.6921L1.49527 5.70614L0.764839 6.65823L2.04999 7.64418L2.78042 6.6921ZM1.51211 5.71955C1.60281 5.79445 1.63053 5.93067 1.56612 6.03907L0.53448 5.42611C0.29309 5.83239 0.388027 6.34755 0.747998 6.64482L1.51211 5.71955ZM1.56666 6.03817L3.00593 3.60614L1.97322 2.99499L0.533947 5.42701L1.56666 6.03817ZM3.00242 3.61199C2.94015 3.71453 2.82135 3.74875 2.72287 3.71218L3.14064 2.58725C2.71147 2.42787 2.21946 2.58941 1.97672 2.98914L3.00242 3.61199ZM2.71217 3.70809L4.22312 4.30229L4.66229 3.18554L3.15134 2.59134L2.71217 3.70809ZM4.22525 4.30313C4.57765 4.44016 4.97712 4.39589 5.29078 4.18242L4.61561 3.19038C4.63035 3.18035 4.64626 3.1793 4.66016 3.18471L4.22525 4.30313ZM5.28804 4.18428C5.49367 4.04599 5.70987 3.92305 5.93478 3.81657L5.42132 2.73197C5.14235 2.86404 4.87392 3.01665 4.61836 3.18852L5.28804 4.18428ZM5.93534 3.81631C6.27391 3.65559 6.51518 3.33672 6.56886 2.9599L5.38085 2.79068C5.38524 2.75986 5.40389 2.74024 5.42076 2.73224L5.93534 3.81631ZM6.56874 2.96074L6.79521 1.38683L5.60745 1.21592L5.38097 2.78983L6.56874 2.96074ZM6.79195 1.40706C6.77056 1.5266 6.67109 1.59785 6.57313 1.59987L6.54832 0.400128C6.09408 0.409522 5.69346 0.7333 5.61071 1.19568L6.79195 1.40706ZM6.56073 1.6H9.43927V0.4H6.56073V1.6ZM9.42914 1.59991C9.33355 1.5983 9.23621 1.53064 9.21189 1.41517L10.3861 1.16786C10.2913 0.717535 9.89499 0.407614 9.44941 0.400086L9.42914 1.59991ZM9.20512 1.37697L9.43126 2.94858L10.619 2.77768L10.3929 1.20606L9.20512 1.37697ZM9.43156 2.95065C9.48749 3.32997 9.73275 3.64971 10.0751 3.80884L10.5809 2.72064C10.5965 2.72788 10.6144 2.74615 10.6187 2.77561L9.43156 2.95065ZM10.0722 3.80746C10.2952 3.91261 10.5091 4.035 10.7119 4.17341L11.3884 3.18231C11.1331 3.00803 10.8641 2.85413 10.5839 2.72202L10.0722 3.80746ZM10.7129 4.17412C11.0267 4.3873 11.4262 4.43073 11.7781 4.2925L11.3392 3.17562C11.3543 3.16968 11.3716 3.17086 11.3874 3.18159L10.7129 4.17412ZM11.7782 4.29245L13.2888 3.69858L12.8497 2.58178L11.3391 3.17566L11.7782 4.29245ZM13.2784 3.70255C13.18 3.73916 13.0612 3.70502 12.9989 3.60259L14.024 2.97882C13.781 2.57944 13.2891 2.41828 12.8601 2.57781L13.2784 3.70255ZM12.9951 3.59628L14.4344 6.02831L15.4671 5.41715L14.0278 2.98513L12.9951 3.59628ZM14.4352 6.02973C14.37 5.92021 14.3988 5.78257 14.4911 5.70799L15.2454 6.64126C15.6116 6.34533 15.7102 5.82536 15.4662 5.41573L14.4352 6.02973ZM14.5032 5.69849L13.2173 6.68445L13.9475 7.63672L15.2334 6.65076L14.5032 5.69849ZM13.2166 6.68505C12.9123 6.91915 12.745 7.29278 12.7815 7.67967L13.9762 7.56698C13.9791 7.59793 13.9651 7.62322 13.9483 7.63612L13.2166 6.68505ZM12.7808 7.67213C12.7911 7.79771 12.7974 7.91729 12.7974 8.03315H13.9974C13.9974 7.87492 13.9888 7.72107 13.9769 7.57452L12.7808 7.67213Z"
                                          fill="#FFFFFF"/>
                                </svg>
                            </div>
                            <div class="in">
                                Preferences
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('mobile/refer-friend') }}" class="item p-0">
                            <div class="icon-box bg-dark-blue">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.207 5.2C10.207 6.02444 9.95995 6.79444 9.50701 7.44778C9.47407 7.51 9.43291 7.56444 9.39173 7.61889C8.60114 8.69222 7.27526 9.4 5.79291 9.4C3.35525 9.4 1.37055 7.51778 1.37055 5.2C1.37055 2.88222 3.35525 1 5.79291 1C7.2835 1 8.60938 1.70778 9.39173 2.78111C9.43291 2.83555 9.47407 2.89 9.50701 2.96C9.95995 3.61333 10.207 4.38333 10.207 5.20778V5.2Z"
                                          stroke="#FFFFFF" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15 5.2C15 6.91111 13.5423 8.29556 11.747 8.29556C10.8823 8.29556 10.1 7.97667 9.51526 7.44778C9.9682 6.79444 10.2153 6.02444 10.2153 5.2C10.2153 4.37556 9.9682 3.60556 9.51526 2.95222C10.1 2.42334 10.8823 2.10445 11.747 2.10445C13.5423 2.10445 15 3.48889 15 5.2Z"
                                          stroke="#FFFFFF" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1 15C3.14942 11.5622 8.37884 11.5467 10.553 14.9611L10.5777 15" stroke="#FFFFFF"
                                          stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.8965 14.3C13.5506 13.1644 12.7271 12.2778 11.6895 11.8967L12.6695 10.9711"
                                          stroke="#FFFFFF" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                            </div>
                            <div class="in">
                                Refer a Friend
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('mobile/customer-support') }}" class="item p-0">
                            <div class="icon-box bg-dark-blue">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.926 9.19426C14.4514 12.1017 12.2809 14.325 9.39473 14.8692C7.80771 15.1723 6.30624 14.9314 5.00706 14.325C4.78923 14.2162 4.44692 14.1773 4.21353 14.2239C3.7312 14.3405 2.90656 14.5427 2.21419 14.6981C1.54515 14.8614 1.13284 14.4494 1.30399 13.7886L1.77853 11.7985C1.83299 11.5653 1.77853 11.2155 1.6774 10.9978C1.08615 9.76176 0.852764 8.32359 1.09393 6.81547C1.5607 3.9236 3.91015 1.57588 6.81192 1.09391C11.6041 0.324296 15.6883 4.39779 14.9026 9.18648L14.926 9.19426Z"
                                          stroke="#FFFFFF" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.96749 8.00485H5.56714" stroke="#FFFFFF" stroke-width="1.2"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.4683 8.00485H9.06795" stroke="#FFFFFF" stroke-width="1.2"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>


                            </div>
                            <div class="in">
                                Customer Support
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('mobile/contact') }}" class="item p-0">
                            <div class="icon-box bg-dark-blue">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_101_1265)">
                                        <path d="M12.215 10.325C12.215 10.5117 12.1742 10.71 12.0808 10.8967C11.9875 11.0833 11.8767 11.2642 11.725 11.4333C11.4683 11.7192 11.1825 11.9233 10.8617 12.0517C10.5467 12.1858 10.2025 12.25 9.83499 12.25C9.29832 12.25 8.72667 12.1217 8.12001 11.865C7.51334 11.6083 6.9125 11.2642 6.31167 10.8267C5.705 10.3833 5.13332 9.89917 4.58499 9.35667C4.04249 8.80834 3.5525 8.23667 3.12083 7.64167C2.68917 7.04084 2.34499 6.44583 2.08832 5.85083C1.83749 5.25 1.70916 4.67833 1.70916 4.13583C1.70916 3.78 1.77333 3.43584 1.89583 3.12084C2.02416 2.8 2.2225 2.50834 2.5025 2.24584C2.84084 1.91334 3.20833 1.75 3.59333 1.75C3.73917 1.75 3.88501 1.77917 4.01917 1.84334C4.15334 1.9075 4.27583 2.00084 4.36916 2.135L5.58832 3.85C5.68166 3.98417 5.75167 4.10084 5.79833 4.21751C5.845 4.32834 5.87417 4.43917 5.87417 4.53833C5.87417 4.66667 5.83917 4.78917 5.76333 4.91167C5.69333 5.03417 5.59417 5.15667 5.47167 5.285L5.06917 5.69916C5.01083 5.75749 4.98749 5.8275 4.98749 5.90917C4.98749 5.95 4.98749 5.985 5.00499 6.03166C5.02249 6.0725 5.03416 6.10749 5.04583 6.13666C5.13916 6.31166 5.30249 6.53334 5.53583 6.80751C5.77499 7.08167 6.02582 7.35583 6.29999 7.63583C6.58582 7.91583 6.86 8.1725 7.13417 8.40584C7.40834 8.63917 7.63584 8.79666 7.81084 8.88999C7.84001 8.90166 7.86916 8.91916 7.90416 8.93083C7.94499 8.94833 7.98583 8.95417 8.03833 8.95417C8.12583 8.95417 8.19583 8.92501 8.25416 8.86667L8.65666 8.47583C8.79083 8.34167 8.91333 8.2425 9.03583 8.18417C9.15833 8.10833 9.275 8.07333 9.40917 8.07333C9.50833 8.07333 9.61333 8.09666 9.72999 8.14333C9.84666 8.18999 9.96916 8.26 10.0975 8.3475L11.8358 9.57834C11.97 9.67167 12.0692 9.7825 12.1275 9.91667C12.18 10.0508 12.2092 10.1792 12.2092 10.325H12.215Z"
                                              stroke="#FFFFFF" stroke-width="1.5" stroke-miterlimit="10"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_101_1265">
                                            <rect width="14" height="14" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>


                            </div>
                            <div class="in">
                                Contact Us
                            </div>
                        </a>
                    </li>

                </ul>



                <a class="btn mt-2 btn-block btn-secondary" href="{{ url('logout') }}">
                    Logout
                </a>


            </div>
        </div>
    </div>
</div>