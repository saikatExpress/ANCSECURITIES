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
                <a class="btn btn-sm btn-primary" href="{{ route('staff.list') }}">Limit List</a>
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
                <div class="col-md-12 offset-md-3" id="despositeRequest">
                    <div style="background-color: #DDD; padding: 10px; border-radius:4px; margin-bottom: 10px;">
                        <h4>Deposite Request</h4>
                        <form action="{{ route('manual.deposite_request') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="client_id" id="dclient_id">
                            <div class="form-group" id="form-group-code">
                                <label for="">Trading Code : <span class="text-danger">*</span></label>
                                <input type="text" name="trading_code" id="dtrading_code" class="form-control">
                            </div>
                            @error('trading_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group" id="form-group-name">
                                <label for="">Name : <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="dname" class="form-control">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group" id="form-group-mobile">
                                <label for="">Mobile : <span class="text-danger">*</span></label>
                                <input type="text" name="mobile" id="dmobile" class="form-control">
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
                                <input type="text" name="bank_account" id="dbank_account" class="form-control">
                                @error('bank_account')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group" id="form-group-slip">
                                <label for="">Bank Slip : <span class="text-danger">*</span></label>
                                <input type="file" name="bank_slip" id="bank_slip" class="form-control">
                                @error('bank_slip')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group" id="form-group-date">
                                <label for="">Deposite Date : <span class="text-danger">*</span></label>
                                <input type="date" name="deposite_date" id="date" class="form-control">
                                @error('deposite_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary">Commit Info</button>
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
    <script src="{{ asset('admin/assets/js/index.js') }}"></script>
@endsection
