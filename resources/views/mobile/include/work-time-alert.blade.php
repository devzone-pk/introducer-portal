@php
    $current_time = now()->format('H:i');
    $is_closed = strtotime($current_time) >= strtotime('09:00') && strtotime($current_time) < strtotime('19:00');
    $is_sunday = now()->dayOfWeek == Carbon\Carbon::SUNDAY;
    $margin = '';
@endphp

@if (!$is_closed)


    <div class="section">
        <div class="alert alert-danger @if ($margin) mt-2 @endif mb-2">
            <strong>Attention!</strong> <br>

            We are now closed. @if (!$is_sunday)
                Our opening hours are 9am-19.00pm. Thank you.
            @endif

        </div>
    </div>
@endif
