$(document).ready(function(){
    $('.withdrawBtn').on('click', function(){
        const reqId = $(this).data('id');

        if(reqId) {
            $.ajax({
                url: '/get/withdraw/info/' + reqId,
                type: 'GET',
                success: function(response){
                    if (response.length > 0) {
                        const data = response[0];

                        if (data.mdstatus === null) {
                            $('#mdStatus').text('Processing...').removeClass('btn-success').addClass('btn-warning');
                        } else {
                            $('#mdStatus').text('Complete').removeClass('btn-warning').addClass('btn-success');
                        }

                        if (data.ceostatus === null) {
                            $('#ceoStatus').text('Processing...').removeClass('btn-success').addClass('btn-warning');
                        } else {
                            $('#ceoStatus').text('Complete').removeClass('btn-warning').addClass('btn-success');
                        }


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
                url: '/withdraw/get/status/' + reqId,
                type: 'GET',
                beforeSend: function(){

                },
                complete: function(){

                },
                success: function(response){
                    $('#statusModalLabel').text('Withdraw Request Status');
                    let portfolioHtml = '';
                    if (response.portfolio_file) {
                        portfolioHtml = `<a href="/storage/${response.portfolio_file}" target="_blank" class="btn btn-sm btn-info">View Portfolio</a>`;
                    } else {
                        portfolioHtml = `<p style="color:red;margin-top:10px;">No portfolio attached</p>`;
                    }

                    $('#itemBody').html(`
                        <div class="client-info">
                            <input type="hidden" name="req_id" id="req_id" value="${response.id}"/>
                            <h6>Client Name: ${response.client_name}</h6>
                            <p>Amount: ${response.amount + ' taka'}</p>
                            <p>Description: ${response.description}</p>
                            <p>Withdraw Date: ${new Date(response.withdraw_date).toLocaleDateString()}</p>
                            ${portfolioHtml}
                        </div>
                    `);

                    $('#modalfooter').html(`
                        <button type="button" class="btn btn-sm btn-success" id="acceptBtn" data-id="${response.id}">Accept</button>
                        <button type="button" class="btn btn-sm btn-danger" id="denyBtn" data-id="${response.id}">Deny</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
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
            url: '/withdraw/upgrade/status',
            type: 'POST',
            data: {
                id: requestId,
                status: action
            },
            success: function(response) {
                if(response && response.success === true){
                    toastr.success(response.message);
                    location.reload();
                }

                if(response && response.error === false){
                    toastr.error(response.message);
                }
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    });

    $('#markAll').click(function() {
        var isChecked = $(this).data('checked') || false;
        $('.item-checkbox').prop('checked', !isChecked);
        $(this).data('checked', !isChecked);
        $(this).text(isChecked ? 'Mark All' : 'Unmark All');
    });

    $('#makeFile').click(function() {
        var selectedItems = [];
        $('.item-checkbox:checked').each(function() {
            selectedItems.push($(this).data('id'));
        });

        if (selectedItems.length > 0) {
            $.ajax({
                url: '/make/withdraw/file',
                type: 'GET',
                data: {
                    ids: selectedItems
                },
                success: function(response) {
                    if (response && response.success === true) {
                        toastr.success('File created successfully!');
                    }

                    if(response && response.success === false) {
                        toastr.error('Already make file these requests.');
                    }

                    if(response && response.error === false) {
                        toastr.error('Not approved by Business Head.');
                    }
                },
                error: function(xhr) {
                    alert('An error occurred while creating the file.');
                }
            });
        } else {
            $('#errMessage').text('Please select at least one item.');
            return false;
        }
    });

    $('#sendRemarkBtn').on('click', function(){
        const id = $('#req_id').val();
        const remark = $('#remark_text').val().trim();

        if(remark === ''){
            toastr.error('Please write something.');
            return false;
        }else{
            $.ajax({
                url: '/send/remark',
                method: 'GET',
                data: {
                    id: id,
                    remark: remark
                },
                success: function(response){
                    if(response && response.success === true){
                        toastr.success(response.message);
                        $('#remark_text').val('');
                    }else{
                        toastr.error(response.message);
                    }
                },
                error: function(xhr){
                    console.log(xhr);
                }
            });
        }
    });

    $(document).on('click', '.reqDelBtn', function(){
        var reqId = $(this).data("id");
        var listItem = $(this).closest(".list-item");

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
                $.ajax({
                    type: "GET",
                    url: "/withdraw/req/delete/" + reqId,
                    success: function (response) {
                        if(response && response.success === true){
                            listItem.remove();
                            Swal.fire("Deleted!", response.message, "success");
                        }

                        if(response && response.error === false){
                            Swal.fire("error!", response.message, "error");
                        }
                    },
                    error: function (error) {
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

});
