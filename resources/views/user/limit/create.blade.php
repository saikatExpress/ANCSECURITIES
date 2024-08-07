@extends('authuser.layout.app')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
@section('content')
<section id="main-container" class="main-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Trade Limit Request</h3>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div id="success-message" class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div id="error-message" class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('limit.request_store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="client_id">Client Trade ID <span class="text-danger">*</span></label>
                                <input type="text" id="client_id" name="client_id" class="form-control" value="{{ auth()->user()->trading_code }}" required>
                                @error('client_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="client_name">Client Name <span class="text-danger">*</span></label>
                                <input type="text" id="client_name" name="client_name" class="form-control" value="{{ auth()->user()->name }}" required>
                                @error('client_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="requested_limit">Requested Limit Amount <span class="text-danger">*</span></label>
                                <input type="number" id="requested_limit" name="requested_limit" class="form-control" placeholder="Enter requested limit amount" required>
                                @error('requested_limit')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="reason">Reason for Request <span class="text-danger">*</span></label>
                                <textarea id="reason" name="reason" class="form-control" rows="4" placeholder="Enter the reason for your request" required></textarea>
                                @error('reason')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Submit Request</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-5">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">Request History</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Client Trade ID</th>
                                        <th>Client Name</th>
                                        <th>Requested Limit</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl = 1;
                                    @endphp
                                    @foreach ($requests as $request)
                                        <tr>
                                            <td>{{ $sl }}</td>
                                            <td>{{ $request->client_name }}</td>
                                            <td>{{ $request->limit_amount }}</td>
                                            <td>{{ $request->created_at->format('d-m-Y') }}</td>
                                            <td style="text-transform: uppercase;" class="text-danger">{{ $request->status }}</td>
                                            <td>
                                                @if ($request->status == 'pending' || $request->status == 'canceled')
                                                    <button type="submit" class="btn btn-sm btn-danger cancelButton" data-id="{{ $request->id }}">
                                                        Cancel
                                                    </button>
                                                    @if ($request->status === 'canceled')
                                                        <p style="margin-bottom: 0; font-size:12px;color:darkred;">
                                                            Something wrong...Please cancel this request and try again new..!
                                                        </p>
                                                    @endif

                                                    @if ($request->status == 'pending')
                                                        <p style="margin-bottom: 0; font-size:12px;color:green;">
                                                            Please wait some times...Your request has been accepted by an admin..!
                                                        </p>
                                                    @endif
                                                @else
                                                    <button type="button" class="btn btn-sm btn-success" disabled>Completed</button>
                                                @endif
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
        </div>
    </div>
</section>

<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');

        if (successMessage) {
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 3000);
        }

        if (errorMessage) {
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 3000);
        }
    });
</script>

<script>
    $(document).ready(function(){
        $('.cancelButton').on('click', function(){
            const id = $(this).data('id');
            const $row = $(this).closest('tr');

            if(id != null){
                $.ajax({
                    url: '/cancel/limit/request/' + id,
                    method: 'GET',
                    success: function(response){
                        $row.fadeOut('slow', function(){
                            $(this).remove();
                        });
                    },
                    error: function(error){

                    }
                });
            }
        });
    });
</script>
@endsection
