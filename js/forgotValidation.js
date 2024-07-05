$(document).ready(function(){
    $('#password').on('input', function() {
        var password = $(this).val();
        var isValid = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/.test(password);
        if (isValid) {
            // Valid password
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
            $('#password-error').hide();
        } else {
            // Invalid password
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            $('#password-error').text('Password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, and one digit.');
            $('#password-error').show();
        }
    });
});

$(document).ready(function(){
    $('#password1').on('input', function() {
        var password = $('#password').val();
        var confirmedPassword = $(this).val();
        var isValid = password === confirmedPassword;
        if (isValid) {
            // Matched passwords
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
            $('#password1-error').hide();
        } else {
            // Passwords do not match
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            $('#password1-error').text('Passwords do not match.');
            $('#password1-error').show();
        }
    });
});