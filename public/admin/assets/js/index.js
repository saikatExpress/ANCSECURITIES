$(document).ready(function() {
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
                    $('#wbank_account').val(response.tradeInfo.bank_account_no);
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
