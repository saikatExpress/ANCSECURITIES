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
                <a href="{{ route('create.role') }}" class="btn btn-sm btn-primary">
                    Create Role
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
              <h3 class="box-title">Form List</h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr class="list-item">
                            <td>{{ $role->id }}</td>
                            <td style="text-transform: uppercase;">
                                {{ $role->name }}
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-success permissionBtn" data-toggle="modal" data-id="{{ $role->id }}" data-target="#permissionModal">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                            <td>
                                <a href="#" data-id="{{ $role->id }}" class="btn btn-sm btn-primary editRoleBtn">
                                    Edit
                                </a>
                                <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $role->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </section>
    </div>

    <div class="modal fade" id="permissionModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Role with Permissions</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editPermissionModal" tabindex="-1" role="dialog" aria-labelledby="editPermissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPermissionModalLabel">Edit Role Permissions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Content will be dynamically loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary savePermissionsBtn">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin/assets/js/role.js') }}"></script>

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
            $('.permissionBtn').on('click', function(){
                const roleId = $(this).data('id');

                if(roleId != ''){
                    $.ajax({
                        url: '/get/permissions/' + roleId,
                        type: 'GET',
                        success: function(response){
                            $('#permissionModal .modal-body').html(response);
                        },
                        error: function(xhr) {
                            console.error('Error fetching permissions:', xhr);
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.editRoleBtn').on('click', function(){
                const roleId = $(this).data('id');

                if(roleId != ''){
                    $.ajax({
                        url: '/edit-permissions/' + roleId, // Update the URL as per your route
                        type: 'GET',
                        success: function(response) {
                            $('#editPermissionModal .modal-body').html(response);
                            $('#editPermissionModal').modal('show');
                        },
                        error: function(xhr) {
                            // Handle errors here
                            console.error('Error fetching permissions:', xhr);
                        }
                    });
                }
            });

            $('.savePermissionsBtn').on('click', function(){
                const form = $('#editPermissionForm');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Permissions updated successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    error: function(xhr) {
                        // Handle errors here
                        console.error('Error saving permissions:', xhr);
                    }
                });
            });
        });
    </script>

@endsection
