@extends('admin.layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
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
                <a class="btn btn-sm btn-primary" href="{{ route('user.list') }}">
                    User List
                </a>
            </p>
        </section>

        <section class="content">

            @if(session('message'))
                <div class="alert alert-success" id="successAlert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Create User</h3>
                </div>
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-md-6">

                        <strong class="text-danger fw-bold ml-3" id="accountExits"></strong>
                        <strong style="display: none;" id="avaiable" class="text-success fw-bold ml-3"><i class="fas fa-solid fa-check"></i> Avaiable</strong>
                        <strong style="display: none;" id="notavaiable" class="text-danger fw-bold ml-3"><i class="fas fa-solid fa-circle-exclamation"></i> Not found</strong>

                        <div class="box-body">
                            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Trading Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="trading_code" id="trading_code">
                                    @error('trading_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Mobile <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="mobile" id="mobile">
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Password <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="password" id="password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div id="fileInputsContainer">
                                    <div class="form-group">
                                        <label for="">Upload Image</label>
                                        <input type="file" name="profile_image" id="profile_image" class="form-control">
                                        @error('profile_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Create User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4 class="about_head">User List</h4>

                        <div class="user_list">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <!-- Add more columns as per your User model -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->mobile }}</td>
                                        <!-- Add more columns as per your User model -->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            $('#trading_code').on('input', function(){
                var code = $(this).val();

                if(code){
                    $.ajax({
                        url: '/get/trade/code/' + code,
                        type: 'GET',
                        success: function(response){
                            if(response && response.warning === false){
                                $('#accountExits').html('Sorry : This account already registered..!');
                                $('#notavaiable').hide();
                                $('#name, #email, #mobile').val('');
                                return false;
                            }

                            if (response && response.success === true) {
                                $('#avaiable, .instructions, #register_form').show();
                                $('#notavaiable').hide();
                                $('#accountExits').hide();
                                $('#name').val(response.traderInfo.name);
                                $('#email').val(response.traderInfo.email);
                                $('#mobile').val(response.traderInfo.cell_no);
                            } else {
                                $('#notavaiable').show();
                                $('#name, #email, #mobile').val('');
                            }
                        },
                        error: function(error){
                            console.error('An error occurred:', error);
                        }
                    });
                }
            });
        });
    </script>
@endsection
