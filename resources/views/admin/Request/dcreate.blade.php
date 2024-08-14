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
                <a class="btn btn-sm btn-primary" href="{{ route('deposit.request') }}">Deposit List</a>
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

            <div class="row justify-content-center">
                <div class="col-md-7 offset-md-3" id="despositeRequest">
                    <div style="background-color: #fff; padding: 10px; border-radius:4px; margin-bottom: 10px;">
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

                <div class="col-md-5 offset-md-3">
                    <div class="card shadow-lg">
                        <div class="card-header text-center">
                            <h3 class="mb-0">Deposite List</h3>
                        </div>
                        <div class="card-body">
                            <div class="search-container">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="depositTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>AC No</th>
                                            <th>Slip</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deposits as $deposit)
                                            <tr>
                                                <td>{{ $deposit->id }}</td>
                                                <td>{{ $deposit->clients->name }}</td>
                                                <td>{{ $deposit->amount }}</td>
                                                <td>{{ $deposit->ac_no }}</td>
                                                <td>
                                                    <a href="{{ asset('storage/' . $deposit->bank_slip) }}"
                                                        class="btn btn-sm btn-primary"
                                                        download="{{ basename($deposit->bank_slip) }}">
                                                        <i class="fa-solid fa-download"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($deposit->status === 'approved')
                                                        <label for="" style="margin-bottom: 0;" class="btn btn-sm btn-success">
                                                            {{ ucfirst($deposit->status) }}
                                                        </label>
                                                    @else
                                                        <button type="button" style="margin-bottom: 0;" class="btn btn-sm btn-danger actionBtn"
                                                            data-id="{{ $deposit->id }}"
                                                            data-toggle="modal" data-target="#statusModal">
                                                            {{ ucfirst($deposit->status) }} <i class="fa-solid fa-caret-down"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($deposit->withdraw_date)->format('d-m-Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Update Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('updatedpstatus.edit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="red_id" id="reqId">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-select form-control" required>
                                <option value="" selected disabled>Select</option>
                                <option value="pending" {{ $deposit->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $deposit->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $deposit->status == 'declined' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div style="margin-top: 20px;">
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </div>
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
    <script src="{{ asset('admin/assets/js/index.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#successAlert').show();

            setTimeout(function() {
                $('#successAlert').fadeOut('slow');
            }, 3000);

            $('.errorAlert').show();

            setTimeout(function() {
                $('.errorAlert').fadeOut('slow');
            }, 3000);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var filter = $(this).val().toLowerCase();

                $('#depositTable tbody tr').each(function() {
                    var row = $(this);
                    var cells = row.find('td');
                    var isMatch = false;

                    cells.each(function() {
                        if ($(this).text().toLowerCase().indexOf(filter) > -1) {
                            isMatch = true;
                            return false;
                        }
                    });

                    row.toggle(isMatch);
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.actionBtn').on('click', function(){
                const reqId = $(this).data('id');

                if(reqId != null){
                    $('#reqId').val(reqId);
                }
            });
        });
    </script>
@endsection
