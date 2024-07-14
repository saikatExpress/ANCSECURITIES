<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('auth/ANCSECURITIES.png') }}" type="image/x-icon">
    <title>Withdraw Money | ANC SECURITIES</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-custom {
            background: linear-gradient(45deg, #007bff, #0056b3);
        }
        .navbar-custom .navbar-brand, .navbar-custom .nav-link {
            color: white;
        }
        .navbar-custom .nav-link.active {
            color: #ffcc00;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .btn-primary {
            background: #007bff;
            border: none;
            transition: background 0.3s ease;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .form-control {
            border-radius: 5px;
        }
        .history-table {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="{{ url('/') }}">ANC SECURITIES</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i style="color: aliceblue;" class="fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('deposite.money') }}">Deposit Money</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout.us') }}">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header text-center">
                        <h3 class="mb-0">Withdraw Money Request</h3>
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
                        <form method="POST" action="{{ route('withdraw.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="amount">Amount <span class="text-danger">*</span></label>
                                <input type="number" id="amount" name="amount" class="form-control" placeholder="Enter amount to withdraw">
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="bank_account">Bank Account <span class="text-danger">*</span></label>
                                <input type="text" id="bank_account" name="bank_account" class="form-control" placeholder="Enter your bank account number">
                                @error('bank_account')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="withdraw_date">Withdrawn Date <span class="text-danger">*</span></label>
                                <input type="date" id="withdraw_date" name="withdraw_date" class="form-control" placeholder="Enter your bank account number">
                                @error('withdraw_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter description (optional)"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Submit Request</button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-lg mt-5">
                    <div class="card-header text-center">
                        <h3 class="mb-0">Withdraw Request History</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped history-table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Amount</th>
                                        <th>Bank Account</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl = 1;
                                    @endphp
                                    @foreach ($funds as $request)
                                        <tr>
                                            <td>{{ $sl }}</td>
                                            <td>{{ $request->amount }}</td>
                                            <td>{{ $request->ac_no }}</td>
                                            <td>{{ $request->description }}</td>
                                            <td class="text-danger">{{ $request->status }}</td>
                                            <td>{{ $request->withdraw_date->format('d-m-Y') }}</td>
                                            <td>
                                                @if ($request->status == 'pending')
                                                    <button type="button" class="btn btn-sm btn-danger cancelBtn" data-id="{{ $request->id }}" data-user_id="{{ $request->client_id }}">Cancel</button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-success">View</button>
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
                        @if($funds->isEmpty())
                            <p class="text-center">No withdraw requests found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 3000);
    </script>
    <script>
        setTimeout(function() {
            document.getElementById('error-message').style.display = 'none';
        }, 5000);
    </script>

    <script>
        $(document).ready(function(){
            // Click event handler for cancelBtn buttons
            $('.cancelBtn').on('click', function(){
                // Get data attributes from the button
                const fundId = $(this).data('id');
                const clientId = $(this).data('user_id');
                const $row = $(this).closest('tr');

                // Validate fundId and clientId
                if (!fundId || !clientId) {
                    console.error('Missing fundId or clientId.');
                    return false;
                }

                // AJAX request to cancel fund request
                $.ajax({
                    url: '/cancel/fund/request',
                    method: 'GET',
                    data: {
                        fundId: fundId,
                        clientId: clientId
                    },
                    success: function(response){
                        $row.fadeOut('slow', function(){
                            $(this).remove();
                        });
                    },
                    error: function(error){
                        // Handle error response here
                        console.error('Error cancelling fund request.', error);
                        // Optionally display error message or handle UI updates
                    }
                });
            });
        });
    </script>

</body>
</html>
