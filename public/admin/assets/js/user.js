$(document).ready(function() {

    $('#trading_code').on('input', function(){
        var code = $(this).val();

        if(code){
            $.ajax({
                url: '/get/trade/code/' + code,
                type: 'GET',
                success: function(response){
                    if(response && response.warning === false){
                        $('#accountExits').html('Sorry : This account already registered..!');
                        $('#name, #email, #mobile').val('');
                        return false;
                    }

                    if (response && response.success === true) {
                        $('#avaiable, .instructions, #register_form').show();
                        $('#notavaiable').hide();
                        $('#accountExits').hide();
                        $('#name').val(response.traderInfo.name);
                        $('#email').val(response.traderInfo.email);
                        $('#mobile').val(response.traderInfo.cell_no);
                    } else {
                        $('#name, #email, #mobile').val('');
                    }
                },
                error: function(error){
                    console.error('An error occurred:', error);
                }
            });
        }
    });

    $('#successAlert').show();

    setTimeout(function() {
        $('#successAlert').fadeOut('slow');
    }, 3000);

    $('#errorAlert').show();

    setTimeout(function() {
        $('#errorAlert').fadeOut('slow');
    }, 3000);
});
