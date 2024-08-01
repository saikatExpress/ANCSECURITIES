$(document).ready(function(){
    $(document).on('click', '.deleteBtn', function(){
        var expenseId = $(this).data("id");
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
                    url: "/expense/delete/" + expenseId,
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

    $('.expenseAssignBtn').on('click', function(){
        const expenseId = $(this).data('id');
         const button = $(this);

        if(expenseId != ''){
            $.ajax({
                url: '/assign/expense/admin/' + expenseId,
                get: 'GET',
                success: function(response){
                    if(response && response.success == true){
                        button.text('Assigned');
                        button.removeClass('btn-success').addClass('btn-secondary');

                        // Show success notification
                        toastr.success('Expense assigned successfully', 'Success');
                    }
                },
                error: function(xhr){
                    console.log(xhr.status);

                }
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('a[data-lightbox]').forEach(function(element) {
            element.addEventListener('click', function() {
                var imageUrl = this.getAttribute('href');
                document.getElementById('downloadLink').setAttribute('href', imageUrl);
                document.getElementById('downloadLink').style.display = 'block';
            });
        });
    });
    document.querySelectorAll('.image-link').forEach(function(element) {
        element.addEventListener('click', function(event) {
            event.preventDefault();
            var imageSrc = this.getAttribute('data-src');

            // Set the image source and download link
            document.getElementById('modalImage').setAttribute('src', imageSrc);
            document.getElementById('downloadLink').setAttribute('href', imageSrc);

            // Show the modal
            document.getElementById('imageModal').style.display = 'flex';
        });
    });

    document.getElementById('modalClose').addEventListener('click', function() {
        document.getElementById('imageModal').style.display = 'none';
    });

    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    })
});
