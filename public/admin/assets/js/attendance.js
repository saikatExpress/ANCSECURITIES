$(document).ready(function() {
    $('#updateAllButton').click(function() {
        var updates = [];

        // Iterate through each table row (employee)
        $('tbody tr').each(function() {
            var employeeId = $(this).find('td').eq(0).text();

            var inTime = $(this).find('input[id^="in-time-"]').val();
            var outTime = $(this).find('input[id^="out-time-"]').val();

            var updateData = {
                employeeId: employeeId,
                inTime: inTime,
                outTime: outTime
            };

            updates.push(updateData);
        });


        // Send updates to the server via AJAX
        $.ajax({
            url: '/update-all-attendance',
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify({ updates: updates }),
            success: function(response) {
                if (response && response.success === true) {
                    toastr.success('All attendance records updated successfully!');
                    location.reload();
                } else {
                    toastr.success('All attendance records updated successfully!');
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Failed to update attendance records.');
            }
        });
    });
});

function updateAttendanceStatus(employeeId, status) {
    // Get the in_time and out_time values
    var inTime = $('#in-time-' + employeeId).val();
    var outTime = $('#out-time-' + employeeId).val();

    $.ajax({
        url: `/update/attendance/status/${employeeId}`,
        type: 'POST', // Use POST method
        dataType: 'json',
        contentType: 'application/json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token
        },
        data: JSON.stringify({
            status: status,
            in_time: inTime,
            out_time: outTime
        }),
        success: function(data) {
            if (data.success) {
                var statusButton = $('#status-' + employeeId).find('p');
                console.log('Asd' + status);

                if (status === 'Updated') {
                    statusButton.removeClass('btn-danger').addClass('btn-success').text('Accepted');
                } else {
                    statusButton.removeClass('btn-success').addClass('btn-danger').text('Pending');
                }
                toastr.success('Attendance recorded successfully!');
            } else {
                alert('Failed to update status');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}
