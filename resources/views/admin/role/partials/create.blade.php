@extends('admin.layout.app')
<style>
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        background-color: #fff;
        padding: 10px 12px;
    }
    .card-header {
        color: #000;
        margin-bottom: 10px;
    }
    .card-header h3 {
        margin: 0;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .table-responsive {
        margin-top: 20px;
        padding: 10px;
    }
    .table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }
    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }
    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }
    .table-hover tbody tr:hover {
        color: #495057;
        background-color: rgba(0, 0, 0, 0.075);
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
    }
</style>
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Dashboard
                <strong class="text-sm text-success fw-bold">Admin</strong>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between;">
                    <h3>Create Permission</h3>
                    <button type="button" class="btn btn-sm btn-primary permissionListBtn">Permission List</button>
                </div>
                <div class="card-body">
                    <form id="createPermissionForm" action="{{ route('permission.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Permission Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter permission name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>

                <div id="contentArea1" class="table-responsive">

                </div>

            </div>

        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#createPermissionForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function(xhr) {
                        console.error('Error creating permission:', xhr);
                    }
                });
            });

            $('.permissionListBtn').on('click', function() {
                $.ajax({
                    url: '/permission/list',
                    type: 'GET',
                    success: function(response) {
                        $('#contentArea1').html("<h2>Permission List</h2>" + response);
                        // Scroll to the top of contentArea if needed
                        $('#contentArea1').animate({ scrollTop: 0 }, 'fast');
                    },
                    error: function(error) {
                        console.error('Error fetching permission list:', error);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Open the edit modal and populate it with data
            $(document).on('click', '.permissionEditBtn', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');

                $('#editPermissionId').val(id);
                $('#editPermissionName').val(name);
                $('#editPermissionModal').modal('show');
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $(document).on('click', '.permissionDeleteBtn', function(){
                var permissionId = $(this).data("id");
                var listItem = $(this).closest(".list-item"); // Adjust the selector based on your HTML structure

                // Use SweetAlert to confirm the deletion
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms, send an AJAX request to delete the pigeon
                        $.ajax({
                            type: "GET",
                            url: "/permission/delete/" + permissionId,
                            success: function (response) {
                                // Remove the deleted item from the DOM
                                listItem.remove();

                                // Show a success message
                                Swal.fire("Deleted!", response.message, "success");
                            },
                            error: function (error) {
                                // Show an error message
                                Swal.fire(
                                    "Error!",
                                    error.responseJSON.message,
                                    "error"
                                );
                            },
                        });
                    }
                });
            });
        });
    </script>


@endsection
