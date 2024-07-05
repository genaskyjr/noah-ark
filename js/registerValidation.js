
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
    });z
});


$(document).ready(function(){
    $('#email').on('input', function() {
        var email = $(this).val();
        var isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        if (isValid) {
            // Valid email
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
            $('#email-feedback').text(''); // Clear any previous error message
        } else {
            // Invalid email
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            $('#email-feedback').text('Please enter a valid email address');
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




(document).ready(function() {
    // ... other code for form submission and validation

    // Toggle password visibility for password field
    $('#password-toggle').on('click', function() {
        var passwordField = $('#password');
        var fieldType = passwordField.attr('type');

        if (fieldType === 'password') {
            passwordField.attr('type', 'text');
            $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordField.attr('type', 'password');
            $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Toggle password visibility for confirm password field
    $('#confirm-password-toggle').on('click', function() {
        var confirmPasswordField = $('#confirm_password');
        var fieldType = confirmPasswordField.attr('type');

        if (fieldType === 'password') {
            confirmPasswordField.attr('type', 'text');
            $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            confirmPasswordField.attr('type', 'password');
            $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Remove the 'show password' functionality for confirm password
    $('#confirm_password').removeAttr('onfocus');
    $('#confirm_password').removeAttr('onblur');
    $('#confirm-password-toggle').remove(); // Remove the button for show/hide password

    // Other input validations...
});

