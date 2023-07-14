<nav class="primary-menu navbar navbar-expand-lg">
    <div id="{{ $navbar }}" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">

            <li class="dropdown"><a class="dropdown-toggle" href="#">Send Money To</a>
                <ul class="dropdown-menu" wire:ignore.self style="    max-height: 300px;
    overflow: scroll;">
<li class="dropdown pb-2">
                    <input type="text" class="form-control form-control-sm " wire:model="search" placeholder="Search">
</li>
                    @foreach($receiving as $s)
                        <li class="dropdown">
                            <a class="dropdown-item " href="{{ url('send-money-to') }}/{{strtolower($s['iso2'])}}">
                                <span
                                    class="text-3 {{ empty($s['name']) ? 'placeholder-color' : '' }} ">{{ $s['name']  }}</span>
                            </a>
                        @if(!$loop->last)
                            <li>
                                <hr class="d-none d-md-none d-lg-block dropdown-divider ">
                            </li>
                            @endif
                            </li>
                            @endforeach

                </ul>


            </li>


            <li class="  d-md-block d-lg-none"><a href="{{route('how-it-works')}}">How it Works</a></li>
{{--            <li class="  d-md-block d-lg-none"><a href="{{route('help')}}">Help</a></li>--}}
            <li class="  d-md-block d-lg-none"><a href="{{route('login')}}">Login</a></li>
            <li class="  d-md-block d-lg-none"><a href="{{route('register')}}">Sign Up</a></li>

        </ul>
    </div>
</nav>
