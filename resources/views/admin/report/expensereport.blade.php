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
                <form action="{{ route('expense.report') }}" method="GET">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="from-date">From Date</label>
                            <input type="date" class="form-control" id="from-date" name="from_date" value="{{ request()->get('from_date') }}">
                        </div>
                        <div class="form-group">
                            <label for="to-date">To Date</label>
                            <input type="date" class="form-control" id="to-date" name="to_date" value="{{ request()->get('to_date') }}">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Daily Expenses</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('expense.report.download', ['type' => 'pdf', 'from_date' => request()->get('from_date'), 'to_date' => request()->get('to_date')]) }}" class="btn btn-sm btn-danger">Download PDF</a>
                        {{-- <a href="{{ route('expense.report.download', ['type' => 'excel', 'from_date' => request()->get('from_date'), 'to_date' => request()->get('to_date')]) }}" class="btn btn-sm btn-success">Download Excel</a> --}}
                    </div>
                </div>
                <div class="box-body">
                    <table id="expense-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Category</th>
                                <th>Entry By</th>
                                <th>Description</th>
                                <th>Receipt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $expense)
                                <tr>
                                    <td>{{ $expense->id }}</td>
                                    <td>{{ $expense->expense_date }}</td>
                                    <td>{{ $expense->amount }}</td>
                                    <td>{{ $expense->expense_category }}</td>
                                    <td>{{ $expense->staff->name }}</td>
                                    <td>{{ $expense->description }}</td>
                                    <td>
                                        @if($expense->receipt_image)
                                            <a href="{{ asset('storage/' . $expense->receipt_image) }}" target="_blank">View Receipt</a>
                                        @endif
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
