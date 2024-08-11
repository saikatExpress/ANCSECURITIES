$(document).ready(function() {
    function updateClock() {
        const now = new Date();

        // Format time as 12-hour clock with AM/PM
        const hours = now.getHours();
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';
        const formattedHours = String(hours % 12 || 12).padStart(2, '0');

        // Format date
        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const dayName = days[now.getDay()];
        const date = now.getDate();
        const month = now.getMonth() + 1; // Months are zero-indexed
        const year = now.getFullYear();

        // Set formatted time and date
        $('#time').text(`${formattedHours}:${minutes}:${seconds} ${ampm}`);
        $('#date').text(`${dayName}, ${month}/${date}/${year}`);
    }

    // Update the clock every second
    setInterval(updateClock, 1000);
    updateClock();

    $('#wtrading_code').on('input', function(){
        const code = $(this).val();

        if(code != null){
            $.ajax({
                url: '/get/client/code/' + code,
                type: 'GET',
                success: function(response){
                    $('#wclient_id').val(response.user.id);
                    $('#wname').val(response.tradeInfo.name);
                    $('#wmobile').val(response.tradeInfo.cell_no);
                    $('#dbank_account').val(response.tradeInfo.bank_account_no);
                },
                error: function(error){
                    console.log(error);
                }
            });
        }
    });

    $('#dtrading_code').on('input', function(){
        const code = $(this).val();

        if(code != null){
            $.ajax({
                url: '/get/client/code/' + code,
                type: 'GET',
                success: function(response){
                    $('#dclient_id').val(response.user.id);
                    $('#dname').val(response.tradeInfo.name);
                    $('#dmobile').val(response.tradeInfo.cell_no);
                    $('#dbank_account').val(response.tradeInfo.bank_account_no);
                },
                error: function(error){
                    console.log(error);

                }
            });
        }
    });
});

const currentDate = new Date();

const options = {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: 'numeric',
    minute: 'numeric',
    hour12: true
};

const formattedDate = currentDate.toLocaleString('en-US', options);

document.getElementById('currentDateTime').textContent = formattedDate;

document.addEventListener('DOMContentLoaded', function() {
    // Get the current time
    var now = new Date();
    var hours = now.getHours().toString().padStart(2, '0');
    var minutes = now.getMinutes().toString().padStart(2, '0');

    // Set the current time as the default value
    document.getElementById('start-time').value = hours + ':' + minutes;
    document.getElementById('end-time').value = hours + ':' + minutes;
});

function updateTimeRemaining() {
    var now = new Date();
    var targetTime = new Date();

    targetTime.setHours(18, 30, 0, 0);

    var diff = targetTime - now;

    if (diff > 0) {
        var hours = Math.floor(diff / (1000 * 60 * 60));
        var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));

        var timeRemainingStr = hours + "h " + minutes + "m";

        document.getElementById("timeRemaining").textContent = timeRemainingStr;
    } else {
        targetTime.setDate(targetTime.getDate() + 1);
        updateTimeRemaining();
    }
}

updateTimeRemaining();

setInterval(updateTimeRemaining, 60000);
