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
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal">
                    Add BO
                </button>
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
                    File Upload
                </button>
            </p>
        </section>

        <section class="content">

            @if(session('message'))
                <div class="alert alert-success" id="successAlert">
                    {{ session('message') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="box">
                <div class="box-header">
                <h3 class="box-title">BO List</h3>
                </div>
                <div class="box-body">

                    <div style="display: flex; justify-content:space-between; align-items:center;">
                        <input style="margin-bottom: 10px;width: 200px;height: 37px;" type="text" id="search" placeholder="Search BO ID or Name...">
                    </div>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>BO ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="bo-table-body">
                            @foreach ($bos as $form)
                                <tr class="list-item">
                                    <td>{{ $form->id }}</td>
                                    <td>{{ str_pad($form->bo_id, 4,0, STR_PAD_LEFT) }}</td>
                                    <td>{{ $form->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $form->id }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="pagination-links">
                        {{ $bos->links() }}
                    </div>
                </div>
          </div>
        </section>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create Bo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div>
                    <p class="text-danger text-sm">
                        When you create a BO,it's must be create as an investor..By default,created investor account is deactive..when investor login
                        into the system,then the account is active automatically...
                    </p>
                </div>

                <form action="{{ route('store.bo') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">BO ID : <span class="text-danger"> * </span></label>
                        <input type="text" class="form-control" name="boId" id="boId">
                    </div>
                    <div class="form-group">
                        <label for="">Name : </label>
                        <input type="text" class="form-control" name="client_name" id="client_name">
                        @error('client_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <span id="nameErr"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Email : </label>
                        <input type="email" class="form-control" name="email" id="email">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <span id="emailErr"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Account type : </label>
                        <select name="ac_type" id="ac_type" class="form-control">
                            <option value="" selected disabled>Select</option>
                            <option value="indivijual">Individual Account</option>
                            <option value="joint">Joint Account</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Father Name</label>
                        <input type="text" class="form-control" name="father_name" id="fatherName">
                        @error('father_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <span id="fnameErr"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Spouse Name</label>
                        <input type="text" class="form-control" name="spouse_name" id="spouseName">
                        @error('spouse_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <span id="fnameErr"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Mother Name</label>
                        <input type="text" class="form-control" name="mother_name" id="motherName">
                        @error('mother_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <span id="mnameErr"></span>
                    </div>

                    <div class="form-group">
                        <label for="">Mobile</label>
                        <input type="text" class="form-control" name="cell_no" id="mobile">
                        @error('cell_no')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <span id="mobileErr"></span>
                    </div>

                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea class="form-control" name="address" id="address"></textarea>
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <span id="addressErr"></span>
                    </div>

                    <div class="form-group">
                        <label for="">Ac Open Date</label>
                        <input type="date" name="ac_open_date" id="ac_open_date" class="form-control">
                        @error('ac_open_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <span id="acopenErr"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Bank Account No</label>
                        <input type="text" name="bank_account_no" id="bank_account_no" class="form-control">
                        @error('bank_account_no')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Bank Name</label>
                        <input type="text" name="bank_name" id="bank_name" class="form-control">
                        @error('bank_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <span id="bankErr"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Branch Name</label>
                        <input type="text" name="branch_name" id="branch_name" class="form-control">
                        @error('branch_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <span id="branchErr"></span>
                    </div>

                    <input type="submit" class="btn btn-sm btn-primary" value="Save BO">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">File Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" method="post" action="{{ route('upload.excel') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">File Upload : <span class="text-danger"> * </span></label>
                        <input type="file" name="bo_file" id="bo_file" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary" id="saveChanges">Upload File</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
        $(document).ready(function() {
            function fetch_data(page = 1, search = '') {
                $.ajax({
                    url: "{{ route('create.bo') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        page: page,
                        search: search
                    },
                    success: function(response) {
                        let html = '';
                        response.data.forEach(item => {
                            html += `<tr class="list-item">
                                <td>${item.id}</td>
                                <td>${String(item.bo_id).padStart(4, '0')}</td>
                                <td>${item.name}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary">Edit</button>
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
