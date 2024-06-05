@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
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
                <a class="btn btn-sm btn-primary" href="{{ route('staff.list') }}">
                    Attendance List
                </a>
            </p>
        </section>

        <section class="content">

            @if(session('message'))
                <div class="alert alert-success" id="successAlert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="attendaceBlock">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">File Import</label>
                        <input type="file" class="form-control-file" name="attendance_file">
                        <strong class="text-danger">File shoulde be Excel in <span class="text-sm text-success"> .xlxs </span> Format</strong>
                    </div>
                </form>
            </div>

            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Attedance</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('attendance.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="attendance_mark">
                                    <h1>Staff Attendance for {{ \Carbon\Carbon::now()->format('F Y') }}</h1>
                                    <div class="form-group">
                                        <label for="">Attendance Date : </label><br>
                                        <input type="date" name="attendance_date">
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <th>EMPLOYEE ID</th>
                                            <th>NAME</th>
                                            <th>IN TIME</th>
                                            <th>OUT TIME</th>
                                            <th>STATUS</th>
                                        </tr>

                                        @foreach ($staffs as $staff)
                                            <tr>
                                                <td>
                                                    <input name="staff_id[]" style="border: none; background-color:transparent;font-weight:600;font-size:16px;color:#000;" type="text" value="{{ $staff->id }}" readonly>
                                                </td>
                                                <td>
                                                    <input name="staff_name_{{ $staff->id }}" style="border: none; background-color:transparent;font-weight:600;font-size:16px;color:#000;" type="text" value="{{ $staff->name }}" readonly>
                                                </td>
                                                <td>
                                                    <input type="time" class="form-control" name="in_time_{{ $staff->id }}" value="09:30">
                                                </td>
                                                <td>
                                                    <input type="time" class="form-control" name="out_time_{{ $staff->id }}" value="18:30">
                                                </td>
                                                <td style="display: flex; align-items:center;">
                                                    <label class="status-switch">
                                                        <input name="attendance_status_{{ $staff->id }}" type="checkbox" checked>
                                                        <span class="slider"></span>
                                                    </label>
                                                    <p class="status-label status-present">Present</p>
                                                    <div class="absent-details">
                                                        <label for="leave-type-{{ $staff->id }}">Leave Type:</label>
                                                        <select name="leave-type-{{ $staff->id }}" id="leave-type-{{ $staff->id }}" class="form-control">
                                                            <option value="sick">Sick Leave</option>
                                                            <option value="casual">Casual Leave</option>
                                                            <option value="annual">Annual Leave</option>
                                                        </select>
                                                        <label for="leave-reason-{{ $staff->id }}">Reason:</label>
                                                        <input type="text" name="leave-reason-{{ $staff->id }}" class="form-control" id="leave-reason-{{ $staff->id }}">
                                                        <label for="half-day-{{ $staff->id }}">Half Day:</label>
                                                        <input type="checkbox" name="half-day-{{ $staff->id }}" id="half-day-{{ $staff->id }}">
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Create Attendance</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('.status-switch input').change(function() {
                var label = $(this).closest('td').find('.status-label');
                var absentDetails = $(this).closest('td').find('.absent-details');
                if (this.checked) {
                    label.text('Present');
                    label.removeClass('status-absent').addClass('status-present');
                    absentDetails.hide();
                } else {
                    label.text('Absent');
                    label.removeClass('status-present').addClass('status-absent');
                    absentDetails.show();
                }
            });
        });
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
@endsection
