document.addEventListener('DOMContentLoaded', function() {
    var isMobile = /Mobi|Android/i.test(navigator.userAgent) || window.innerWidth <= 768;
    var statusLabel = document.getElementById('status-label');
    var statusMessage = document.getElementById('status-message');
    var showMore = document.getElementById('show-more');
    var showLess = document.getElementById('show-less');

    var fullMessage = 'আপনার ফান্ড ডিপোজিটের আবেদনটি সঠিকভাবে সম্পন্ন হয়েছে।আমরা কিছুক্ষনের মধ্যে আপনাকে ফোন করে জানিয়ে দিব। ধন্যবাদ...<span style="color:red;font-size:10px;">&#x2665;</span>';
    var shortMessage = 'আপনার ফান্ড ডিপোজিটের আবেদনটি সঠিকভাবে...';

    if (isMobile) {
        statusLabel.innerHTML = 'Pending';
        statusMessage.innerHTML = shortMessage;
        showMore.style.display = 'inline';

        showMore.addEventListener('click', function() {
            statusMessage.innerHTML = fullMessage;
            showMore.style.display = 'none';
            showLess.style.display = 'inline';
        });

        showLess.addEventListener('click', function() {
            statusMessage.innerHTML = shortMessage;
            showMore.style.display = 'inline';
            showLess.style.display = 'none';
        });
    } else {
        statusLabel.innerHTML = 'Pending';
        statusMessage.innerHTML = fullMessage;
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var isMobile = /Mobi|Android/i.test(navigator.userAgent) || window.innerWidth <= 768;
    var statusLabel = document.getElementById('status-label1');
    var statusMessage = document.getElementById('status-message1');
    var showMore = document.getElementById('show-more1');
    var showLess = document.getElementById('show-less1');

    var fullMessage = 'আপনার ফান্ড ট্রান্সপারের আবেদনটি সঠিকভাবে সম্পন্ন হয়েছে।আমরা কিছুক্ষনের মধ্যে আপনাকে ফোন করে জানিয়ে দিব।ধন্যবাদ...<span style="font-size:10px;">&#x2665;</span>';
    var shortMessage = 'আপনার ফান্ড ট্রান্সপারের আবেদনটি সঠিকভাবে...';

    if (isMobile) {
        statusLabel.innerHTML = 'Approved';
        statusMessage.innerHTML = shortMessage;
        showMore.style.display = 'inline';

        showMore.addEventListener('click', function() {
            statusMessage.innerHTML = fullMessage;
            showMore.style.display = 'none';
            showLess.style.display = 'inline';
        });

        showLess.addEventListener('click', function() {
            statusMessage.innerHTML = shortMessage;
            showMore.style.display = 'inline';
            showLess.style.display = 'none';
        });
    } else {
        statusLabel.innerHTML = 'Approved';
        statusMessage.innerHTML = fullMessage;
    }
});
