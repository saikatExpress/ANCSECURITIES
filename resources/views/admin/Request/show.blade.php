@extends('admin.layout.app')
<style>
    .info_text h6{
        text-align: center;
        font-weight: 600;
        font-size: 1.5rem;
        color: #000;
    }

    .info_text p{
        text-align: center;
    }

    .info_body h5{
        font-weight: 600;
        font-size: 1.9rem;
        color: tomato;
        padding: 8px 10px 8px;
    }

    .info_title h4{
        font-weight: 600;
        font-size: 2.2rem;
        color: #000;
    }
    .info_title h6{
        color: #000;
        font-weight: 600;
        font-size: 1.5rem;
    }
</style>
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
                <a class="btn btn-sm btn-primary" href="{{ route('admin.dashboard') }}">Back Home</a>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <h4 class="card-title">Fund Withdraw Request</h4>
                            </div>

                            <div style="background-color: #fff;padding: 10px 12px 10px;border-radius: 4px;box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                                <div style="display: flex;justify-content: space-between;align-items: center;">
                                    <div class="info_title">
                                        <h4>ANC Securities Ltd.</h4>
                                        <h6>DSE TREC No. 275</h6>
                                        <p>
                                            Alhaj Tower, Fourth Floor (Level-3),82,Mothijheel C/A, Dhaka - 1000
                                        </p>
                                    </div>
                                    <div>
                                        <p>Phone: +8801844-547916</p>
                                        <p>Mobile: +8801844547918</p>
                                        <p>Fax: (+880 2) 8881152</p>
                                        <p>Email: ancsecuritieslimited@gmail.com</p>
                                        <p>Web: https://ancsecurities.com/</p>
                                    </div>
                                </div>

                                <div class="info_text">
                                    <h6>FUND WITHDRAWAL APPLICATION FORM</h6>
                                    <p>(Fund Transfer through Cheque)</p>
                                </div>

                                <div class="info_body">
                                    <h5>Withdrawal Details</h5>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Requisition Date</th>
                                                <td>{{ \Carbon\Carbon::parse($withdraw->withdraw_date)->format('m/d/y h:i A') }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Account Status</th>
                                                <td style="text-transform: uppercase;">
                                                    <label for="" class="btn btn-sm btn-success">
                                                        {{ $withdraw->clients->status }}
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Account Number</th>
                                                <td>
                                                    {{ $withdraw->clients->trading_code }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Contact No.</th>
                                                <td>
                                                    {{ $withdraw->clients->mobile }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Name of Account Holder(s)</th>
                                                <td>{{ $withdraw->clients->name }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Bank Account Number</th>
                                                <td>{{ $withdraw->ac_no }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Description</th>
                                                <td>{{ $withdraw->description }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Amount (TAKA)</th>
                                                <td>{{ number_format($withdraw->amount, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Taka in Words</th>
                                                <td>{{ ucfirst(numberToWords($withdraw->amount) . ' Taka only') }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Status</th>
                                                <td>
                                                    <span class="badge badge-danger" style="background-color: darkred;">
                                                        {{ ucfirst($withdraw->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Action</th>
                                                <td>
                                                    <button class="btn btn-sm btn-success acceptBtn" data-id="{{ $withdraw->id }}">Accept</button>
                                                    <button type="button" class="btn btn-sm btn-danger declineBtn" data-id="{{ $withdraw->id }}">Declined</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
            $('.declineBtn').on('click', function(){
                var reqId = $(this).data('id');

                if(reqId != ''){
                    $.ajax({
                        url: '/update/withdraw/status/' + reqId,
                        type: 'GET',
                        success: function(response){
                            if(response && response.success === true){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'The withdrawal request has been declined.',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.reload();
                                });
                            }
                        },
                        error: function(error){
                            console.log(error);
                        }
                    });
                }
            });

            $('.acceptBtn').on('click', function(){
                var reqId = $(this).data('id');

                if(reqId != ''){
                    $.ajax({
                        url: '/accept/withdraw/status/' + reqId,
                        type: 'GET',
                        success: function(response){
                            if(response && response.success === true){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'The withdrawal request has been accepted.',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.reload();
                                });
                            }
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
