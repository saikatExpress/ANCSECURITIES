
@extends('admin.layout.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <x-sub-header/>
            <h1>
                Dashboard
                <strong class="text-sm text-success fw-bold" style="text-transform: uppercase;">{{ auth()->user()->role }}</strong>
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

                @if(session('message'))
                    <div class="alert alert-success" id="successAlert">{{ session('message') }}</div>
                @endif

                @if(session('errors'))
                    <div class="alert alert-danger errorAlert">{{ session('errors') }}</div>
                @endif
                @if(session('errorMsg'))
                    <div class="alert alert-danger errorAlert">{{ session('errorMsg') }}</div>
                @endif

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


                @if (auth()->user()->role === 'it' || auth()->user()->role === 'admin' || auth()->user()->role === 'account')
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green">
                                <i style="margin-top: 20px;" class="fa-solid fa-code-pull-request"></i>
                            </span>

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
                            <i style="margin-top: 20px;" class="fa-solid fa-money-bill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Deposit</span>
                            <span class="info-box-number">{{ number_format($totalDeposit) }}</span>
                            <span >This Month : {{ $thisMonthDepositCount }} | Total : {{ $totalDepositCount }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="{{ route('user.list') }}">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow">
                                <i style="margin-top: 20px;" class="ion ion-ios-people-outline"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Clients</span>
                                <span class="info-box-number">{{ number_format($totalUsers) }}</span>
                                <span style="color: green;">Active : <span class="badge badge-success">{{ $activeUsers }}</span></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            @if (auth()->user()->role !== 'md')
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
            @endif

            @if (auth()->user()->role === 'hr' || auth()->user()->role === 'admin' || auth()->user()->role === 'ceo' || auth()->user()->role === 'Business Head')
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
                                    <td>
                                        @if ($expense->status === 'approved')
                                            <label for="" style="font-size: 8px; margin-bottom:0;" class="btn btn-sm btn-success" >
                                                {{ ucfirst($expense->status) }}
                                            </label>
                                        @else
                                            <label style="font-size: 8px; margin-bottom:0;" for="" class="btn btn-sm btn-danger" >
                                                {{ ucfirst($expense->status) }}
                                            </label>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button style="font-size: 8px; margin-bottom:0;" class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton-{{ $expense->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                            <button type="button" style="font-size: 8px; margin-bottom:0;" class="btn btn-sm btn-secondary expenseAssignBtn" data-id="{{ $expense->id }}">
                                                Assigned
                                            </button>
                                        @elseif ($expense->assign_to_ceo == 2 && $expense->assign_to_hr == 2)
                                            <button type="button" style="font-size: 8px; margin-bottom:0;" class="btn btn-sm btn-success expenseAssignBtn" data-id="{{ $expense->id }}">
                                                Download
                                            </button>
                                        @elseif($expense->assign_to_ceo == null && $expense->assign_to_hr == null)
                                            <button type="button" style="font-size: 8px; margin-bottom:0;" class="btn btn-sm btn-warning expenseAssignBtn" data-id="{{ $expense->id }}">
                                                Assign
                                            </button>
                                        @endif
                                        <br>
                                        @if ($expense->assign_to_ceo == null)
                                            <span class="text-sm text-warning" style="font-size: 8px; margin-bottom:0;">not assign CEO</span> <br>
                                        @elseif ($expense->assign_to_ceo == 1)
                                            <span style="color:red;" class="text-sm" style="font-size: 8px; margin-bottom:0;">Left from CEO</span> <br>
                                        @elseif ($expense->assign_to_ceo == 2)
                                            <span style="color:green;" class="text-sm" style="font-size: 8px; margin-bottom:0;">Complete from CEO</span> <br>
                                        @endif
                                        @if ($expense->assign_to_hr == null)
                                            <span class="text-sm text-warning" style="font-size: 8px; margin-bottom:0;">not assign HR</span>
                                        @elseif ($expense->assign_to_hr == 1)
                                            <span style="color:red;" class="text-sm" style="font-size: 8px; margin-bottom:0;">Left from HR</span>
                                        @elseif ($expense->assign_to_hr == 2)
                                            <span style="color:green;" class="text-sm" style="font-size: 8px; margin-bottom:0;">Complete from HR</span> <br>
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

            @if (auth()->user()->role === 'md')
                <div class="row">
                    <div class="col-md-12">
                        <h4 style="background-color: teal;color: #fff;padding: 5px 8px 5px;border-radius: 4px;width: 20%;text-align: center;">Withdraw Request List</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>AC NO</th>
                                    <th>Requisition Date</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @php
                                        $sl = 1;
                                    @endphp
                                @foreach ($withdraws as $withdraw)
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>{{ $withdraw->client_name }}</td>
                                        <td>{{ $withdraw->ac_no }}</td>
                                        <td>{{ \Carbon\Carbon::parse($withdraw->withdraw_date)->format('Y-m-d') }}</td>
                                        <td>{{ $withdraw->amount }}</td>
                                        <td>
                                            <a href="{{ route('admin.viewwithdrawrequest', ['id' => $withdraw->id]) }}" class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
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

            @if (auth()->user()->role === 'account' || auth()->user()->role === 'Business Head')
                <div class="row">
                    <div class="col-md-12">
                        <h4 style="background-color: teal;color: #fff;padding: 5px 8px 5px;border-radius: 4px;width: 20%;text-align: center;">
                            Withdraw Request
                        </h4>
                        <button id="markAll" class="btn btn-warning btn-sm">Mark All</button>
                        <button id="makeFile" class="btn btn-primary btn-sm">Make File</button>
                        <a href="{{ route('make.withdrawpdf') }}" id="viewFile" class="btn btn-success btn-sm">View PDF File</a>
                        <span id="errMessage" class="text-danger text-sm"></span>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox"></th>
                                            <th>ID</th>
                                            <th>Client Name</th>
                                            <th>Amount</th>
                                            <th>Code</th>
                                            <th>AC No</th>
                                            <th>Withdraw Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wrequests as $withdrawal)
                                            <tr>
                                                <td><input type="checkbox" class="item-checkbox" data-id="{{ $withdrawal->id }}"></td>
                                                <td>{{ $withdrawal->id }}</td>
                                                <td>{{ $withdrawal->clients->name }}</td>
                                                <td>{{ number_format($withdrawal->amount, 2) }} Taka</td>
                                                <td>{{ $withdrawal->clients->trading_code }}</td>
                                                <td>{{ $withdrawal->ac_no }}</td>
                                                <td>{{ \Carbon\Carbon::parse($withdrawal->withdraw_date)->format('m/d/y') }}</td>
                                                <td>
                                                    @if (auth()->user()->role === 'Business Head')
                                                        @if ($withdrawal->approved_by != null)
                                                            <span style="background-color: tomato;" class="badge">
                                                                {{ ucfirst('proccesing...') }}
                                                            </span>
                                                            @if ($withdrawal->ceostatus != null)
                                                                @if ($withdrawal->ceostatus === 'approved')
                                                                    <p style="margin-bottom: 0; font-size: 8px; color:green;">CEO approval done</p>
                                                                @elseif ($withdrawal->ceostatus === 'decline')
                                                                    <p style="margin-bottom: 0; font-size: 8px; color:tomato;">CEO approval declined</p>
                                                                    <p style="margin-bottom: 0;">{{ $withdrawal->remark }}</p>
                                                                @endif
                                                            @else
                                                                <p style="margin-bottom: 0; font-size: 8px; color:red;">Waiting for CEO approval</p>
                                                            @endif
                                                            @if ($withdrawal->mdstatus != null)
                                                                @if ($withdrawal->mdstatus === 'approved')
                                                                    <p style="margin-bottom: 0; font-size: 8px; color:green;">MD approval done</p>
                                                                @elseif ($withdrawal->mdstatus === 'decline')
                                                                    <p style="margin-bottom: 0; font-size: 8px; color:tomato;">MD approval declined</p>
                                                                    <p style="margin-bottom: 0;">{{ $withdrawal->remark }}</p>
                                                                @endif
                                                            @else
                                                                <p style="margin-bottom: 0; font-size: 8px; color:red;">Waiting for MD approval</p>
                                                            @endif
                                                        @elseif ($withdrawal->declined_by != null)
                                                            <span style="background-color: darkred;" class="badge">
                                                                {{ ucfirst('declined') }}
                                                            </span>
                                                        @else
                                                            <span style="background-color: darkred;" class="badge">
                                                                {{ ucfirst($withdrawal->status) }}
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span style="background-color: darkred;" class="badge">
                                                            {{ ucfirst($withdrawal->status) }}
                                                        </span> <br>
                                                        @if ($withdrawal->ceostatus != null)
                                                            @if ($withdrawal->ceostatus === 'approved')
                                                                <p style="margin-bottom: 0; font-size: 8px; color:green;">CEO approval done</p>
                                                            @elseif ($withdrawal->ceostatus === 'decline')
                                                                <p style="margin-bottom: 0; font-size: 8px; color:tomato;">CEO approval declined</p>
                                                                <p style="margin-bottom: 0;">{{ $withdrawal->remark }}</p>
                                                            @endif
                                                        @else
                                                            <p style="margin-bottom: 0; font-size: 8px; color:red;">Waiting for CEO approval</p>
                                                        @endif
                                                        @if ($withdrawal->mdstatus != null)
                                                            @if ($withdrawal->mdstatus === 'approved')
                                                                <p style="margin-bottom: 0; font-size: 8px; color:green;">MD approval done</p>
                                                            @elseif ($withdrawal->mdstatus === 'decline')
                                                                <p style="margin-bottom: 0; font-size: 8px; color:tomato;">MD approval declined</p>
                                                                <p style="margin-bottom: 0;">{{ $withdrawal->remark }}</p>
                                                            @endif
                                                        @else
                                                            <p style="margin-bottom: 0; font-size: 8px; color:red;">Waiting for MD approval</p>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (auth()->user()->role === 'account')
                                                        <button type="button" class="btn btn-sm btn-warning withdrawBtn"
                                                            data-id="{{ $withdrawal->id }}"
                                                            data-toggle="modal" data-target="#exampleModal">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-primary withdrawStatusBtn"
                                                            data-id="{{ $withdrawal->id }}"
                                                            data-toggle="modal" data-target="#statusModal">
                                                            <i class="fa-regular fa-chart-bar"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (auth()->user()->role === 'Business Head' || auth()->user()->role === 'hr')
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
                                        <td>
                                            @if ($expense->status === 'approved')
                                                <label for="" class="btn btn-sm btn-success">
                                                    {{ ucfirst($expense->status) }}
                                                </label>
                                            @else
                                                <label for="" class="btn btn-sm btn-danger">
                                                    {{ ucfirst($expense->status) }}
                                                </label>
                                            @endif

                                        </td>
                                        <td>
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
                                        <td class="">
                                            <label for="" class="btn btn-sm btn-danger" style="margin-bottom: 0%; font-size:10px;">
                                                {{ ucfirst($expense->status) }}
                                            </label>
                                        </td>
                                    @elseif ($expense->status === 'accepted')
                                        <td>
                                            <label for="" class="btn btn-sm btn-success" style="margin-bottom: 0%; font-size:10px;">
                                                {{ ucfirst($expense->status) }}
                                            </label>
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

            <div id="notificationContainer" style="position: fixed; top: 10px; right: 10px; z-index: 9999; width: 300px;">
                <!-- Notifications will be appended here -->
            </div>

        </section>
    </div>
    <audio id="notificationSound" src="{{ asset('admin/assets/audio/notification.mp3') }}" preload="auto"></audio>

    <!-- Modal -->
    <div id="imageModal" style="display: none;">
        <div>
            <span id="modalClose" style="cursor: pointer;">&times;</span>
            <img id="modalImage" src="" style="width: 100%; height: auto;">
            <a id="downloadLink" href="" download class="btn btn-primary" style="display: block; margin-top: 10px;">Download</a>
        </div>
    </div>

    <!-- Modal Structure -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Withdraw Request Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <h4>MD Status : <span id="mdStatus" class="btn btn-sm">Complete</span></h4>
                                <h4>CEO Status : <span id="ceoStatus" class="btn btn-sm btn-success">Complete</span></h4>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Client Name:</strong> <span id="clientName"></span></p>
                            <p><strong>Amount:</strong> <span id="amount"></span></p>
                            <p><strong>Account Number:</strong> <span id="acNo"></span></p>
                            <p><strong>Description:</strong> <span id="description"></span></p>
                            <p><strong>Withdraw Date:</strong> <span id="withdrawDate"></span></p>

                            <h4>Portfolio : <b id="portfolioText"></b></h4>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Mobile:</strong> <span id="mobile"></span></p>
                            <p><strong>Email:</strong> <span id="email"></span></p>
                            <p><strong>Code:</strong> <span id="tradeCode"></span></p>
                            <p><strong>Status:</strong> <span id="status"></span></p>
                            <p><strong>Feedback:</strong> <span id="feedback"></span></p>
                            <p><strong>Remark:</strong> <span id="remark"></span></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('upload.portfolio') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="reqId" id="reqId">
                        <div class="form-group">
                            <label for="">Assign Portfolio</label>
                            <input type="file" class="form-control" name="portfolio_file" id="portfolio_file">
                            @error('portfolio_file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Withdraw Request Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="itemBody" class="item_body">

                    </div>
                </div>
                <div class="modal-footer" id="modalfooter">
                    <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin/assets/js/attendance.js') }}"></script>
    <script src="{{ asset('admin/assets/js/expense.js') }}"></script>
    <script src="{{ asset('admin/assets/js/index.js') }}"></script>
    <script src="{{ asset('admin/assets/js/watch.js') }}"></script>
    <script src="{{ asset('admin/assets/js/withdraw.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    {{-- @if (auth()->user()->role === 'it' || auth()->user()->role === 'account' || auth()->user()->role === 'hr')
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
                                var newRequests = [];

                                response.forEach(function(request) {
                                    var requestId = request.id;

                                    if (displayedRequests.indexOf(requestId) === -1) {
                                        newRequests.push(requestId);

                                        var tradingCode = request.clients.trading_code;
                                        var amount = request.limit_amount;

                                        var alertDiv = $('<div class="alert alert-info" style="display: block; margin:5px 5px 5px;">');
                                        alertDiv.data('requestId', requestId);
                                        alertDiv.append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
                                        alertDiv.append('<h4>' + request.clients.name + ' sent you a limit request..!</h4>');
                                        alertDiv.append('<span>Trading Code : <b style="color: purple;font-size: 17px;">' + tradingCode + '</b></span> <strong style="">Amount : <b style="color: purple;font-size: 17px;">' + amount + '</b></strong> <br>');
                                        alertDiv.append('<button class="btn btn-sm btn-primary limitAcceptBtn" data-id="' + requestId + '">Accept</button>');
                                        alertDiv.append('<button class="btn btn-sm btn-danger limitDeclineBtn" data-id="' + requestId + '" style="margin-left:10px;">Deny</button>');

                                        $('#notificationContainer').append(alertDiv);

                                        displayedRequests.push(requestId);
                                    }
                                });

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

                $('#notificationContainer').on('click', '.limitAcceptBtn', function() {
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

                $('#notificationContainer').on('click', '.limitDeclineBtn', function() {
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

                $(document).on('click', '#notificationContainer button.close', function() {
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
    @endif --}}

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


