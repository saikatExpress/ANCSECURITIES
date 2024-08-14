$(document).ready(function(){
    $('.cancelButton').on('click', function(){

        const fundId   = $(this).data('id');
        const clientId = $(this).data('user_id');
        const $row     = $(this).closest('tr');

        // Validate fundId and clientId
        if (!fundId || !clientId) {
            console.error('Missing fundId or clientId.');
            return false;
        }

        // AJAX request to cancel fund request
        $.ajax({
            url: '/cancel/fund/request',
            method: 'GET',
            data: {
                fundId: fundId,
                clientId: clientId
            },
            success: function(response){
                $row.fadeOut('slow', function(){
                    $(this).remove();
                });
            },
            error: function(error){
                // Handle error response here
                console.error('Error cancelling fund request.', error);
                // Optionally display error message or handle UI updates
            }
        });
    });
});
