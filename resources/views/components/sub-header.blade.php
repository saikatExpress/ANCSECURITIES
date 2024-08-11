@php
    $currentHour = now()->format('H');
    $greeting = '';

    if ($currentHour >= 5 && $currentHour < 12) {
        $greeting = 'Good Morning';
    } elseif ($currentHour >= 12 && $currentHour < 17) {
        $greeting = 'Good Afternoon';
    } elseif ($currentHour >= 17 && $currentHour < 21) {
        $greeting = 'Good Evening';
    } else {
        $greeting = 'Good Night';
    }
@endphp
<h2 class="welcomeText">{{ $greeting }}, {{ auth()->user()->name }}</h2>
<div class="defaultMenubar">
    <div class="clock">
        <span id="time"></span>
        <br>
        <span id="date"></span>
    </div>

    <div class="menu-bar1">
        <ul class="menu1">
            <li><a href="{{ route('admin.despositerequest') }}">Deposite Request</a></li>
            <li>
                <a href="{{ route('admin.limitrequest') }}">
                    Limit Request <span class="badge badge-danger" style="background-color: darkred;">{{ ($totalLimit) ?? 0 }}</span>
                </a>
            </li>
            <li><a href="{{ route('create.expense') }}">Add Expense</a></li>
            <li>
                <a href="{{ route('admin.withdrawrequest') }}">
                    Withdraw Request <span class="badge badge-danger" style="background-color: darkred;">{{ ($totalWithdraw) ?? 0 }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
