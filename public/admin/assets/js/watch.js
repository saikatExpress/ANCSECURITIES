$(document).ready(function(){
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
});
