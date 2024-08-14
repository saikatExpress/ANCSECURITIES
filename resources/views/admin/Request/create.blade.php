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
                <a class="btn btn-sm btn-primary" href="{{ route('today.limit_request') }}">Limit List</a>
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
                <div class="col-md-7">
                    <div class="card card-custom">
                        <div class="card-header">
                            <h4 class="card-title">Create Limit Request</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.limitstore') }}" method="post">
                                @csrf
                                <input type="hidden" name="client_id" id="client_id">
                                <div class="form-group">
                                    <label for="trading_code">Trading Code: <span class="text-danger">*</span></label>
                                    <input type="text" name="trading_code" id="trading_code" class="form-control">
                                    @error('trading_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="mobile">Mobile: <span class="text-danger">*</span></label>
                                    <input type="text" name="mobile" id="mobile" class="form-control">
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="amount">Amount: <span class="text-danger">*</span></label>
                                    <input type="text" name="amount" id="amount" class="form-control">
                                    @error('amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-sm btn-primary">Create Limit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <h4 class="card-title">Today Limit Request List</h4>
                            </div>

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
                                        <th>Action By</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($limitRequest as $limit)
                                        <tr>
                                            <td>{{ $sl }}</td>
                                            <td>{{ $limit->clients->name }}</td>
                                            <td>{{ $limit->trade_id }}</td>
                                            <td>{{ number_format($limit->limit_amount, 2) }}</td>
                                            <td>{!! $limit->approved_by ?? '<span style="color:red;font-size: 8px;margin-bottom:0%;">Not action</span>' !!}</td>
                                            <td>
                                                @if ($limit->status === 'approved')
                                                    <label style="font-size: 10px;margin-bottom:0;" for="" class="btn btn-sm btn-success">
                                                        {{ ucfirst($limit->status) }}
                                                    </label>
                                                @else
                                                    <label style="font-size: 10px;margin-bottom:0;" for="" class="btn btn-sm btn-danger">
                                                        {{ ucfirst($limit->status) }}
                                                    </label>
                                                @endif
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Limit Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.limitupdate') }}" method="post">
                        @csrf
                        <input type="hidden" name="req_id" id="req_id">
                        <input type="hidden" name="client_id" id="clientId">

                        <div class="form-group">
                            <label for="trading_code">Trading Code: <span class="text-danger">*</span></label>
                            <input type="text" name="trading_code" id="tradingCode" class="form-control">
                            @error('trading_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Name: <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="lname" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount: <span class="text-danger">*</span></label>
                            <input type="text" name="amount" id="lamount" class="form-control">
                            @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control">
                                <option value="" disabled selected>Select</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="decline">Declined</option>
                            </select>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="{{ asset('admin/assets/js/watch.js') }}"></script>
    <script src="{{ asset('admin/assets/js/limitrequest.js') }}"></script>

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

    <script>
        $(document).ready(function(){
            $('#trading_code').on('input', function(){
                const code = $(this).val();

                if(code != null){
                    $.ajax({
                        url: '/get/client/code/' + code,
                        type: 'GET',
                        success: function(response){
                            $('#client_id').val(response.user.id);
                            $('#name').val(response.tradeInfo.name);
                            $('#mobile').val(response.tradeInfo.cell_no);
                        },
                        error: function(error){
                            console.log(error);
                        }
                    });
                }
            });
        });
    </script>
@endsection
