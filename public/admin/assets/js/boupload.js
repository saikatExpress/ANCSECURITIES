$(document).ready(function() {
    // Handle file selection
    $('.choose-file-btn').click(function() {
        $(this).siblings('.file-input').click();
    });

    $('.file-input').change(function() {
        var file = $(this).prop('files')[0];
        if (file) {
            var reader = new FileReader();
            var previewImage = $(this).closest('form').find('.preview-image');
            var clearBtn = $(this).closest('form').find('.upload-clear');
            var saveBtn = $(this).closest('form').find('.upload-btn');
            reader.onload = function(e) {
                previewImage.attr('src', e.target.result);
                clearBtn.removeClass('d-none');
                saveBtn.removeClass('d-none');
            };
            reader.readAsDataURL(file);
        }
    });

    // Handle form submission
    $('.upload-btn').click(function() {
        var form = $(this).closest('form');
        var formData = new FormData(form[0]);
        var actionUrl = form.attr('action');

        $.ajax({
            url: actionUrl,
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

    // Handle clear button
    $('.upload-clear').click(function() {
        var userId = $('.user_id').val();
        var form = $(this).closest('form');
        var formData = new FormData(form[0]);
        formData.append('_method', 'DELETE'); // To indicate a delete request

        $.ajax({
            url: '/delete/bo/image/' + userId, // URL to the controller method
            type: 'GET',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                form[0].reset();
                var previewImage = form.find('.preview-image');
                var clearBtn = form.find('.upload-clear');
                var saveBtn = form.find('.upload-btn');
                previewImage.attr('src', form.find('input[name="image_preview"]').val());
                clearBtn.addClass('d-none');
                saveBtn.addClass('d-none');
                // Handle additional success actions if necessary
                alert('Image removed successfully');
            },
            error: function(xhr, status, error) {
                // Handle error response
                alert('An error occurred while removing the image');
            }
        });
    });

});
