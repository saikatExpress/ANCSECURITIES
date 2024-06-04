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

    $(document).on('click', '.permissionBtn', function(){
        var roleId = $(this).data('id');
        $.ajax({
            url: '/get/permissions/' + roleId,
            type: 'GET',
            success: function(response){
                console.log(response);
            },
            error: function(error){
                console.log(error);
            }
        });
    });
});
