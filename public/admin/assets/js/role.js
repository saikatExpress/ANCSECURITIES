$(document).ready(function(){
    $(document).on('click', '.deleteBtn', function(){
        var role = $(this).data("id");
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
                    url: "/role/delete/" + role,
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

    $('.editRoleBtn').on('click', function(){
        const roleId = $(this).data('id');

        if(roleId != ''){
            $.ajax({
                url: '/edit-permissions/' + roleId,
                type: 'GET',
                success: function(response) {
                    $('#editPermissionModal .modal-body').html(response);
                    $('#editPermissionModal').modal('show');
                },
                error: function(xhr) {
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
                console.error('Error saving permissions:', xhr);
            }
        });
    });

    $('#successAlert').show();

    setTimeout(function() {
        $('#successAlert').fadeOut('slow');
    }, 3000);
});
