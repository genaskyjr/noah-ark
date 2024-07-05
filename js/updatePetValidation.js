


$(document).ready(function(){
    $('#pet_name').on('input', function() {
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


$(document).ready(function(){
    $('#pet_gender').on('change', function() {
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
    $('#pet_type').on('change', function() {
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
    $('#file').on('change', function() {
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


