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
            @if(session('message'))
                <div class="alert alert-success" id="successAlert">{{ session('message') }}</div>
            @endif

            @if(session('errorMsg'))
                <div class="alert alert-danger errorAlert">{{ session('errorMsg') }}</div>
            @endif
            @if(session('errors'))
                <div class="alert alert-danger errorAlert">{{ session('errors') }}</div>
            @endif

            <div class="row">
                <div class="col-md-12">
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
                                        <th>Requisition Date</th>
                                        <th>Status</th>
                                        <th>Portfolio</th>
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
                                                @if ($limit->portfolio_file)
                                                    <a href="{{ asset('storage/' . $limit->portfolio_file) }}" class="btn btn-sm btn-primary" target="_blank">
                                                        <i class="fa-solid fa-eye"></i> View Portfolio
                                                    </a>
                                                @else
                                                    No Portfolio Attached
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary statusBtn"
                                                data-id="{{ $limit->id }}"
                                                data-toggle="modal" data-target="#updateModal">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <a href="{{ route('admin.viewwithdrawrequest', ['id' => $limit->id]) }}" class="btn btn-sm btn-warning">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
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

    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Withdrawl Request Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.updateReqStatus') }}" method="post">
                        @csrf
                        <input type="hidden" name="req_id" id="reqId">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option selected disabled value="">Select</option>
                                <option value="approved">Approve</option>
                                <option value="approved">Processing</option>
                                <option value="approved">Deny</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
    <script src="{{ asset('admin/assets/js/index.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('.statusBtn').on('click', function(){
                const reqId = $(this).data('id');

                if(reqId != null){
                    $('#reqId').val(reqId);
                }
            });
        });
    </script>

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