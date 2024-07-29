$(document).ready(function(){
    $('#nominee_1_is_guardian').on('click', function(){
        $('.nominee_1_guardian').toggle();
    });
    $('#add-nominee_2').on('click', function(){
        $('#nominee_2-details').toggle();
    });
    $('#nominee_2_is_guardian').on('click', function(){
        $('.nominee_2_guardian').toggle();
    });
    $('#is_director').change(function() {
        if ($(this).is(':checked')) {
            $('.director_company').slideDown();
        } else {
            $('.director_company').slideUp();
        }
    });

    $('.choose-file-btn').on('click', function() {
        $(this).siblings('.file-input').click();
    });

    // Preview the selected file
    $('.file-input').on('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('.preview-image').attr('src', e.target.result);
                $('.upload-clear').removeClass('d-none');
                $('.upload-btn').removeClass('d-none');
            };
            reader.readAsDataURL(file);
        }
    });

    // Clear the selected file
    $('.upload-clear').on('click', function() {
        $('.file-input').val('');
        $('.preview-image').attr('src', 'https://onlinebo.uftfast.com/assets/images/Not-found-image.svg');
        $(this).addClass('d-none');
        $('.upload-btn').addClass('d-none');
    });
});
