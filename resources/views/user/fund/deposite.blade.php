<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('auth/ANCSECURITIES.png') }}" type="image/x-icon">
    <title>Deposit Money | ANC SECURITIES</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
</head>

<style>
    .content {
        display: inline;
    }
    .more {
        display: none;
    }
    .show-more, .show-less {
        display: none;
        color: blue;
        cursor: pointer;
        font-size: 8px;
    }

    .nav-item a{
        color: black;
        font-size: 1.2rem;
        font-weight: 600;
    }

    .footer {
        background-color: #f8f9fa;
        padding: 20px 0;
        text-align: center;
        border-top: 1px solid #e9ecef;
    }
    .footer img {
        max-width: 150px;
        margin-bottom: 10px;
    }
    .footer p {
        margin: 0;
        color: #6c757d;
    }
</style>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-custom" style="background-color: lawngreen;">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('auth/logo.png') }}" style="width: 60px; height:60px;margin-left:1rem;background: #fff;border-radius: 50%;padding: 2px;" alt="Anc Securities Ltd">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i style="color: aliceblue;" class="fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('user.dashboard') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('fund.withdraw') }}">Withdraw Request</a>
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
                        <h3 class="mb-0">Deposit Money</h3>
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
                        <form method="POST" action="{{ route('deposite.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="amount">Amount <span class="text-danger">*</span></label>
                                <input type="number" id="amount" name="amount" class="form-control" placeholder="Enter amount to deposit">
                                <div id="amount-info" class="text-success mt-2"></div>
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="bank_account">Bank Slip/ Screenshot <span class="text-danger">*</span></label>
                                <input type="file" id="bank_slip" name="bank_slip" class="form-control">
                                @error('bank_slip')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="deposit_date">Deposit Date <span class="text-danger">*</span></label>
                                <input type="date" id="deposit_date" name="deposit_date" class="form-control" placeholder="Enter deposit date">
                                @error('deposit_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter description (optional)"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Deposit</button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-lg mt-5">

                    <div class="card-header text-center">
                        <h3 class="mb-0">Deposit History</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped history-table">
                                <thead>
                                    <tr>
                                        <th style="font-size: 12px;padding:4px;">SL</th>
                                        <th style="font-size: 12px;padding:4px;">Amount</th>
                                        <th style="font-size: 12px;padding:4px;">Bank Account</th>
                                        <th style="font-size: 12px;padding:4px;">Description</th>
                                        <th style="font-size: 12px;padding:4px;">Status</th>
                                        <th style="font-size: 12px;padding:4px;">Date</th>
                                        <th style="font-size: 12px;padding:4px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl = 1;
                                    @endphp
                                    @foreach ($depositeHistory as $deposit)
                                        <tr>
                                            <td style="font-size: 12px;padding:4px;">{{ $sl }}</td>
                                            <td style="font-size: 12px;padding:4px;">{{ $deposit->amount }}</td>
                                            <td style="font-size: 12px;padding:4px;">{{ $deposit->ac_no }}</td>
                                            <td style="font-size: 12px;padding:4px;">{{ $deposit->description }}</td>
                                            <td style="font-size: 12px;padding:4px;">
                                                @if ($deposit->status === 'approved')
                                                    <div id="status-container">
                                                        <label class="btn btn-sm btn-success" id="status-label1" style="font-size:10px;margin-bottom:0;"></label>
                                                        <p id="status-message1" style="font-size: 9px; color:green;margin-bottom:0;margin-top:0;"></p>
                                                        <span id="show-more1" class="show-more">Read More</span>
                                                        <span id="show-less1" class="show-less">Read Less</span>
                                                    </div>
                                                @else
                                                    <div id="status-container">
                                                        <label class="btn btn-sm btn-danger" id="status-label" style="font-size:10px;margin-bottom:0;"></label>
                                                        <p id="status-message" style="font-size: 9px; color:green;margin-bottom:0;margin-top:0;"></p>
                                                        <span id="show-more" class="show-more">Read More</span>
                                                        <span id="show-less" class="show-less">Read Less</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td style="font-size: 12px;padding:4px;">{{ $deposit->withdraw_date->format('d-m-Y') }}</td>
                                            <td style="font-size: 12px;padding:4px;">
                                                @if ($deposit->status == 'pending')
                                                    <button type="button" style="font-size:10px;" class="btn btn-sm btn-danger cancelButton"
                                                        data-id="{{ $deposit->id }}" data-user_id="{{ $deposit->client_id }}">
                                                        Cancel
                                                    </button>
                                                @else
                                                    <button style="font-size:10px;" type="button" class="btn btn-sm btn-success">View</button>
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
                        @if($depositeHistory->isEmpty())
                            <p class="text-center">No deposit history found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <img src="{{ asset('auth/logo.png') }}" style="width: 3rem; height:3rem;margin-left:1rem;" alt="Anc Securities Ltd">
            <p>&copy; {{ date('Y') }} TS WEB BUILD. All rights reserved.</p>
            <p>
                Al Haj Tower,4th floor(Level-03),82 Mothijheel C/A, Dhaka -1100, Bangladesh.
            </p>
            <p>Email: ancsecuritieslimited@gmail.com| Phone: (+88) 01844-547916</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/assets/js/deposit.js') }}"></script>
    <script src="{{ asset('user/assets/js/numbertowords.js') }}"></script>
    <script src="{{ asset('user/assets/js/read.js') }}"></script>

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
</body>
</html>
