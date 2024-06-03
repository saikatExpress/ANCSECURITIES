$(document).ready(function(){
    $(document).on('click', '.deleteButton', function(){
        var reportId = $(this).data("id");
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
                    url: "/form/delete/" + reportId,
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
