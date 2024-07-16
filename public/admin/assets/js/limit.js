$(document).ready(function(){
    $(document).on('click', '.deleteBtn', function(){
        var limitId = $(this).data("id");
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
                    url: "/limit/delete/" + limitId,
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

    $(document).on('click', '.editBtn', function(){
        var id = $(this).data('id');
        var name = $(this).data('name');
        var description = $(this).data('description');
        var status = $(this).data('status');

        $('#departmentId').val(id);
        $('#dName').val(name);
        $('#dDescription').val(description);
        $('#status').val(status);
    });

    $('#departmentForm').on('submit', function(e){
        e.preventDefault();

        const name = $('#dName').val().trim();

        if(name == ''){
            $('#nameErr').html('Please enter name');
        }

        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            success: function(response){
                if(response && response.success == true){
                    Swal.fire("Updated!", 'Department update successfully', "success");
                    window.location.reload();
                }
                if(response && response.error == false){
                    Swal.fire("Warning!", 'Department not found', "warning");
                }
            },
            error: function(error){
                console.log(error);
            }
        });
    });
});
