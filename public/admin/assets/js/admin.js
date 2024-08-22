$(document).ready(function() {
    $('.userBtn').on('click', function(){
        const userId       = $(this).data('id');
        const trading_code = $(this).data('trading_code');
        const name         = $(this).data('name');
        const email        = $(this).data('email');
        const mobile       = $(this).data('mobile');
        const whatsapp     = $(this).data('whatsapp');
        const status       = $(this).data('status');
        const role         = $(this).data('role');
        const profileImage = $(this).data('profileimage');
        const signature    = $(this).data('signature');

        const profileImagePath = "{{ asset('storage/user_photo/profile') }}";
        const signaturePath = "{{ asset('storage/user_photo/signature') }}";

        $('#userId').val(userId);
        $('#name').val(name);
        $('#email').val(email);
        $('#mobile').val(mobile);
        $('#whatsapp').val(whatsapp);
        $('#trading_code').val(trading_code);
        $('#role').val(role);
        $('#status').val(status);

        if (profileImage) {
            $('#profileImg').attr('src', `${profileImagePath}/${profileImage}`);
        } else {
            $('#profileImg').attr('src', '');
        }

        if (signature) {
            $('#signatureImg').attr('src', `${signaturePath}/${signature}`);
        } else {
            $('#signatureImg').attr('src', '');
        }
    });

    $('#successAlert').show();

    setTimeout(function() {
        $('#successAlert').fadeOut('slow');
    }, 3000);
});
