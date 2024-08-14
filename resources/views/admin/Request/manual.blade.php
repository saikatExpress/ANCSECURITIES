@extends('admin.layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <x-sub-header/>
            <h1>
                Dashboard
                <strong class="text-sm text-success fw-bold">Admin</strong>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{ $pageTitle }}</li>
            </ol>
        </section>

        <section class="content">
            @if(session('message'))
                <div class="alert alert-success" id="successAlert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Manual Request</h3>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('manual.request_store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="client_id" id="client_id">
                            <div class="form-group">
                                <label for="">Select Request : <span class="text-danger">*</span></label>
                                <select name="request" id="request" class="form-control">
                                    <option value="" disabled selected>Select</option>
                                    <option value="limit">Limit Request</option>
                                    <option value="withdraw">Withdraw Request</option>
                                    <option value="deposite">Diposite Request</option>
                                </select>
                            </div>
                            <div class="form-group" style="display: none;" id="form-group-code">
                                <label for="">Trading Code : <span class="text-danger">*</span></label>
                                <input type="text" name="trading_code" id="trading_code" class="form-control">
                            </div>
                            <div class="form-group" style="display: none;" id="form-group-name">
                                <label for="">Name : <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group" style="display: none;" id="form-group-email">
                                <label for="">Email : <span class="text-danger">*</span></label>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group" style="display: none;" id="form-group-mobile">
                                <label for="">Mobile : <span class="text-danger">*</span></label>
                                <input type="text" name="mobile" id="mobile" class="form-control">
                            </div>
                            <div class="form-group" style="display: none;" id="form-group-amount">
                                <label for="">Amount : <span class="text-danger">*</span></label>
                                <input type="text" name="amount" id="amount" class="form-control">
                            </div>
                            <div class="form-group" style="display: none;" id="form-group-bank">
                                <label for="">Bank Account No : <span class="text-danger">*</span></label>
                                <input type="text" name="bank_account" id="bank_account" class="form-control">
                            </div>
                            <div class="form-group" style="display: none;" id="form-group-slip">
                                <label for="">Bank Slip : <span class="text-danger">*</span></label>
                                <input type="file" name="bank_slip" id="bank_slip" class="form-control">
                            </div>
                            <div class="form-group" style="display: none;" id="form-group-date">
                                <label for="">Withdraw/Deposite Date : <span class="text-danger">*</span></label>
                                <input type="date" name="date" id="date" class="form-control">
                            </div>

                            <button type="submit" id="saveBtn" class="btn btn-sm btn-primary" style="display: none;">Commit Info</button>
                        </form>
                    </div>
                </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin/assets/js/watch.js') }}"></script>

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
        $(document).ready(function(){
            $('#request').on('input', function(){
                var request = $(this).val();
                if(request != ''){
                    formGroup(request);
                }else{
                    $('#name').val('');
                    $('#email').val('');
                    $('#mobile').val('');
                    $('#bank_account').val('');
                }
            });

            $('#trading_code').on('input', function(){
                var code = $(this).val();

                if(code != ''){
                    $.ajax({
                        url: '/get/client/code/' + code,
                        method: 'GET',
                        success: function(response){
                            $('#client_id').val(response.user.id);
                            $('#name').val(response.tradeInfo.name);
                            $('#email').val(response.tradeInfo.email);
                            $('#mobile').val(response.tradeInfo.cell_no);
                            $('#bank_account').val(response.tradeInfo.bank_account_no);
                        },
                        error: function(error){

                        }
                    });
                }
            });

            function formGroup(request){
                if(request === 'limit'){
                    $('#form-group-code').show();
                    $('#form-group-name').show();
                    $('#form-group-email').show();
                    $('#form-group-mobile').show();
                    $('#form-group-amount').show();
                    $('#form-group-date').hide();
                    $('#form-group-bank').hide();
                    $('#form-group-slip').hide();
                    $('#saveBtn').show();
                }else if(request === 'withdraw'){
                    $('#form-group-code').show();
                    $('#form-group-name').show();
                    $('#form-group-email').show();
                    $('#form-group-mobile').show();
                    $('#form-group-amount').show();
                    $('#form-group-date').show();
                    $('#form-group-bank').show();
                    $('#saveBtn').show();
                    $('#form-group-slip').hide();
                }else if(request === 'deposite'){
                    $('#form-group-code').show();
                    $('#form-group-name').show();
                    $('#form-group-email').show();
                    $('#form-group-mobile').show();
                    $('#form-group-amount').show();
                    $('#form-group-bank').show();
                    $('#form-group-date').show();
                    $('#form-group-slip').show();
                    $('#saveBtn').show();
                }else{
                    $('#saveBtn').hide();
                }
            }
        });
    </script>
@endsection
