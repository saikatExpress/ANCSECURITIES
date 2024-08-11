$(document).ready(function(){
    $('.editBtn').on('click', function(){
        const reqId = $(this).data('id');
        const clientId = $(this).data('client_id');
        const name = $(this).data('name');
        const tradingCode = $(this).data('trading_code');
        const amount = $(this).data('amount');
        const status = $(this).data('status');

        $('#req_id').val(reqId);
        $('#clientId').val(clientId);
        $('#lname').val(name);
        $('#tradingCode').val(tradingCode);
        $('#lamount').val(amount);
        $('#status').val(status);
    });

    $('#tradingCode').on('input', function(){
        $('#lname').val('');
        $('#clientId').val('');

        const code = $(this).val();

        if(code != null){
            $.ajax({
                url: '/get/client/code/' + code,
                type: 'GET',
                success: function(response){
                    $('#clientId').val(response.user.id);
                    $('#lname').val(response.tradeInfo.name);
                },
                error: function(error){
                    console.log(error);
                }
            });
        }
    });
});
