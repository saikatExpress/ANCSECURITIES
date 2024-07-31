@extends('admin.layout.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <strong class="text-sm text-success fw-bold">Admin</strong>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">{{ $pageTitle }}</li>
        </ol>
        <p style="text-align: right;">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default">
                Add Gallery Items
            </button>
        </p>
    </section>

    <section class="content">
        <!-- Filter Form -->
        <div class="row" style="background-color: blanchedalmond; padding: 8px 10px 8px;">
            <div class="col-md-12">
                <form method="GET" action="{{ route('attendance.report') }}" class="form-inline">
                    <div class="form-group">
                        <label for="year">Year:</label>
                        <input type="number" id="year" name="year" class="form-control" value="{{ request()->year ?? now()->year }}" min="2000" max="{{ now()->year }}">
                    </div>
                    <div class="form-group">
                        <label for="month">Month:</label>
                        <select id="month" name="month" class="form-control">
                            @foreach(range(1, 12) as $m)
                                <option value="{{ $m }}" {{ (request()->month == $m ? 'selected' : '') }}>
                                    {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="employee">Employee:</label>
                        <select name="employee" id="employee" class="form-control">
                            <option value="" {{ !request()->employee ? 'selected' : '' }}>Select</option>
                            @foreach ($staffs as $staff)
                                <option value="{{ $staff->id }}" {{ request()->employee == $staff->id ? 'selected' : '' }}>
                                    {{ $staff->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>

        <!-- Attendance Report -->
        <div class="row" style="background-color: #fff;">
            <div class="col-md-12">
                <div style="display: flex; align-items:center; justify-content:space-between">
                    <h3>Attendance Report for
                        {{ request()->month ? DateTime::createFromFormat('!m', request()->month)->format('F') : 'Today' }}
                        {{ request()->year ?? now()->year }}
                        @if (request()->employee)
                            (Employee: {{ $staffs->find(request()->employee)->name }})
                        @endif
                    </h3>

                    <div>
                        <button class="btn btn-sm btn-primary">Export PDF</button>
                        <button class="btn btn-sm btn-success">Export Excel</button>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>In Time</th>
                            <th>Out Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendanceReports as $report)
                            <tr>
                                <td>{{ $report->user->name }}</td>
                                <td>{{ $report->user->mobile }}</td>
                                <td>{{ $report->formatted_in_time  ?? 'N/A' }}</td>
                                <td>{{ $report->formatted_out_time  ?? 'N/A' }}</td>
                                <td>{{ $report->status ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No attendance records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

@endsection
