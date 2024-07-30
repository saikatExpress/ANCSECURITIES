<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
                <tr class="list-item">
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-transform: uppercase;">{{ $permission->name }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning permissionEditBtn"
                            data-id="{{ $permission->id }}" data-name="{{ $permission->name }}">
                            Edit
                        </button>
                        <button type="button" class="btn btn-sm btn-danger permissionDeleteBtn" data-id="{{ $permission->id }}">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Edit Permission Modal -->
<div class="modal fade" id="editPermissionModal" tabindex="-1" role="dialog" aria-labelledby="editPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPermissionModalLabel">Edit Permission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editPermissionForm" action="{{ route('permission.edit') }}" method="post">
                    @csrf
                    <input type="hidden" id="editPermissionId" name="permissionid">
                    <div class="form-group">
                        <label for="editPermissionName">Permission Name</label>
                        <input type="text" class="form-control" id="editPermissionName" name="name" placeholder="Enter permission name" required>
                        <span id="errorMessage" style="font-size: 12px; color:red;"></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#editPermissionForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            const formData = $(this).serialize();
            const formUrl = $(this).attr('action');

            // Make AJAX request
            $.ajax({
                url: formUrl,
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success response
                    Swal.fire({
                        title: 'Success!',
                        text: response.success,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        $('#editPermissionModal').modal('hide');
                        $('.permissionListBtn').trigger('click');
                        location.reload();
                    });
                },
                error: function(xhr) {
                    // Handle error response
                    console.error('Error updating permission:', xhr);
                    let errorMessage = 'An error occurred while updating the permission.';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMessage = Object.values(xhr.responseJSON.errors).join('<br>');
                    }
                    $('#errorMessage').html(errorMessage);
                }
            });
        });
    });
</script>
