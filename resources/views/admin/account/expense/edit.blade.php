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
                        <h3 class="box-title">Edit Office Expense</h3>
                    </div>
                    <form action="{{ route('expense.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="expense_id" value="{{ $expense->id }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="expense-head">Expense Head <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="expense-head" name="expense_head" value="{{ $expense->expense_head }}" required>
                                @error('expense_head')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="expense-date">Date</label>
                                <input type="date" class="form-control" id="expense-date" name="expense_date" value="{{ \Carbon\Carbon::parse($expense->expense_date)->format('Y-m-d') }}" required>
                                @error('expense_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="expense-amount">Amount</label>
                                <input type="number" class="form-control" id="expense-amount" name="amount" value="{{ $expense->amount }}" step="0.01" required>
                                @error('amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="expense-category">Category</label>
                                <select class="form-control" id="expense-category" name="category" required>
                                    <option value="" disabled>Select Category</option>
                                    <option value="Office Supplies" {{ $expense->expense_category == 'Office Supplies' ? 'selected' : '' }}>Office Supplies</option>
                                    <option value="Travel" {{ $expense->expense_category == 'Travel' ? 'selected' : '' }}>Travel</option>
                                    <option value="Utilities" {{ $expense->expense_category == 'Utilities' ? 'selected' : '' }}>Utilities</option>
                                    <option value="Miscellaneous" {{ $expense->expense_category == 'Miscellaneous' ? 'selected' : '' }}>Miscellaneous</option>
                                </select>
                                @error('category')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="expense-description">Description</label>
                                <textarea class="form-control" id="expense-description" name="description" rows="3" required>{{ $expense->description }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="expense-receipt">Receipt</label>
                                @if($expense->receipt_image)
                                    <div>
                                        <img src="{{ asset('storage/' . $expense->receipt_image) }}" alt="Receipt Image" style="max-width: 150px; height: auto;">
                                    </div>
                                @endif
                                <input type="file" class="form-control" id="expense-receipt" name="receipt">
                                <small class="form-text text-muted">Upload a new image if you want to replace the existing one.</small>
                                @error('receipt')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update Expense</button>
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
