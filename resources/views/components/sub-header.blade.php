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
<h2 class="welcomeText" style="margin-top: 50px">{{ $greeting }}, {{ auth()->user()->name }}</h2>

<div id="actionDiv" style="position: fixed; top: 9%; border-radius: 4px; width: 80%;box-shadow: 0 0 10px rgba(0,0,0,0.1);z-index:1;">
    <div class="defaultMenubar">
        <div class="clock">
            <span id="time"></span>
            <br>
            <span id="date"></span>
        </div>

        <div class="menu-bar1">
            <ul class="menu1">
                <li>
                    <a href="{{ route('admin.despositerequest') }}">
                        Deposite Request <span class="badge badge-danger" style="background-color: darkred;">{{ ($totalDeposit) ?? 0 }}</span>
                    </a>
                </li>
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
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var actionDiv = document.getElementById('actionDiv');
        var initialOffset = actionDiv.getBoundingClientRect().top + window.scrollY;

        window.addEventListener('scroll', function() {
            var scrollTop = window.scrollY;

            if (scrollTop > initialOffset) {
                actionDiv.style.backgroundColor = 'aqua';
                actionDiv.style.top = '0';
            } else {
                actionDiv.style.backgroundColor = 'transparent';
                actionDiv.style.top = '10%';
            }
        });
    });
</script>
