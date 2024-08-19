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
            <div class="accountHead" style="display: flex;justify-content:space-between; align-items:center;">
                <p style="text-align: right;">
                    <a class="btn btn-sm btn-warning" href="{{ route('create.expense') }}">
                        Add Balance
                    </a>
                </p>
                <p style="text-align: right;">
                    <button class="btn btn-sm btn-warning" type="button" data-toggle="modal" data-target="#addAccountModal">
                        Add Account
                    </button>
                </p>
                <p style="text-align: right;">
                    <a class="btn btn-sm btn-warning" href="{{ route('create.expense') }}">
                        Account List
                    </a>
                </p>
            </div>
        </section>

        <section class="content">

            @if(session('message'))
                <div class="alert alert-success" id="successAlert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="box">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box-header">
                            <h3 class="box-title">Account Balance List</h3>
                        </div>
                        <div class="box-body">
                            {{-- <table id="expenseTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Staff Name</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Receipt</th>
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
                            </table> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box-header">
                            <h3 class="box-title">Account List</h3>
                        </div>
                        <div class="box-body">
                            <table id="expenseTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Account Name</th>
                                        <th>Account No</th>
                                        <th>Balance</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accounts as $account)
                                        <tr class="list-item">
                                            <td>{{ $account->id }}</td>
                                            <td>{{ $account->name }}</td>
                                            <td>{{ $account->account_number }}</td>
                                            <td>{{ $account->balance }}</td>
                                            <td style="text-transform: uppercase;">{{ $account->account_type }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary">
                                                    Edit
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $account->id }}">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Add Account Modal -->
    <div class="modal fade" id="addAccountModal" tabindex="-1" role="dialog" aria-labelledby="addAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAccountModalLabel">Create New Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addAccountForm" action="{{ route('account.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="accountName">Account Name</label>
                            <input type="text" class="form-control" id="accountName" name="name">
                            <span class="text-danger" id="error-name"></span>
                        </div>
                        <div class="form-group">
                            <label for="accountBalance">Balance</label>
                            <input type="number" step="0.01" class="form-control" id="accountBalance" name="balance">
                            <span class="text-danger" id="error-balance"></span>
                        </div>
                        <!-- Add similar error spans for other fields -->
                        <div class="form-group">
                            <label for="accountNumber">Account Number</label>
                            <input type="text" class="form-control" id="accountNumber" name="account_number">
                            <span class="text-danger" id="error-account_number"></span>
                        </div>
                        <div class="form-group">
                            <label for="bankName">Bank Name</label>
                            <input type="text" class="form-control" id="bankName" name="bank_name">
                            <span class="text-danger" id="error-bank_name"></span>
                        </div>
                        <div class="form-group">
                            <label for="branchName">Branch Name</label>
                            <input type="text" class="form-control" id="branchName" name="branch_name">
                            <span class="text-danger" id="error-branch_name"></span>
                        </div>
                        <div class="form-group">
                            <label for="ifscCode">IFSC Code</label>
                            <input type="text" class="form-control" id="ifscCode" name="ifsc_code">
                            <span class="text-danger" id="error-ifsc_code"></span>
                        </div>
                        <div class="form-group">
                            <label for="accountType">Account Type</label>
                            <select class="form-control" id="accountType" name="account_type">
                                <option value="">Select Account Type</option>
                                <option value="savings">Savings</option>
                                <option value="current">Current</option>
                                <option value="fixed_deposit">Fixed Deposit</option>
                                <option value="recurring_deposit">Recurring Deposit</option>
                                <option value="loan">Loan</option>
                                <option value="nre">NRE</option>
                                <option value="nro">NRO</option>
                            </select>
                            <span class="text-danger" id="error-account_type"></span>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
            $('#addAccountForm').on('submit', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Account Created',
                            text: 'Account created successfully',
                            showConfirmButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#addAccountModal').modal('hide');
                                location.reload();
                            }
                        });
                    },
                    error: function(xhr) {
                        $('.text-danger').html('');

                        if (xhr.status === 422) { // Validation error
                            let errors = xhr.responseJSON.errors;
                            for (let field in errors) {
                                $('#error-' + field).html(errors[field][0]);
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to create account'
                            });
                        }
                    }
                });
            });
        });
    </script>

@endsection
