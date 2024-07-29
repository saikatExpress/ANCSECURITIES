$(document).ready(function() {
    // Trigger file input click when 'Choose File' button is clicked
    $('#choose-file-btn').click(function() {
        $('#file-input').click();
    });

    // Handle file selection
    $('#file-input').change(function() {
        var file = $(this).prop('files')[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image').attr('src', e.target.result);
                $('#clear-btn').removeClass('d-none');
                $('#save-btn').removeClass('d-none');
            };
            reader.readAsDataURL(file);
        }
    });

    // Handle form submission
    $('#save-btn').click(function() {
        var csrfToken = $('#csrf-token').val(); // Get CSRF token from hidden field

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        var formData = new FormData($('#image-form')[0]);

        $.ajax({
            url: '/upload/bo/image', // Laravel route for image upload
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle successful response (e.g., display a success message)
                alert('Image uploaded successfully');
            },
            error: function(xhr, status, error) {
                // Handle error response
                alert('An error occurred');
            }
        });
    });

    // Handle clearing the image
    $('#clear-btn').click(function() {
        $('#file-input').val('');
        $('#preview-image').attr('src', 'https://onlinebo.uftfast.com/assets/images/Not-found-image.svg');
        $('#clear-btn').addClass('d-none');
        $('#save-btn').addClass('d-none');

        // Optionally send an AJAX request to remove the image from the database
        $.ajax({
            url: '/delete-image', // Laravel route for image deletion
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Include CSRF token
                id: $('#image-form input[name="user_id"]').val()
            },
            success: function(response) {
                // Handle successful response (e.g., display a success message)
                alert('Image removed successfully');
            },
            error: function(xhr, status, error) {
                // Handle error response
                alert('An error occurred');
            }
        });
    });
});
