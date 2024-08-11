$(document).ready(function(){
    $('.withdrawBtn').on('click', function(){
        const reqId = $(this).data('id');

        if(reqId) {
            $.ajax({
                url: '/get/withdraw/info/' + reqId, // Replace with your actual route
                type: 'GET',
                success: function(response){
                    if (response.length > 0) {
                        const data = response[0]; // Access the first item in the array

                        // Populate modal with response data
                        $('#reqId').val(data.id);
                        $('#clientName').text(data.client_name);
                        $('#amount').text(new Intl.NumberFormat('bn-BD', { style: 'currency', currency: 'BDT' }).format(data.amount));
                        $('#acNo').text(data.ac_no);
                        $('#description').text(data.description);
                        $('#withdrawDate').text(new Date(data.withdraw_date).toLocaleString());
                        $('#mobile').text(data.clients.mobile);
                        $('#email').text(data.clients.email);
                        $('#tradeCode').text(data.clients.trading_code);
                        $('#status').html('<span class="badge badge-' +
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

    $('#withDrawPortfolioForm').on('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert('Form submitted successfully!');
                $('#exampleModal').modal('hide');
                // Optionally, handle the response data or update the UI
            },
            error: function(xhr, status, error) {
                console.log('Submission failed:', error);
                alert('An error occurred while submitting the form.');
            }
        });
    });
});
