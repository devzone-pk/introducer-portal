<li class="dropdown notifications"><a class="dropdown-toggle" href="#"><span class="text-5"><i
                class="far fa-bell"></i></span><span
            class="count">{{ $user->unreadNotifications->count() }}</span></a>
    <ul class="dropdown-menu">
        <li class="text-center text-3 py-2">Notifications
            ({{ $user->unreadNotifications->count() }})
        </li>
        @forelse($user->notifications as $notification)
            <li>
                @include('notifications.'.\Illuminate\Support\Str::snake(class_basename($notification->type)))
            </li>



        @empty
            <li class="dropdown-divider mx-n3">
                No Record found
            </li>
        @endforelse
    </ul>


    {{--    @forelse(\Illuminate\Support\Facades\Auth::user()->notifications as $notification)--}}

    {{--        <tr class="{{ empty($notification->read_at) ? 'bg-warning' : '' }}">--}}
    {{--            <td>@include('notifications.'.\Illuminate\Support\Str::snake(class_basename($notification->type)))</td>--}}
    {{--            <td>{{ $notification->created_at->diffForHumans() }}</td>--}}
    {{--            <td>--}}
    {{--                @if(empty($notification->read_at))--}}
    {{--                    <a wire:click="markAsRead('{{ $notification->id }}')" href="javascript:void(0)">Mark as read</a>--}}
    {{--                @else--}}
    {{--                @endif--}}
    {{--            </td>--}}
    {{--        </tr>--}}
    {{--    @empty--}}
    {{--        <tr>--}}
    {{--            <td colspan="3">--}}
    {{--                <div class="alert alert-danger">--}}
    {{--                    No Record Found.--}}
    {{--                </div>--}}
    {{--            </td>--}}
    {{--        </tr>--}}
    {{--    @endforelse--}}
</li>
