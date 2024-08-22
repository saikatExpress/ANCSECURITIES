$(document).ready(function() {
    $(document).on('click', '.permissionDeleteBtn', function(){
        var permissionId = $(this).data("id");
        var listItem = $(this).closest(".list-item");

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
                $.ajax({
                    type: "GET",
                    url: "/permission/delete/" + permissionId,
                    success: function (response) {
                        listItem.remove();

                        Swal.fire("Deleted!", response.message, "success");
                    },
                    error: function (error) {
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

    $(document).on('click', '.permissionEditBtn', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');

        $('#editPermissionId').val(id);
        $('#editPermissionName').val(name);
        $('#editPermissionModal').modal('show');
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
