@extends('admin.layout.app')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <x-sub-header/>
            <h1>
                Dashboard
                <strong class="text-sm text-success fw-bold" style="text-transform: uppercase;">{{ auth()->user()->role }}</strong>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{ $pageTitle }}</li>
            </ol>
            <p style="text-align: right;">
                <a class="btn btn-sm btn-primary" href="{{ route('admin.withdrawlist') }}">Withdraw Request List</a>
            </p>
        </section>

        <section class="content">
            @if ($errors->any())
                <div class="alert alert-danger errorAlert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if(session('message'))
                <div class="alert alert-success" id="successAlert">{{ session('message') }}</div>
            @endif
            @if(session('errors'))
                <div class="alert alert-danger errorAlert">{{ session('errors') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger errorAlert">{{ session('error') }}</div>
            @endif

            <div class="row" style="background-color: #fff;border-radius: 4px;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                <div class="col-md-7 offset-md-3" id="withdrawRequest">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <h4 class="card-title">Withdraw Request</h4>
                            </div>

                            <form action="{{ route('withdrawrequeststore') }}" method="post">
                                @csrf
                                <input type="hidden" name="client_id" id="wclient_id">
                                <div class="form-group" id="form-group-code">
                                    <label for="">Trading Code : <span class="text-danger">*</span></label>
                                    <input type="text" name="trading_code" id="wtrading_code" class="form-control">
                                    @error('trading_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group" id="form-group-name">
                                    <label for="">Name : <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="wname" class="form-control">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group" id="form-group-mobile">
                                    <label for="">Mobile : <span class="text-danger">*</span></label>
                                    <input type="text" name="mobile" id="wmobile" class="form-control">
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group" id="form-group-amount">
                                    <label for="">Amount : <span class="text-danger">*</span></label>
                                    <input type="text" name="amount" id="amount" class="form-control">
                                    @error('amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group" id="form-group-bank">
                                    <label for="">Bank Account No : <span class="text-danger">*</span></label>
                                    <input type="text" name="bank_account" id="wbank_account" class="form-control">
                                    @error('bank_account')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group" id="form-group-date">
                                    <label for="">Withdraw Date : <span class="text-danger">*</span></label>
                                    <input type="date" name="withdraw_date" id="date" class="form-control">
                                    @error('withdraw_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" id="saveBtn" class="btn btn-sm btn-primary">Commit Info</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <h4 class="card-title">Today Withdraw Reqeust List</h4>
                            </div>

                            <form action="" method="post">
                                @csrf
                                <table class="styled-table">
                                    @php
                                        $sl = 1;
                                    @endphp
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($withdraws as $limit)
                                            <tr>
                                                <td>{{ $sl }}</td>
                                                <td>{{ $limit->clients->name }}</td>
                                                <td>{{ $limit->clients->trading_code }}</td>
                                                <td>{{ number_format($limit->amount, 2) }}</td>
                                                <td>{{ formatDateTime($limit->withdraw_date) }}</td>
                                                <td>
                                                    @if ($limit->status === 'approved')
                                                        <label for="" class="btn btn-sm btn-success" style="font-size: 8px; margin-bottom:0;">
                                                            {{ ucfirst($limit->status) }}
                                                        </label>
                                                    @else
                                                        <label for="" class="btn btn-sm btn-danger" style="font-size: 8px; margin-bottom:0;">
                                                            {{ ucfirst($limit->status) }}
                                                        </label>
                                                    @endif

                                                </td>
                                                <td>
                                                    <button style="font-size: 8px; margin-bottom:0%;" type="button" class="btn btn-sm btn-primary editBtn"
                                                        data-toggle="modal" data-target="#exampleModal"
                                                        data-id="{{ $limit->id }}" data-name="{{ $limit->clients->name }}" data-amount="{{ $limit->amount }}"
                                                        data-trading_code="{{ $limit->trade_id }}" data-status="{{ $limit->status }}"
                                                        data-client_id="{{ $limit->client_id }}">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @php
                                                $sl++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.withdrawupdate') }}" method="post">
                        @csrf
                        <input type="hidden" id="limitId" name="reqId">
                        <div class="form-group">
                            <label for="wname">Name</label>
                            <input type="text" id="withdrawname" class="form-control" name="name" disabled>
                        </div>
                        <div class="form-group">
                            <label for="wamount">Amount</label>
                            <input type="text" id="wamount" class="form-control" name="amount">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="{{ asset('admin/assets/js/watch.js') }}"></script>
    <script src="{{ asset('admin/assets/js/index.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#successAlert').show();

            setTimeout(function() {
                $('#successAlert').fadeOut('slow');
            }, 3000);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.errorAlert').show();

            setTimeout(function() {
                $('.errorAlert').fadeOut('slow');
            }, 3000);
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.editBtn').on('click', function(){
                var limitId  = $(this).data('id');
                var name     = $(this).data('name');
                var amount   = $(this).data('amount');
                var clientId = $(this).data('client_id');

                $('#limitId').val(limitId);
                $('#withdrawname').val(name);
                $('#wamount').val(amount);
                $('#clientId').val(clientId);
            });
        });
    </script>
@endsection
