@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Dashboard
                <strong class="text-sm text-success fw-bold">Admin</strong>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{ $pageTitle }}</li>
            </ol>
            <p style="text-align: right;">
                <a class="btn btn-sm btn-primary" href="{{ route('create.portfolio') }}">
                    Upload Portfolio
                </a>
            </p>
        </section>

        <section class="content">

            @if(session('message'))
                <div class="alert alert-success" id="successAlert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Portfolio List</h3>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <form method="" action="" class="form-inline" id="portfolioForm">
                            @csrf
                            <div class="form-group">
                                <input type="text" id="tradingCode" name="trading_code" class="form-control" placeholder="Enter trading code..."> <br>
                                <span class="text-danger text-sm" id="errorMsg"></span>
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($portfolios as $portfolio)
                                <tr>
                                    <td>{{ $portfolio->id }}</td>
                                    <td>{{ $portfolio->name }}</td>
                                    <td>
                                        <a href="{{ asset($portfolio->file_path) }}" target="_blank">{{ $portfolio->name }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
            $('#portfolioForm').on('submit', function(event){
                event.preventDefault();

                const tradingCode = $('#tradingCode').val();

                if(tradingCode.trim() == ''){
                    $('#errorMsg').html('Please enter code here..');
                    return;
                }

                $.ajax({
                    url : $(this).attr('action'),
                    method: 'POST',
                    success: function(response){

                    },
                    error: function(xhr){
                        console.log(xhr);
                    }
                });
            });

            $('#tradingCode').on('input', function(){
                var code = $(this).val();
                if(code.trim() != ''){
                    $('#errorMsg').hide();
                }else{
                    $('#errorMsg').show();
                }
            });
        });
    </script>
@endsection
