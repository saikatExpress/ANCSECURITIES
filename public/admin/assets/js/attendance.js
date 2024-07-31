function updateStatus(employeeId, status) {
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
                $('#status-' + employeeId).text(status);
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
