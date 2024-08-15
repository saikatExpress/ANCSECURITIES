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
            <p style="text-align: right;">
                <a class="btn btn-sm btn-primary" href="{{ route('create.user') }}">
                    Create User
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
                <h3 class="box-title">User List</h3>
                </div>
                <div class="box-body">
                    <div style="display: flex; justify-content:space-between; align-items:center;">
                        <input style="margin-bottom: 10px;width: 200px;height: 37px;" type="text" id="search" placeholder="Search BO ID or Name...">
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Whatsapp</th>
                                <th>Joined On</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="bo-table-body">
                            @foreach ($users as $user)
                                <tr class="list-item">
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->mobile }}
                                    </td>
                                    <td>
                                        <a href="https://api.whatsapp.com/send?phone=880{{ $user->whatsapp }}" target="_blank">
                                            {{ $user->whatsapp }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $user->created_at->format('d-M-Y') }}
                                    </td>
                                    @if ($user->status === 'active')
                                        <td>
                                            <label for="" class="btn btn-sm btn-success">Active</label>
                                        </td>
                                    @else
                                        <td>
                                            <label for="" class="btn btn-sm btn-danger">Deactive</label>
                                        </td>
                                    @endif
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary userBtn"
                                            data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}" data-mobile="{{ $user->mobile }}"
                                            data-whatsapp="{{ $user->whatsapp }}" data-status="{{ $user->status }}"
                                            data-trading_code="{{ $user->trading_code }}"
                                            data-toggle="modal" data-target="#userModal">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div id="pagination-links">
                        {{ $users->links() }}
                    </div>
                </div>
          </div>
        </section>
    </div>

    <div class="modal fade" id="userModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit User</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="userId" id="userId">
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
                            <label for="">Whatsapp <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="whatsapp" id="whatsapp">
                            @error('whatsapp')
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
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="" disabled selected>Select</option>
                                <option value="active">Active</option>
                                <option value="deactive">Deactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('admin/assets/js/watch.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

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
            $('.userBtn').on('click', function(){
                const userId = $(this).data('id');
                const trading_code = $(this).data('trading_code');
                const name = $(this).data('name');
                const email = $(this).data('email');
                const mobile = $(this).data('mobile');
                const whatsapp = $(this).data('whatsapp');
                const status = $(this).data('status');

                $('#userId').val(userId);
                $('#name').val(name);
                $('#email').val(email);
                $('#mobile').val(mobile);
                $('#whatsapp').val(whatsapp);
                $('#trading_code').val(trading_code);
                $('#status').val(status);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            function fetch_data(page = 1, search = '') {
                $.ajax({
                    url: "{{ route('user.list') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        page: page,
                        search: search
                    },
                    success: function(response) {
                        let html = '';
                        response.data.forEach(item => {
                            let buttonClass = item.status === 'active' ? 'btn-success' : 'btn-danger';
                            let buttonText = item.status === 'active' ? 'Activate' : 'Deactivate';
                            let formattedDate = moment(item.created_at).format('DD-MM-YY, h:mmA');

                            html += `<tr class="list-item">
                                <td>${item.id}</td>
                                <td>${String(item.trading_code).padStart(4, '0')}</td>
                                <td>${item.name}</td>
                                <td>${item.email}</td>
                                <td>${item.mobile}</td>
                                <td>${item.whatsapp}</td>
                                <td>${formattedDate}</td>
                                <td>
                                    <button type="button" class="btn btn-sm ${buttonClass}">${buttonText}</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-id="${item.id}">Edit</button>
                                    <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="${item.id}">Delete</button>
                                </td>
                            </tr>`;
                        });

                        $('#bo-table-body').html(html);
                        let paginationLinks = '';

                        if (response.pagination.current_page > 1) {
                            paginationLinks += `<a href="#" class="pagination-link" data-page="1">First</a>`;
                            paginationLinks += `<a href="#" class="pagination-link" data-page="${response.pagination.current_page - 1}">Previous</a>`;
                        }

                        for (let i = 1; i <= response.pagination.last_page; i++) {
                            if (i === response.pagination.current_page) {
                                paginationLinks += `<span class="pagination-link active">${i}</span>`;
                            } else {
                                paginationLinks += `<a href="#" class="pagination-link" data-page="${i}">${i}</a>`;
                            }
                        }

                        if (response.pagination.current_page < response.pagination.last_page) {
                            paginationLinks += `<a href="#" class="pagination-link" data-page="${response.pagination.current_page + 1}">Next</a>`;
                            paginationLinks += `<a href="#" class="pagination-link" data-page="${response.pagination.last_page}">Last</a>`;
                        }

                        $('#pagination-links').html(paginationLinks);
                    }
                });
            }

            // Initial fetch
            fetch_data();

            // Search input
            $('#search').on('keyup', function() {
                let search = $(this).val();
                fetch_data(1, search);
            });

            // Pagination links
            $(document).on('click', '.pagination-link', function(e) {
                e.preventDefault();
                let page = $(this).data('page');
                let search = $('#search').val();
                fetch_data(page, search);
            });
        });
    </script>

@endsection
