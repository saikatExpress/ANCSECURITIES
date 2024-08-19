$(document).ready(function(){
    $('.cancelBtn').on('click', function(){
        const fundId = $(this).data('id');
        const clientId = $(this).data('user_id');
        const $row = $(this).closest('tr');

        if (!fundId || !clientId) {
            console.error('Missing fundId or clientId.');
            return false;
        }

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
                console.error('Error cancelling fund request.', error);
            }
        });
    });
});

setTimeout(function() {
    document.getElementById('success-message').style.display = 'none';
}, 3000);
setTimeout(function() {
    document.getElementById('error-message').style.display = 'none';
}, 5000);
