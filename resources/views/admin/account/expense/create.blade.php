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
            <a href="{{ route('expense.list') }}" class="btn btn-sm btn-primary">
                Expense List
            </a>
        </p>
    </section>

    <section class="content">
        <!-- Expense Form -->
        <div class="row">

            @if(session('message'))
                <div class="alert alert-success" id="successAlert">{{ session('message') }}</div>
            @endif

            @if(session('errors'))
                <div class="alert alert-danger errorAlert">{{ session('errors') }}</div>
            @endif

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Office Expense</h3>
                    </div>
                    <form action="{{ route('expense.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Expense Head <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="expense_head">
                                @error('expense_head')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="expense-date">Date</label>
                                <input type="date" class="form-control" id="expense-date" name="expense_date" required>
                                @error('expense_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="expense-amount">Amount</label>
                                <input type="number" class="form-control" id="expense-amount" name="amount" step="0.01" required>
                                @error('amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="expense-category">Category</label>
                                <select class="form-control" id="expense-category" name="category" required>
                                    <option value="" disabled selected>Select Category</option>
                                    <option value="Office Supplies">Office Supplies</option>
                                    <option value="Travel">Travel</option>
                                    <option value="Utilities">Utilities</option>
                                    <option value="Miscellaneous">Miscellaneous</option>
                                </select>
                                @error('category')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="expense-description">Description</label>
                                <textarea class="form-control" id="expense-description" name="description" rows="3" required></textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="expense-receipt">Receipt</label>
                                <input type="file" class="form-control" id="expense-receipt" name="receipt">
                                @error('receipt')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
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

@endsection
