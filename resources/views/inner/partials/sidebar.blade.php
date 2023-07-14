<!-- Collapse -->
<div class="collapse d-md-block" id="sidenavCollapse">
    <div class="card-body p-0">

        <!-- Heading -->
        <h6 class="fw-bold text-uppercase  px-5 pt-5">
            home
        </h6>

        <!-- List -->
        <ul class="card-list list text-gray-700 mb-3">
            <li class="list-item {{ (in_array(request()->path(),['dashboard'])) ? 'active':'' }}">
                <a class="list-link text-reset py-1 px-5" href="{{ url('dashboard') }}">
                    Dashboard
                </a>
            </li>


            <li class="list-item  {{ request()->is('transfer/*') ? 'active':'' }} {{ (in_array(request()->path(),['transfer/history'])) ? 'active':'' }}">
                <a class="list-link text-reset py-1 px-5" href="{{ url('transfer/history') }}">
                    Transactions
                </a>
            </li>


            <li class="list-item {{ (\Illuminate\Support\Facades\Request::segment(1) == 'recipients') ? 'active':'' }}">
                <a class="list-link text-reset py-1 px-5" href="{{ url('recipients') }}">
                    Receivers
                </a>
            </li>


            <li class="list-item {{ request()->is('user/document/*') ? 'active':'' }} {{ (in_array(request()->path(),['user/documents','user/document/add'])) ? 'active':'' }}">
                <a class="list-link text-reset py-1 px-5" href="{{ url('user/documents') }}">
                    Documents
                </a>
            </li>

            <li class="list-item {{ request()->is('customer-support/*') ? 'active':'' }} {{ (in_array(request()->path(),['customer-support','customer-support/add-complaint'])) ? 'active':'' }}">
                <a class="list-link text-reset py-1 px-5" href="{{ url('customer-support') }}">
                    Customer Support
                </a>
            </li>

        </ul>

        <!-- Heading -->
        <h6 class="fw-bold text-uppercase  px-5 pt-5">
            general
        </h6>

        <!-- List -->
        <ul class="card-list list text-gray-700 mb-4">
            <li class="list-item {{ (in_array(request()->path(),['profile'])) ? 'active':'' }}">
                <a class="list-link  py-1 px-5" href="{{ url('profile') }}">
                    Profile
                </a>
            </li>


            <li class="list-item   {{ (in_array(request()->path(),['refer-friend'])) ? 'active':'' }}">
                <a class="list-link  py-1 px-5" href="{{ url('refer-friend') }}">
                    Refer a Friend
                </a>
            </li>

            <li class="list-item {{ (in_array(request()->path(),['contact-preferences'])) ? 'active':'' }}">
                <a class="list-link  py-1 px-5" href="{{ url('contact-preferences') }}">
                    Preferences
                </a>
            </li>

            <li class="list-item">
                <a class="list-link  py-1 px-5" href="{{ url('logout') }}">
                    Logout
                </a>
            </li>

        </ul>

    </div>
</div>
