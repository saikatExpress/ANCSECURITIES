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
                <a class="btn btn-sm btn-primary" href="{{ route('create.expense') }}">
                    Add Expense
                </a>
            </p>
        </section>

        <section class="content">

            @if(session('message'))
                <div class="alert alert-success" id="successAlert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Expense List</h3>
            </div>
            <div class="box-body">
                <form method="GET" action="{{ route('expense.list') }}" id="expenseForm">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="from_date">From Date</label>
                            <input type="date" class="form-control" id="from_date" name="from_date" value="{{ request('from_date') }}">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="to_date">To Date</label>
                            <input type="date" class="form-control" id="to_date" name="to_date" value="{{ request('to_date') }}">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="employee_id">Employee</label>
                            <select class="form-control" id="employee_id" name="employee_id">
                                <option value="All">All</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="status">Category</label>
                            <select class="form-control" id="category" name="category">
                                <option value="All">All</option>
                                <option value="Office Supplies" {{ request('category') == 'Office Supplies' ? 'selected' : '' }}>Office Supplies</option>
                                <option value="Travel" {{ request('category') == 'Travel' ? 'selected' : '' }}>Travel</option>
                                <option value="Utilities" {{ request('category') == 'Utilities' ? 'selected' : '' }}>Utilities</option>
                                <option value="Miscellaneous" {{ request('category') == 'Miscellaneous' ? 'selected' : '' }}>Miscellaneous</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">All</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="cancel" {{ request('status') == 'cancel' ? 'selected' : '' }}>Cancel</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2 align-self-end">
                            <button style="margin-top: 2.5rem;" type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <table id="expenseTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Staff Name</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Receipt</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                            <tr class="list-item">
                                <td>{{ $expense->id }}</td>
                                <td>{{ $expense->staff->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($expense->expense_date)->format('Y-m-d') }}</td>
                                <td>{{ $expense->amount }}</td>
                                <td>{{ $expense->expense_category }}</td>
                                <td>{{ $expense->description }}</td>
                                <td>
                                    @if ($expense->receipt_image)
                                        <a href="{{ asset('storage/' . $expense->receipt_image) }}" target="_blank">View Receipt</a>
                                    @else
                                        No Receipt
                                    @endif
                                </td>
                                @if ($expense->status === 'accepted')
                                    <td style="text-transform: uppercase;color:#fff;" class="btn btn-sm btn-success">
                                        {{ $expense->status }}
                                    </td>
                                @else
                                    <td style="text-transform: uppercase;color:#fff;" class="btn btn-sm btn-danger">
                                        {{ $expense->status }}
                                    </td>
                                @endif

                                <td>
                                    <a class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $expense->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('admin/assets/js/expense.js') }}"></script>

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
            $('#expenseForm').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'GET',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Update the table with the filtered data
                        $('#expenseTable tbody').html(response);
                    }
                });
            });
        });
    </script>

@endsection
