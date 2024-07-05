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




$(document).ready(function(){
    $('#phone_number').on('input', function() {
        var phoneNumber = $(this).val();
        var isValid = /^09\d{9}$/.test(phoneNumber);
        if (isValid) {
            // Valid phone number
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        } else {
            // Invalid phone number
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
        }
    });
});


$(document).ready(function(){
    $('#address').on('change', function() {
        var address = $(this).val();
        var isValid = address !== null && address !== '';
        if (isValid) {
            // Valid address
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        } else {
            // Invalid address
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
        }
    });
});


$(document).ready(function(){
    $('#fullname').on('input', function() {
        var fullname = $(this).val();
        var isValid = /^[a-zA-Z\s]+$/.test(fullname);
        if (isValid) {
            // Valid full name
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        } else {
            // Invalid full name
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
        }
    });
});