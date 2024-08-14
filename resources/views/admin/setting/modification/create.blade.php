@extends('admin.layout.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <x-sub-header/>
        <h1>
            {{ $pageTitle }}
            <strong class="text-sm text-success fw-bold" style="text-transform: uppercase;">{{ auth()->user()->role }}</strong>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">{{ $pageTitle }}</li>
        </ol>
    </section>

    <section class="content">
        @if(session('message'))
            <div class="alert alert-success" id="successAlert">
                {{ session('message') }}
            </div>
        @endif

        <!-- Update Information Form -->
        <form id="updateForm" action="{{ route('update.information') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Select Investor:</label>
                <select id="" name="" class="form-control">
                    <option value="">-- Select --</option>
                    @foreach ($investors as $investor)
                        <option value="{{ $investor->id }}">{{ $investor->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="updateType">Select Information to Update:</label>
                <select id="updateType" name="updateType" class="form-control">
                    <option value="">-- Select --</option>
                    {{-- @foreach ($columns as $column)
                        <option value="name">{{ $column }}</option>
                    @endforeach --}}
                    <option value="name">Name</option>
                    <option value="email">Email</option>
                    <option value="trading_code">Trading Code</option>
                    <option value="bo_id">BO ID</option>
                    <option value="bank_account">Bank Account</option>
                </select>
            </div>

            <div id="updateFields" style="display: none;">
                <!-- Fields will be dynamically added here -->
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('admin/assets/js/watch.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#updateType').on('change', function() {
            const selectedValue = $(this).val();
            let fieldsHtml = '';

            switch(selectedValue) {
                case 'name':
                    fieldsHtml = `
                        <div class="form-group">
                            <label for="prevName">Previous Name:</label>
                            <input type="text" id="prevName" name="prevName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="newName">New Name:</label>
                            <input type="text" id="newName" name="newName" class="form-control" required>
                        </div>
                    `;
                    break;

                case 'email':
                    fieldsHtml = `
                        <div class="form-group">
                            <label for="prevEmail">Previous Email:</label>
                            <input type="email" id="prevEmail" name="prevEmail" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="newEmail">New Email:</label>
                            <input type="email" id="newEmail" name="newEmail" class="form-control" required>
                        </div>
                    `;
                    break;

                case 'trading_code':
                    fieldsHtml = `
                        <div class="form-group">
                            <label for="prevTradingCode">Previous Trading Code:</label>
                            <input type="text" id="prevTradingCode" name="prevTradingCode" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="newTradingCode">New Trading Code:</label>
                            <input type="text" id="newTradingCode" name="newTradingCode" class="form-control" required>
                        </div>
                    `;
                    break;

                case 'bo_id':
                    fieldsHtml = `
                        <div class="form-group">
                            <label for="prevBoId">Previous BO ID:</label>
                            <input type="text" id="prevBoId" name="prevBoId" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="newBoId">New BO ID:</label>
                            <input type="text" id="newBoId" name="newBoId" class="form-control" required>
                        </div>
                    `;
                    break;

                case 'bank_account':
                    fieldsHtml = `
                        <div class="form-group">
                            <label for="prevBankAccount">Previous Bank Account:</label>
                            <input type="text" id="prevBankAccount" name="prevBankAccount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="newBankAccount">New Bank Account:</label>
                            <input type="text" id="newBankAccount" name="newBankAccount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="branchName">Branch Name:</label>
                            <input type="text" id="branchName" name="branchName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="bankName">Bank Name:</label>
                            <input type="text" id="bankName" name="bankName" class="form-control" required>
                        </div>
                    `;
                    break;

                default:
                    fieldsHtml = '';
            }

            $('#updateFields').html(fieldsHtml).show();
        });

        $('#successAlert').show();
        setTimeout(function() {
            $('#successAlert').fadeOut('slow');
        }, 3000);
    });
</script>

@endsection
