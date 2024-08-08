
@extends('admin.layout.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<style>
     #imageModal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #imageModal div {
        background: #fff;
        padding: 20px;
        position: relative;
    }
    #modalClose {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
    }
    .table.table-striped.table-bordered th{
        font-size: 12px;
    }
    .table.table-striped.table-bordered td{
        font-size: 12px;
        font-weight: 600;
    }
</style>
<style>
    .welcomeText {
        font-size: 24px;
        font-weight: bold;
        color: blue;
        border-bottom: 2px solid gray;
        padding: 5px 0px 7px;
    }

    .clock {
        font-size: 24px;
        font-weight: bold;
        margin-top: 10px;
    }

    .bg-teal {
        background-color: teal;
    }

    .text-white {
        color: #fff;
    }

    .p-2 {
        padding: 0.5rem;
    }

    .rounded {
        border-radius: 4px;
    }

    .text-success {
        color: #28a745;
    }

    .fa-dollar-sign {
        color: #28a745;
    }

    .fa-list-alt {
        color: #fff;
    }

    .mr-2 {
        margin-right: 0.5rem;
    }

    .bg-light {
        background-color: #f8f9fa; /* Light gray background */
    }

    .p-3 {
        padding: 1rem;
    }

</style>
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
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
            <div class="clock">
                <span id="time"></span>
            </div>
            <h1>
                Dashboard
                <strong class="text-sm text-success fw-bold">Admin</strong>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Info boxes -->
            <div class="row">

                <div class="col-md-3 col-sm-6 col-xs-12">

                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-time-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-weight: 600;color:#28a745;">Daily Attendance</span>
                            <span style="color: #f39c12; font-weight: bold;" id="punch-in-time"></span>
                            <span style="color: blue; font-weight: bold;" id="punch-out-time"></span>
                            @if ($todayAttendance)
                                <span style="color: #f39c12; font-weight: bold;">Punch in: {{ formatTimeWithAmPm($todayAttendance->in_time) }}</span><br>
                                @if ($todayAttendance->out_time != null)
                                    <span style="color: darkred; font-weight: bold;">Punch Out: {{ formatTimeWithAmPm($todayAttendance->in_time) }}</span>
                                @endif
                            @endif

                            <div class="attendance-form">
                                <form id="attendanceForm1" action="{{ route('empattendance.store') }}" method="POST">
                                    @csrf
                                    @if ($todayAttendance && $todayAttendance->in_time != null && $todayAttendance->out_time != null)
                                        <p style="color: #2e0cec;">Congratulations! Your today's attendance has been recorded successfully.</p>
                                    @else
                                        <div class="form-group">
                                            <label for="start-time">Start Time</label>
                                            <input type="time" id="start-time" name="start_time" class="form-control" @if($todayAttendance) disabled @endif required>
                                        </div>

                                        @if ($todayAttendance)
                                            <div class="form-group">
                                                <label for="end-time">End Time</label>
                                                <input type="time" id="end-time" name="out_time" class="form-control" @if($todayAttendance->out_time) disabled @endif required>
                                            </div>
                                            <button type="submit" class="btn btn-warning">Punch Out</button>
                                        @else
                                            <button type="submit" class="btn btn-primary">Punch In</button>
                                        @endif
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i style="margin-top: 20px;" class="fa fa-clock-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Working Hours</span>
                            <span class="info-box-number">
                                @php
                                    use Carbon\Carbon;

                                    // Get current month and year
                                    $currentMonth = now()->month;
                                    $currentYear = now()->year;

                                    // Initialize Carbon instance for the first day of the current month
                                    $startDate = Carbon::createFromDate($currentYear, $currentMonth, 1);

                                    // Calculate total number of days in the current month
                                    $daysInMonth = $startDate->daysInMonth;

                                    // Initialize counter for weekdays
                                    $weekdaysCount = 0;

                                    // Loop through each day of the month to count weekdays (excluding Fridays and Saturdays)
                                    for ($day = 1; $day <= $daysInMonth; $day++) {
                                        $date = Carbon::createFromDate($currentYear, $currentMonth, $day);

                                        // Check if the day is not Friday (5) and not Saturday (6)
                                        if ($date->dayOfWeek !== Carbon::FRIDAY && $date->dayOfWeek !== Carbon::SATURDAY) {
                                            $weekdaysCount++;
                                        }
                                    }

                                    // Calculate total working hours (assuming 9 hours per weekday)
                                    $totalMonthHours = $weekdaysCount * 9;
                                @endphp
                                @if(is_numeric($totalHours))
                                    {{ number_format($totalHours, 2) .' / ' . $totalMonthHours }} Hours
                                @else
                                    {{ $totalHours .'/' . 300 }}
                                @endif
                            </span>
                            <span>This Month</span>
                        </div>
                    </div>
                </div>

                <div class="clearfix visible-sm-block"></div>


                @if (auth()->user()->role === 'it' || auth()->user()->role === 'admin')
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        @if(session('message'))
                            <div class="alert alert-success" id="successAlert">{{ session('message') }}</div>
                        @endif

                        @if(session('errors'))
                            <div class="alert alert-danger errorAlert">{{ session('errors') }}</div>
                        @endif
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i style="margin-top: 20px;" class="ion ion-ios-clock-outline"></i></span>

                            <a href="{{ route('today.limit_request') }}">
                                <div class="info-box-content">
                                    <span class="info-box-text">Todays Limits</span>
                                    <span class="info-box-number">{{ $totalRequests ?? 0 }} / Amount : {{ number_format($totalAmount) }}</span>
                                    <span id="currentDateTime"></span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif

                <div class="col-md-3 col-sm-6 col-xs-12">
                    @if(session('message'))
                        <div class="alert alert-success" id="successAlert">{{ session('message') }}</div>
                    @endif

                    @if(session('errors'))
                        <div class="alert alert-danger errorAlert">{{ session('errors') }}</div>
                    @endif
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i style="margin-top: 20px;" class="ion ion-ios-cart-outline"></i></span>

                        <a href="{{ route('todays.expense') }}">
                            <div class="info-box-content">
                                <span class="info-box-text">Todays Expense</span>
                                <span class="info-box-number">{{ number_format($todayCost,2) ?? 0 }}</span>
                                <span id="currentDateTime"></span>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow">
                            <i class="ion ion-ios-people-outline"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Clients</span>
                            <span class="info-box-number">{{ number_format($totalUsers) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            @if (count($notifications) > 0)
                <div class="row">
                    <div class="ticker-container">
                        <div class="ticker">
                            @foreach ($notifications as $notification)
                                @if ($notification['type'] == 'limit')
                                    <div class="ticker-item">
                                        <a style="color: #fff;" href="{{ route('today.limit_request') }}">
                                            <i class="fa fa-exclamation-circle text-aqua"></i> New Limit Request from {{ $notification['data']->clients->name }}<br>
                                            <i class="fa fa-code text-info"></i> Trading Code: {{ $notification['data']->clients->trading_code }}<br>
                                            <i class="fa fa-money text-success"></i> Amount: <span style="font-weight:bold;">{{ $notification['data']->limit_amount }}</span>
                                        </a>
                                    </div>
                                @elseif($notification['type'] == 'withdraw')
                                    <div class="ticker-item">
                                        <a style="color: #fff;" href="{{ route('withdraw.request') }}">
                                            <i class="fa fa-money text-yellow"></i> New Withdraw Request from {{ $notification['data']->clients->name }}<br>
                                            <i class="fa fa-code text-info"></i> Trading Code: {{ $notification['data']->clients->trading_code }}<br>
                                            <i class="fa fa-money text-success"></i> Amount: <span style="font-weight:bold;">{{ $notification['data']->amount }}</span>
                                        </a>
                                    </div>
                                @elseif($notification['type'] == 'deposit')
                                    <div class="ticker-item">
                                        <a style="color: #fff;" href="{{ route('deposit.request') }}">
                                            <i class="fa fa-bank text-green"></i> New Deposit from {{ $notification['data']->clients->name }}<br>
                                            <i class="fa fa-code text-info"></i> Trading Code: {{ $notification['data']->clients->trading_code }}<br>
                                            <i class="fa fa-money text-success"></i> Amount: <span style="font-weight:bold;">{{ $notification['data']->amount }}</span>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            @if (auth()->user()->role === 'hr' || auth()->user()->role === 'admin' || auth()->user()->role === 'ceo')
                <div class="row">
                    <div class="col-md-12">
                        <div style="display: flex;align-items: center;justify-content: space-between;">
                            <h4 style="background-color: teal;color: #fff;padding: 5px 8px 5px;border-radius: 4px;width: 20%;text-align: center;">Daily Attendance List</h4>
                            <button id="updateAllButton" class="btn btn-sm btn-primary">Update All</button>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->id }}</td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->mobile }}</td>
                                        <td>
                                            @if($employee->in_time)
                                                <input type="time" id="in-time-{{ $employee->id }}" class="form-control" value="{{ $employee->in_time }}">
                                            @else
                                                <input type="time" id="in-time-{{ $employee->id }}" class="form-control">
                                            @endif
                                        </td>
                                        <td>
                                            @if($employee->in_time)
                                                <input type="time" id="out-time-{{ $employee->id }}" class="form-control" value="{{ $employee->out_time }}">
                                            @else
                                                <input type="time" id="out-time-{{ $employee->id }}" class="form-control">
                                            @endif
                                        </td>
                                        <td id="status-{{ $employee->id }}">
                                            @if ($employee->status === null)
                                                <p class="btn btn-danger btn-sm">Pending</p>
                                            @elseif ($employee->status === 'leave')
                                                <p class="btn btn-primary btn-sm">Leave</p>
                                            @else
                                                <p class="btn btn-success btn-sm">Accepted</p>
                                            @endif
                                            <button class="btn btn-warning btn-sm" onclick="updateAttendanceStatus({{ $employee->id }}, 'Updated')">Update</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <div class="row">
                @if (auth()->user()->role === 'account')
                    <div class="col-md-8">
                        <div class="d-flex align-items-center justify-content-between mb-3 p-3 bg-light rounded">
                            <h4 class="bg-teal text-white p-2 rounded" style="width: 20%; text-align: center;">
                                <i class="fa fa-list-alt mr-2"></i> Expense List
                            </h4>
                            <div class="d-flex align-items-center">
                                <i class="fa fa-dollar-sign fa-2x mr-2 text-success"></i>
                                <p class="mb-0">
                                    <strong>Your Available Balance:</strong>
                                    <span class="text-success">{{ ($balance->initial_balance) ?? 0 }}</span>
                                </p>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Expense Head</th>
                                    <th>Expense Date</th>
                                    <th>Amount</th>
                                    <th>Receipt Image</th>
                                    <th>Entry By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Assign</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach ($pendingExpenses as $expense)
                                <tr>
                                    <td>{{ $sl }}</td>
                                    <td>{{ $expense->expense_head }}</td>
                                    <td>{{ \Carbon\Carbon::parse($expense->expense_date)->format('Y-m-d') }}</td>
                                    <td>{{ $expense->amount }}</td>

                                    <td>
                                        <a href="{{ asset('storage/'.$expense->receipt_image) }}" data-lightbox="expense-image" data-title="Receipt Image">
                                            <img src="{{ asset('storage/'.$expense->receipt_image) }}" alt="Receipt Image" style="width: 30px; height: 30px; border-radius: 50%;">
                                        </a>
                                    </td>

                                    <td>{{ $expense->staff->name }}</td>
                                    <td class="btn btn-sm btn-danger" style="color:#fff;">{{ ucfirst($expense->status) }}</td>
                                    <td>
                                        <!-- Action Dropdown Menu -->
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton-{{ $expense->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $expense->id }}">
                                                <p>
                                                    <a class="dropdown-item" href="#" data-id="{{ $expense->id }}" data-status="pending" onclick="updateStatus(event)">Pending</a>
                                                </p>
                                                <p>
                                                    <a class="dropdown-item" href="#" data-id="{{ $expense->id }}" data-status="accepted" onclick="updateStatus(event)">Accepted</a>
                                                </p>
                                                <p>
                                                    <a class="dropdown-item" href="#" data-id="{{ $expense->id }}" data-status="cancel" onclick="updateStatus(event)">Cancel</a>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($expense->assign_to_ceo == 1 || $expense->assign_to_hr == 1)
                                            <button type="button"  class="btn btn-sm btn-secondary expenseAssignBtn" data-id="{{ $expense->id }}">
                                                Assigned
                                            </button>
                                        @elseif ($expense->assign_to_ceo  == 2 && $expense->assign_to_hr == 2)
                                            <button type="button"  class="btn btn-sm btn-success expenseAssignBtn" data-id="{{ $expense->id }}">
                                                Download
                                            </button>
                                        @elseif($expense->assign_to_ceo == null && $expense->assign_to_hr == null)
                                            <button type="button"  class="btn btn-sm btn-warning expenseAssignBtn" data-id="{{ $expense->id }}">
                                                Assign
                                            </button>
                                        @endif
                                        <br>
                                        @if ($expense->assign_to_ceo == null)
                                            <span class="text-sm text-warning">not assign CEO</span> <br>
                                        @elseif ($expense->assign_to_ceo == 1)
                                            <span style="color:red;" class="text-sm">Left from CEO</span> <br>
                                        @elseif ($expense->assign_to_ceo == 2)
                                            <span style="color:green;" class="text-sm">Complete from CEO</span> <br>
                                        @endif
                                        @if ($expense->assign_to_hr == null)
                                            <span class="text-sm text-warning">not assign HR</span>
                                        @elseif ($expense->assign_to_hr == 1)
                                            <span style="color:red;" class="text-sm">Left from HR</span>
                                        @elseif ($expense->assign_to_hr == 2)
                                            <span style="color:green;" class="text-sm">Complete from HR</span> <br>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $sl++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="col-md-4">
                    @if (count($todayWorks) > 0)
                        <div class="d-flex align-items-center justify-content-between mb-3 p-3 bg-light rounded">
                            <h4 class="bg-teal text-white p-2 rounded" style="width: 50%; text-align: center;">
                                <i class="fa fa-clipboard-list mr-2"></i> Your Work List
                            </h4>
                            <div class="d-flex align-items-center">
                                <p class="mb-0">
                                    <strong><i class="fa fa-clock mr-1"></i> Time Remaining:</strong>
                                    <span class="text-success" id="timeRemaining">

                                    </span>
                                </p>
                            </div>
                        </div>
                        <div style="background-color: #fff;border-radius: 4px;padding: 5px 8px 5px;">
                            @foreach($todayWorks as $work)
                                <div class="work-item mb-3" style="box-shadow: 0 0 10px rgba(0,0,0,0.1);margin:5px;padding: 5px 8px 5px;border-radius: 4px;background-color: #fff;color: #000;">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="work-title mb-0">{{ $work->work_title }}</h5>
                                        <span class="badge badge-primary" style="background-color: red;">{{ $work->work_status }}</span>
                                    </div>
                                    <p class="mb-0 mt-2">
                                        <strong>Category:</strong> {{ $work->category }}
                                    </p>
                                    <p class="mb-0">
                                        <strong>Assigned Date:</strong> {{ \Carbon\Carbon::parse($work->assign_work_date)->format('M d, y |  h:i A') }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            @if (auth()->user()->role === 'ceo' || auth()->user()->role === 'hr')
                <div class="row">
                    <div class="col-md-12">
                        <h4 style="background-color: teal;color: #fff;padding: 5px 8px 5px;border-radius: 4px;width: 20%;text-align: center;">Waiting Expense Approval</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Expense Date</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Receipt Image</th>
                                    <th>Entry By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Assign</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @php
                                        $sl = 1;
                                    @endphp
                                @foreach ($waitingExpenses as $expense)
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>{{ \Carbon\Carbon::parse($expense->expense_date)->format('Y-m-d') }}</td>
                                        <td>{{ $expense->amount }}</td>
                                        <td>{{ $expense->description }}</td>
                                        <td>
                                            <a href="{{ asset('storage/'.$expense->receipt_image) }}" data-lightbox="expense-image" data-title="Receipt Image">
                                                <img src="{{ asset('storage/'.$expense->receipt_image) }}" alt="Receipt Image" style="width: 50px; height: 50px; border-radius: 50%;">
                                            </a>
                                        </td>
                                        <td>{{ $expense->staff->name }}</td>
                                        <td class="btn btn-sm btn-danger" style="color:#fff;">{{ ucfirst($expense->status) }}</td>
                                        <td>
                                            <!-- Action Dropdown Menu -->
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton-{{ $expense->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $expense->id }}">
                                                    <p>
                                                        <a class="dropdown-item" href="#" data-id="{{ $expense->id }}" data-status="pending" onclick="updateStatus(event)">Pending</a>
                                                    </p>
                                                    <p>
                                                        <a class="dropdown-item" href="#" data-id="{{ $expense->id }}" data-status="accepted" onclick="updateStatus(event)">Accepted</a>
                                                    </p>
                                                    <p>
                                                        <a class="dropdown-item" href="#" data-id="{{ $expense->id }}" data-status="cancel" onclick="updateStatus(event)">Cancel</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($expense->assign_to_ceo != null && $expense->assign_to_hr != null)
                                                <button type="button"  class="btn btn-sm btn-secondary expenseAssignBtn" data-id="{{ $expense->id }}">
                                                    Assigned
                                                </button>
                                            @else
                                                <button type="button"  class="btn btn-sm btn-success expenseAssignBtn" data-id="{{ $expense->id }}">
                                                    Assign
                                                </button>
                                            @endif
                                            <br>
                                            @if ($expense->assign_to_ceo == null)
                                                <span class="text-sm text-warning">not assign CEO</span> <br>
                                            @elseif ($expense->assign_to_ceo == 1)
                                                <span style="color:red;" class="text-sm">Left from CEO</span> <br>
                                            @elseif ($expense->assign_to_ceo == 2)
                                                <span style="color:green;" class="text-sm">Complete from CEO</span> <br>
                                            @endif
                                            @if ($expense->assign_to_hr == null)
                                                <span class="text-sm text-warning">not assign HR</span>
                                            @elseif ($expense->assign_to_hr == 1)
                                                <span style="color:red;" class="text-sm">Left from HR</span>
                                            @elseif ($expense->assign_to_hr == 2)
                                                <span style="color:green;" class="text-sm">Complete from HR</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                        $sl++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if (count($authUserExpense) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <h4 style="background-color: teal;color: #fff;padding: 5px 8px 5px;border-radius: 4px;width: 20%;text-align: center;">Your Expense</h4>

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Expense Head</th>
                                    <th>Expense Date</th>
                                    <th>Amount</th>
                                    <th>Category</th>
                                    <th>Receipt Image</th>
                                    <th>Entry By</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach ($authUserExpense as $expense)
                                <tr>
                                    <td>{{ $sl }}</td>
                                    <td>{{ $expense->expense_head }}</td>
                                    <td>{{ \Carbon\Carbon::parse($expense->expense_date)->format('Y-m-d') }}</td>
                                    <td>{{ $expense->amount }}</td>
                                    <td>{{ $expense->expense_category }}</td>
                                    <td>
                                        <a href="{{ asset('storage/'.$expense->receipt_image) }}" data-lightbox="expense-image" data-title="Receipt Image">
                                            <img src="{{ asset('storage/'.$expense->receipt_image) }}" alt="Receipt Image" style="width: 30px; height: 30px; border-radius: 50%;">
                                        </a>
                                    </td>
                                    <td>{{ $expense->staff->name }}</td>
                                    @if ($expense->status === 'pending')
                                        <td class="btn btn-sm btn-danger" style="color:#fff;">{{ ucfirst($expense->status) }}</td>
                                    @elseif ($expense->status === 'accepted')
                                        <td class="btn btn-sm btn-success" style="color:#fff;">
                                            {{ ucfirst($expense->status) }}
                                        </td>
                                    @else

                                    @endif
                                </tr>
                                @php
                                    $sl++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if (auth()->user()->role === 'admin')
                <div class="row">
                    <div class="col-md-12">
                        <h4 style="background-color: teal;color: #fff;padding: 5px 8px 5px;border-radius: 4px;width: 20%;text-align: center;">Daily Activities of Employees</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allStaffs as $staff)
                                    <tr>
                                        <td>{{ $staff->name }}</td>
                                        <td>{{ $staff->email }}</td>
                                        <td>
                                            <a href="{{ url('staff.activities', ['id' => $staff->id]) }}" class="btn btn-primary btn-sm">View Activities</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if (auth()->user()->role === 'admin')
                <div class="row">
                    <!-- Left col -->
                    <div class="col-md-8">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Visitors Report</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-md-9 col-sm-8">
                                    <div class="pad">
                                        <!-- Map will be created here -->
                                        <div id="world-map-markers" style="height: 325px;"></div>
                                    </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-sm-4">
                                    <div class="pad box-pane-right bg-green" style="min-height: 280px">
                                        <div class="description-block margin-bottom">
                                        <div class="sparkbar pad" data-color="#fff">90,70,90,70,75,80,70</div>
                                        <h5 class="description-header">8390</h5>
                                        <span class="description-text">Visits</span>
                                        </div>
                                        <!-- /.description-block -->
                                        <div class="description-block margin-bottom">
                                        <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                                        <h5 class="description-header">30%</h5>
                                        <span class="description-text">Referrals</span>
                                        </div>
                                        <!-- /.description-block -->
                                        <div class="description-block">
                                            <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                                            <h5 class="description-header">70%</h5>
                                            <span class="description-text">Organic</span>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- /.box -->
                        <div class="row">
                            <div class="col-md-6">
                            <!-- DIRECT CHAT -->
                            <div class="box box-warning direct-chat direct-chat-warning">
                                <div class="box-header with-border">
                                <h3 class="box-title">Direct Chat</h3>

                                <div class="box-tools pull-right">
                                    <span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">3</span>
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts"
                                            data-widget="chat-pane-toggle">
                                    <i class="fa fa-comments"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                    </button>
                                </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages">
                                    <!-- Message. Default to the left -->
                                    <div class="direct-chat-msg">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left">Alexander Pierce</span>
                                        <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    <img class="direct-chat-img" src="{{ asset('admin/assets/dist/img/user1-128x128.jpg') }}" alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        Is this template really for free? That's unbelievable!
                                    </div>
                                    <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                        <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    <img class="direct-chat-img" src="{{ asset('admin/assets/dist/img/user3-128x128.jpg') }}" alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        You better believe it!
                                    </div>
                                    <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    <!-- Message. Default to the left -->
                                    <div class="direct-chat-msg">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left">Alexander Pierce</span>
                                        <span class="direct-chat-timestamp pull-right">23 Jan 5:37 pm</span>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    <img class="direct-chat-img" src="{{ asset('admin/assets/dist/img/user1-128x128.jpg') }}" alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        Working with AdminLTE on a great new app! Wanna join?
                                    </div>
                                    <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                        <span class="direct-chat-timestamp pull-left">23 Jan 6:10 pm</span>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    <img class="direct-chat-img" src="{{ asset('admin/assets/dist/img/user3-128x128.jpg') }}" alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        I would love to.
                                    </div>
                                    <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                </div>
                                <!--/.direct-chat-messages-->

                                <!-- Contacts are loaded here -->
                                <div class="direct-chat-contacts">
                                    <ul class="contacts-list">
                                    <li>
                                        <a href="#">
                                        <img class="contacts-list-img" src="{{ asset('admin/assets/dist/img/user1-128x128.jpg') }}" alt="User Image">

                                        <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                Count Dracula
                                                <small class="contacts-list-date pull-right">2/28/2015</small>
                                                </span>
                                            <span class="contacts-list-msg">How have you been? I was...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    <!-- End Contact Item -->
                                    <li>
                                        <a href="#">
                                        <img class="contacts-list-img" src="{{ asset('admin/assets/dist/img/user7-128x128.jpg') }}" alt="User Image">

                                        <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                Sarah Doe
                                                <small class="contacts-list-date pull-right">2/23/2015</small>
                                                </span>
                                            <span class="contacts-list-msg">I will be waiting for...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    <!-- End Contact Item -->
                                    <li>
                                        <a href="#">
                                        <img class="contacts-list-img" src="{{ asset('admin/assets/dist/img/user3-128x128.jpg') }}" alt="User Image">

                                        <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                Nadia Jolie
                                                <small class="contacts-list-date pull-right">2/20/2015</small>
                                                </span>
                                            <span class="contacts-list-msg">I'll call you back at...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    <!-- End Contact Item -->
                                    <li>
                                        <a href="#">
                                        <img class="contacts-list-img" src="dist/img/user5-128x128.jpg" alt="User Image">

                                        <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                Nora S. Vans
                                                <small class="contacts-list-date pull-right">2/10/2015</small>
                                                </span>
                                            <span class="contacts-list-msg">Where is your new...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    <!-- End Contact Item -->
                                    <li>
                                        <a href="#">
                                        <img class="contacts-list-img" src="dist/img/user6-128x128.jpg" alt="User Image">

                                        <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                John K.
                                                <small class="contacts-list-date pull-right">1/27/2015</small>
                                                </span>
                                            <span class="contacts-list-msg">Can I take a look at...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    <!-- End Contact Item -->
                                    <li>
                                        <a href="#">
                                        <img class="contacts-list-img" src="dist/img/user8-128x128.jpg" alt="User Image">

                                        <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                Kenneth M.
                                                <small class="contacts-list-date pull-right">1/4/2015</small>
                                                </span>
                                            <span class="contacts-list-msg">Never mind I found...</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    <!-- End Contact Item -->
                                    </ul>
                                    <!-- /.contatcts-list -->
                                </div>
                                <!-- /.direct-chat-pane -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                <form action="#" method="post">
                                    <div class="input-group">
                                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                    <span class="input-group-btn">
                                            <button type="button" class="btn btn-warning btn-flat">Send</button>
                                        </span>
                                    </div>
                                </form>
                                </div>
                                <!-- /.box-footer-->
                            </div>
                            <!--/.direct-chat -->
                            </div>
                            <!-- /.col -->

                            <div class="col-md-6">
                            <!-- USERS LIST -->
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Latest Members</h3>

                                    <div class="box-tools pull-right">
                                        <span class="label label-danger">{{ count($latestUsers) }} New Members</span>
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="box-body no-padding">
                                    <ul class="users-list clearfix">
                                        @if (count($latestUsers) > 0)
                                            @foreach ($latestUsers as $user)
                                                <li>
                                                    @if ($user->profile_image == NULL)
                                                        <img src="{{ asset('admin/assets/dist/img/user1-128x128.jpg') }}" alt="User Image">
                                                    @else
                                                        <img src="{{ asset('storage/user_photo/' . $user->profile_image) }}" alt="User Image">
                                                    @endif
                                                    <a class="users-list-name" href="#">
                                                        {{ $user->name }}
                                                    </a>
                                                    <span class="users-list-date">{{ $user->created_at }}</span>
                                                </li>
                                            @endforeach
                                        @else
                                            <li>
                                                <img src="{{ asset('admin/assets/dist/img/user8-128x128.jpg') }}" alt="User Image">
                                                <a class="users-list-name" href="#">Norman</a>
                                                <span class="users-list-date">Yesterday</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="box-footer text-center">
                                    <a href="javascript:void(0)" class="uppercase">View All Users</a>
                                </div>
                            </div>
                            <!--/.box -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- TABLE: LATEST ORDERS -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Latest Orders</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Item</th>
                                    <th>Status</th>
                                    <th>Popularity</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                    <td>Call of Duty IV</td>
                                    <td><span class="label label-success">Shipped</span></td>
                                    <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                    <td>Samsung Smart TV</td>
                                    <td><span class="label label-warning">Pending</span></td>
                                    <td>
                                    <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                    <td>iPhone 6 Plus</td>
                                    <td><span class="label label-danger">Delivered</span></td>
                                    <td>
                                    <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                    <td>Samsung Smart TV</td>
                                    <td><span class="label label-info">Processing</span></td>
                                    <td>
                                    <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                    <td>Samsung Smart TV</td>
                                    <td><span class="label label-warning">Pending</span></td>
                                    <td>
                                    <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                    <td>iPhone 6 Plus</td>
                                    <td><span class="label label-danger">Delivered</span></td>
                                    <td>
                                    <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                    <td>Call of Duty IV</td>
                                    <td><span class="label label-success">Shipped</span></td>
                                    <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                    </td>
                                </tr>
                                </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                            <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-md-4">
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Inventory</span>
                                <span class="info-box-number">5,200</span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 50%"></div>
                                </div>
                                <span class="progress-description">
                                    50% Increase in 30 Days
                                </span>
                            </div>
                        </div>

                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Mentions</span>
                            <span class="info-box-number">92,050</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 20%"></div>
                            </div>
                            <span class="progress-description">
                                20% Increase in 30 Days
                            </span>
                        </div>
                    </div>

                    <div class="info-box bg-red">
                        <span class="info-box-icon">
                            <i class="ion ion-ios-cloud-download-outline"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Downloads</span>
                            <span class="info-box-number">114,381</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                                70% Increase in 30 Days
                            </span>
                        </div>
                    </div>

                    <div class="info-box bg-aqua">
                        <span class="info-box-icon">
                            <i class="ion-ios-chatbubble-outline"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Direct Messages</span>
                            <span class="info-box-number">163,921</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 40%"></div>
                            </div>
                            <span class="progress-description">
                                40% Increase in 30 Days
                            </span>
                        </div>
                    </div>

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Browser Usage</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="chart-responsive">
                                        <div id="barChart" class="bar-chart"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <ul class="legend">
                                        <li><span class="color-box" style="background-color: #FF6384;"></span> Chrome</li>
                                        <li><span class="color-box" style="background-color: #36A2EB;"></span> IE</li>
                                        <li><span class="color-box" style="background-color: #FFCE56;"></span> Firefox</li>
                                        <li><span class="color-box" style="background-color: #4BC0C0;"></span> Safari</li>
                                        <li><span class="color-box" style="background-color: #9966FF;"></span> Opera</li>
                                        <li><span class="color-box" style="background-color: #C9CBCF;"></span> Navigator</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="box-footer no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a href="#">
                                        United States of America
                                        <span class="pull-right text-red">
                                            <i class="fa fa-angle-down"></i>
                                            12%
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        India
                                        <span class="pull-right text-green">
                                            <i class="fa fa-angle-up"></i>
                                            4%
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">China
                                        <span class="pull-right text-yellow">
                                            <i class="fa fa-angle-left"></i>
                                            0%
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>

                    <!-- PRODUCT LIST -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Recently Added Products</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            <li class="item">
                            <div class="product-img">
                                <img src="dist/img/default-50x50.gif" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Samsung TV
                                <span class="label label-warning pull-right">$1800</span></a>
                                <span class="product-description">
                                    Samsung 32" 1080p 60Hz LED Smart HDTV.
                                    </span>
                            </div>
                            </li>
                            <!-- /.item -->
                            <li class="item">
                            <div class="product-img">
                                <img src="dist/img/default-50x50.gif" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Bicycle
                                <span class="label label-info pull-right">$700</span></a>
                                <span class="product-description">
                                    26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                                    </span>
                            </div>
                            </li>
                            <!-- /.item -->
                            <li class="item">
                            <div class="product-img">
                                <img src="dist/img/default-50x50.gif" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Xbox One <span
                                    class="label label-danger pull-right">$350</span></a>
                                <span class="product-description">
                                    Xbox One Console Bundle with Halo Master Chief Collection.
                                    </span>
                            </div>
                            </li>
                            <!-- /.item -->
                            <li class="item">
                            <div class="product-img">
                                <img src="dist/img/default-50x50.gif" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">PlayStation 4
                                <span class="label label-success pull-right">$399</span></a>
                                <span class="product-description">
                                    PlayStation 4 500GB Console (PS4)
                                    </span>
                            </div>
                            </li>
                            <!-- /.item -->
                        </ul>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                        <a href="javascript:void(0)" class="uppercase">View All Products</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
            @endif

            <div id="limitRequestContainer" style="display: flex; flex-wrap:wrap;">

            </div>

        </section>
    </div>

    <!-- Modal -->
    <div id="imageModal" style="display: none;">
        <div>
            <span id="modalClose" style="cursor: pointer;">&times;</span>
            <img id="modalImage" src="" style="width: 100%; height: auto;">
            <a id="downloadLink" href="" download class="btn btn-primary" style="display: block; margin-top: 10px;">Download</a>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin/assets/js/attendance.js') }}"></script>
    <script src="{{ asset('admin/assets/js/expense.js') }}"></script>
    <!-- Lightbox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    @if (auth()->user()->role === 'it')
        <script>
            $(document).ready(function() {
                var displayedRequests = [];

                function fetchData() {
                    $.ajax({
                        url: '{{ route('fetch.limit.requests') }}',
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response && response.length > 0) {
                                var newRequests = []; // Array to store IDs of newly fetched requests

                                response.forEach(function(request) {
                                    var requestId = request.id;

                                    // Check if this request is already displayed
                                    if (displayedRequests.indexOf(requestId) === -1) {
                                        // If not displayed, add it to newRequests array and display
                                        newRequests.push(requestId);

                                        var tradingCode = request.clients.trading_code;
                                        var amount = request.limit_amount;

                                        var alertDiv = $('<div class="alert alert-info" style="display: block; margin:5px 5px 5px;">');
                                        alertDiv.data('requestId', requestId); // Store requestId in data attribute
                                        alertDiv.append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
                                        alertDiv.append('<h4>' + request.clients.name + ' sent you a limit request..!</h4>');
                                        alertDiv.append('<span>Trading Code : <b style="color: purple;font-size: 17px;">' + tradingCode + '</b></span> <strong style="">Amount : <b style="color: purple;font-size: 17px;">' + amount + '</b></strong> <br>');
                                        alertDiv.append('<button class="btn btn-sm btn-primary limitAcceptBtn" data-id="' + requestId + '">Accept</button>');
                                        alertDiv.append('<button class="btn btn-sm btn-danger limitDeclineBtn" data-id="' + requestId + '" style="margin-left:10px;">Deny</button>');

                                        // Append alertDiv to the container div
                                        $('#limitRequestContainer').append(alertDiv);

                                        // Add requestId to displayedRequests array
                                        displayedRequests.push(requestId);
                                    }
                                });

                                // Play notification sound if there are new requests
                                if (newRequests.length > 0) {
                                    var audio = document.getElementById('notificationSound');
                                    audio.play();
                                }
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                }

                fetchData();
                setInterval(fetchData, 5000);

                $('#limitRequestContainer').on('click', '.limitAcceptBtn', function() {
                    var requestId = $(this).data('id');
                    var clickedItem = $(this).closest('.alert');

                    if (requestId) {
                        $.ajax({
                            url: '/update/limit/request/' + requestId,
                            type: 'GET',
                            success: function(response) {
                                toastr.success('Limit request updated successfully');
                                clickedItem.fadeOut(function() {
                                    $(this).remove();
                                });
                            },
                            error: function(xhr) {
                                console.log(xhr);
                                toastr.error('Failed to update limit request');
                            }
                        });
                    }
                });

                $('#limitRequestContainer').on('click', '.limitDeclineBtn', function() {
                    var requestId = $(this).data('id');
                    var clickedItem = $(this).closest('.alert');

                    if (requestId) {
                        $.ajax({
                            url: '/decline/limit/request/' + requestId,
                            type: 'GET',
                            success: function(response) {
                                toastr.success('Limit request declined successfully');
                                clickedItem.fadeOut(function() {
                                    $(this).remove();
                                });
                            },
                            error: function(xhr) {
                                console.log(xhr);
                                toastr.error('Failed to update limit request');
                            }
                        });
                    }
                });

                // Close alert on button click
                $(document).on('click', '#limitRequestContainer button.close', function() {
                    var alertItem = $(this).closest('.alert');
                    alertItem.fadeOut();

                    // Remove the request ID from displayedRequests array
                    var requestId = alertItem.data('requestId');
                    displayedRequests = displayedRequests.filter(function(id) {
                        return id !== requestId;
                    });
                });
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#updateAllButton').click(function() {
                var updates = [];

                // Iterate through each table row (employee)
                $('tbody tr').each(function() {
                    var employeeId = $(this).find('td').eq(0).text();

                    var inTime = $(this).find('input[id^="in-time-"]').val();
                    var outTime = $(this).find('input[id^="out-time-"]').val();

                    var updateData = {
                        employeeId: employeeId,
                        inTime: inTime,
                        outTime: outTime
                    };

                    updates.push(updateData);
                });


                // Send updates to the server via AJAX
                $.ajax({
                    url: '/update-all-attendance',
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify({ updates: updates }),
                    success: function(response) {
                        if (response && response.success === true) {
                            toastr.success('All attendance records updated successfully!');
                            location.reload();
                        } else {
                            toastr.success('All attendance records updated successfully!');
                            location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Failed to update attendance records.');
                    }
                });
            });
        });
    </script>

    <script>
        function updateTimeRemaining() {
            var now = new Date();
            var targetTime = new Date();

            targetTime.setHours(18, 30, 0, 0);

            var diff = targetTime - now;

            if (diff > 0) {
                var hours = Math.floor(diff / (1000 * 60 * 60));
                var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));

                var timeRemainingStr = hours + "h " + minutes + "m";

                document.getElementById("timeRemaining").textContent = timeRemainingStr;
            } else {
                targetTime.setDate(targetTime.getDate() + 1);
                updateTimeRemaining();
            }
        }

        updateTimeRemaining();

        setInterval(updateTimeRemaining, 60000);
    </script>

    <script>
        const currentDate = new Date();

        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            hour12: true
        };

        const formattedDate = currentDate.toLocaleString('en-US', options);

        document.getElementById('currentDateTime').textContent = formattedDate;
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the current time
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');

            // Set the current time as the default value
            document.getElementById('start-time').value = hours + ':' + minutes;
            document.getElementById('end-time').value = hours + ':' + minutes;
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#attendanceForm1').on('submit', function(event) {
                event.preventDefault();

                var formData = $(this).serialize();
                var actionUrl = $(this).attr('action');

                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.error) {
                            toastr.error(response.error);
                        } else {
                            toastr.success(response.message);

                            if (response && response.in_time) {
                                var time = response.in_time;

                                var formattedTime = formatTimeWithAmPm(time);
                                $('#punch-in-time').text('Punch in: ' + formattedTime);
                            }

                            if(response && response.out_time){
                                var time = response.out_time;

                                var formattedTime = formatTimeWithAmPm(time);
                                $('#punch-out-time').text('Punch out: ' + formattedTime);
                                location.reload();
                            }

                            // Hide or disable fields based on response
                            if (response.message.includes('In Time')) {
                                $('#start-time').prop('disabled', true);
                                $('button[type="submit"]').text('Punch Out').removeClass('btn-primary').addClass('btn-warning');
                            } else {
                                $('#attendanceForm1').find('input').prop('disabled', true);
                                $('button[type="submit"]').hide();
                            }
                        }
                    },
                    error: function(xhr) {
                        toastr.error('Failed to record attendance. Please try again.');
                    }
                });
            });
        });

        function formatTimeWithAmPm(time) {
            // Parse the input time string (assumes format like "HH:MM")
            var parts = time.split(':');
            var hour = parseInt(parts[0]);
            var minute = parts[1];

            // Determine AM/PM and format hours
            var period = (hour >= 12) ? 'PM' : 'AM';
            hour = (hour > 12) ? hour - 12 : hour;
            hour = (hour == 0) ? 12 : hour; // Handle midnight (00:XX) as 12 AM

            // Construct formatted time string
            var formattedTime = hour + ':' + minute + ' ' + period;
            return formattedTime;
        }
    </script>

    <script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            document.getElementById('time').textContent = `${hours}:${minutes}:${seconds}`;
        }

        setInterval(updateClock, 1000); // Update the clock every second
        updateClock(); // Initial call to set the clock immediately
    </script>

    <script>
        $(document).ready(function() {
            // Show the alert message
            $('#successAlert').show();

            // Hide the alert message after 3 seconds
            setTimeout(function() {
                $('#successAlert').fadeOut('slow');
            }, 3000);
        });
    </script>
    <script>
        $(document).ready(function() {
            // Show the alert message
            $('.errorAlert').show();

            // Hide the alert message after 3 seconds
            setTimeout(function() {
                $('.errorAlert').fadeOut('slow');
            }, 3000);
        });
    </script>

    <script>
        function updateStatus(event) {
            event.preventDefault();

            var status = $(event.target).data('status');
            var expenseId = $(event.target).data('id');

            $.ajax({
                url: '{{ route('update-expense-status') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: expenseId,
                    status: status
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Status Updated',
                        text: 'Expense status updated successfully',
                        showConfirmButton: true
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Update Failed',
                        text: 'Failed to update the expense status',
                        showConfirmButton: true
                    });
                }
            });
        }
    </script>

@endsection


