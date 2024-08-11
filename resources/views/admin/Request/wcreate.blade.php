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
                <a class="btn btn-sm btn-primary" href="{{ route('staff.list') }}">Withdraw Request List</a>
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

            <div class="row">
                <div class="col-md-7 offset-md-3" id="withdrawRequest">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <h4 class="card-title">Withdraw Request</h4>
                            </div>

                            <form action="{{ route('manual.withdraw_request') }}" method="post">
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
                                <h4 class="card-title">Withdraw Reqeust List</h4>
                            </div>

                            <table class="styled-table">
                                @php
                                    $sl = 1;
                                @endphp
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>AC NO</th>
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
                                            <td>{{ $limit->ac_no }}</td>
                                            <td>{{ number_format($limit->amount, 2) }}</td>
                                            <td>{{ formatDateTime($limit->withdraw_date) }}</td>
                                            <td style="text-transform: uppercase;">
                                                <label for="" class="btn btn-sm btn-danger">
                                                    {{ $limit->status }}
                                                </label>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary editBtn" data-toggle="modal" data-target="#exampleModal"
                                                 data-id="{{ $limit->id }}" data-name="{{ $limit->clients->name }}" data-amount="{{ $limit->limit_amount }}"
                                                  data-trading_code="{{ $limit->trade_id }}" data-status="{{ $limit->status }}"
                                                   data-client_id="{{ $limit->client_id }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" data-id="{{ $limit->id }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @php
                                            $sl++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="{{ asset('admin/assets/js/watch.js') }}"></script>
    <script src="{{ asset('admin/assets/js/index.js') }}"></script>
@endsection
