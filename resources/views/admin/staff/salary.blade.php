@extends('admin.layout.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <x-sub-header/>
            <h1>
                Dashboard
                <strong class="text-sm text-success fw-bold">Admin</strong>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{ $pageTitle }}</li>
            </ol>
            <p style="text-align: right;">
                <a class="btn btn-sm btn-primary" href="{{ route('staff.list') }}">Salary List</a>
            </p>
        </section>

        <section class="content">
            @if(session('message'))
                <div class="alert alert-success" id="successAlert">{{ session('message') }}</div>
            @endif

            @if(session('errors'))
                <div class="alert alert-danger errorAlert">{{ session('errors') }}</div>
            @endif

            <p style="text-align: right;">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#salaryModal">
                    Add Salary
                </button>
            </p>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee Name</th>
                            <th>Amount</th>
                            <th>Salary Month</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salaries as $salary)
                            <tr>
                                <td>{{ $salary->id }}</td>
                                <td>{{ $salary->employee->name }}</td>
                                <td>{{ number_format($salary->amount, 2) }}</td>
                                <td>{{ $salary->salary_month }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning editBtn"
                                        data-id="{{ $salary->id }}" data-employee="{{ $salary->employee->name }}"
                                        data-amount="{{ $salary->amount }}" data-month="{{ $salary->salary_month }}"
                                        data-toggle="modal" data-target="#salaryModal">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <div class="modal fade" id="salaryModal" tabindex="-1" role="dialog" aria-labelledby="salaryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="salaryModalLabel">Add/Update Salary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="salaryForm" action="{{ route('employee.salarystore') }}" method="POST">
                        @csrf
                        <input type="hidden" id="salaryId" name="id">
                        <div class="form-group">
                            <label for="employee">Employee</label>
                            <select id="employee" name="employee_id" class="form-control">
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" id="amount" class="form-control" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="salary_month">Salary Month</label>
                            <input type="month" id="salary_month" class="form-control" name="salary_month" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="{{ asset('admin/assets/js/watch.js') }}"></script>

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
        $(document).ready(function(){
            $('.editBtn').on('click', function(){
                var id = $(this).data('id');
                var employee = $(this).data('employee');
                var amount = $(this).data('amount');
                var month = $(this).data('month');

                $('#salaryId').val(id);
                $('#employee').val(employee);
                $('#amount').val(amount);
                $('#salary_month').val(month);
                $('#salaryForm').attr('action', '/admin/salaries/update/' + id);
            });
        });
    </script>

@endsection
