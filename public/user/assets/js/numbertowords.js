$(document).ready(function() {
    function numberToWords(num) {
        if (num === 0) return 'zero';

        var a = ['','one','two','three','four','five','six','seven','eight','nine'];
        var b = ['ten','eleven','twelve','thirteen','fourteen','fifteen','sixteen','seventeen','eighteen','nineteen'];
        var c = ['twenty','thirty','forty','fifty','sixty','seventy','eighty','ninety'];
        var d = ['hundred','thousand','lakh','million','billion'];

        var words = '';

        function convertChunk(n) {
            var chunk = '';
            if (n >= 100) {
                chunk += a[Math.floor(n / 100)] + ' hundred ';
                n %= 100;
            }
            if (n >= 20) {
                chunk += c[Math.floor(n / 10) - 2] + (n % 10 > 0 ? '-' + a[n % 10] : '');
            } else if (n >= 10) {
                chunk += b[n - 10];
            } else if (n > 0) {
                chunk += a[n];
            }
            return chunk.trim();
        }

        if (num >= 10000000) {
            words += convertChunk(Math.floor(num / 10000000)) + ' crore ';
            num %= 10000000;
        }
        if (num >= 100000) { // Lakhs
            words += convertChunk(Math.floor(num / 100000)) + ' lakh ';
            num %= 100000;
        }
        if (num >= 1000) { // Thousands
            words += convertChunk(Math.floor(num / 1000)) + ' thousand ';
            num %= 1000;
        }
        if (num > 0) { // Hundreds
            words += convertChunk(num);
        }

        return words.trim() + ' only';
    }

    $('#amount').on('input', function() {
        var amount = parseInt($(this).val(), 10);
        if (isNaN(amount)) {
            $('#amount-info').text('');
            return;
        }

        var words = numberToWords(amount);
        $('#amount-info').text(words.charAt(0).toUpperCase() + words.slice(1));
    });
});
