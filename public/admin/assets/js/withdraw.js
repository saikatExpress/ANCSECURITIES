$(document).ready(function(){
    $('.withdrawBtn').on('click', function(){
        const reqId = $(this).data('id');

        if(reqId) {
            $.ajax({
                url: '/get/withdraw/info/' + reqId, // Replace with your actual route
                type: 'GET',
                success: function(response){
                    if (response.length > 0) {
                        const data = response[0];

                        if (data.md === null) {
                            $('#mdStatus').text('Processing...').removeClass('btn-success').addClass('btn-warning'); // Change to 'Processing...' and update button class
                        } else {
                            $('#mdStatus').text('Complete').removeClass('btn-warning').addClass('btn-success'); // Change back to 'Complete' and update button class
                        }


                        // Populate modal with response data
                        $('#reqId').val(data.id);
                        $('#clientName').text(data.client_name);
                        $('#amount').text(new Intl.NumberFormat('bn-BD', { style: 'currency', currency: 'BDT' }).format(data.amount));
                        $('#acNo').text(data.ac_no);
                        $('#description').text(data.description);
                        $('#withdrawDate').text(new Date(data.withdraw_date).toLocaleString());

                        if (!data.portfolio_file) {
                            $('#portfolioText').text('Not assigned').css('color','red');
                        } else {
                            $('#portfolioText').html(`<a href="/storage/${data.portfolio_file}" target="_blank">View Portfolio</a>`);
                        }

                        $('#mobile').text(data.clients.mobile);
                        $('#email').text(data.clients.email);
                        $('#tradeCode').text(data.clients.trading_code);
                        $('#status').html('<span style="background: darkred;" class="badge badge-' +
                            (data.status === 'pending' ? 'warning' :
                            (data.status === 'approved' ? 'success' : 'danger')) +
                            '">' + data.status.charAt(0).toUpperCase() + data.status.slice(1) + '</span>');
                        $('#feedback').text(data.feedback || 'N/A');
                        $('#remark').text(data.remark || 'N/A');

                        // Show the modal
                        $('#exampleModal').modal('show');
                    } else {
                        console.log('No data found');
                        alert('No data found for the selected request.');
                    }
                },
                error: function(error){
                    console.log(error);
                    alert('An error occurred while fetching data.');
                }
            });
        }
    });

    $('.withdrawStatusBtn').on('click', function(){
        const reqId = $(this).data('id');

        if(reqId != null){
            $.ajax({
                url: '/get/withdraw/status/' + reqId,
                type: 'GET',
                beforeSend: function(){

                },
                complete: function(){

                },
                success: function(response){
                    $('#statusModalLabel').text('Withdraw Request Status');
                    let portfolioHtml = '';
                    if (response.portfolio_file) {
                        portfolioHtml = `<a href="/storage/${response.portfolio_file}" target="_blank" class="btn btn-info">View Portfolio</a>`;
                    } else {
                        portfolioHtml = `<p style="color:red;margin-top:10px;">No portfolio attached</p>`;
                    }

                    $('#itemBody').html(`
                        <div class="client-info">
                            <h6>Client Name: ${response.client_name}</h6>
                            <p>Amount: ${response.amount + ' taka'}</p>
                            <p>Description: ${response.description}</p>
                            <p>Withdraw Date: ${new Date(response.withdraw_date).toLocaleDateString()}</p>
                            ${portfolioHtml}
                        </div>
                    `);

                    $('#modalfooter').html(`
                        <button type="button" class="btn btn-success" id="acceptBtn" data-id="${response.id}">Accept</button>
                        <button type="button" class="btn btn-danger" id="denyBtn" data-id="${response.id}">Deny</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    `);

                },
                error: function(xhr){
                    console.log(xhr);
                }
            });
        }
    });

    $(document).on('click', '#acceptBtn, #denyBtn', function() {
        var requestId = $(this).data('id');
        var action = $(this).attr('id') === 'acceptBtn' ? 'accept' : 'deny';

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: '/upgrade/withdraw/status',
            type: 'POST',
            data: {
                id: requestId,
                status: action
            },
            success: function(response) {
                toastr.success('Withdraw request status updated successfully!');
                location.reload();
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    });

});
