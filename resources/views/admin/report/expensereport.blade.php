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
                <a href="{{ route('create.expense') }}" class="btn btn-sm btn-primary">
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

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Search Expenses</h3>
                </div>
                <form action="{{ route('expense.report') }}" method="GET" id="expenseForm1">
                    <div class="form-row">
                        <div class="box-body">
                            <div class="form-group col-md-2">
                                <label for="from-date">From Date</label>
                                <input type="date" class="form-control" id="from-date" name="from_date" value="{{ request()->get('from_date') }}">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="to-date">To Date</label>
                                <input type="date" class="form-control" id="to-date" name="to_date" value="{{ request()->get('to_date') }}">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="employee_id">Employee</label>
                                <select class="form-control" id="employee_id" name="employee_id">
                                    <option value="All" {{ request('employee_id') == 'All' ? 'selected' : '' }}>All</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="All" {{ request('category') == 'All' ? 'selected' : '' }}>All</option>
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
                    </div>
                </form>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Daily Expenses</h3>
                    <div class="box-tools pull-right">
                        <a id="pdfDownload" href="#" class="btn btn-sm btn-danger">Download PDF</a>
                        <a id="excelDownload" href="#" class="btn btn-sm btn-success">Download Excel</a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="expense-table" class="table table-bordered table-striped">
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateDownloadLinks() {
                var form = document.getElementById('expenseForm1');
                var formData = new FormData(form);
                var queryParams = new URLSearchParams(formData).toString();

                var pdfLink = document.getElementById('pdfDownload');
                var excelLink = document.getElementById('excelDownload');

                pdfLink.href = `{{ route('expense.report.download') }}?${queryParams}&type=pdf`;
                excelLink.href = `{{ route('expense.report.download') }}?${queryParams}&type=excel`;
            }

            // Update download links on page load
            updateDownloadLinks();

            // Update download links when form is submitted
            document.getElementById('expenseForm1').addEventListener('submit', function(e) {
                e.preventDefault();
                updateDownloadLinks();
                this.submit();
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

            $('#expenseForm1').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'GET',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Update the table with the filtered data
                        $('#expense-table tbody').html(response);
                    }
                });
            });
        });
    </script>

@endsection
