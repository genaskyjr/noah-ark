
$(document).ready(function(){
    $('#adoption_nickname').on('input', function() {
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
    $('#adoption_gender').on('change', function() {
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
    $('#adoption_recued').on('change', function() {
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
    $('#adoption_type').on('change', function() {
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
    $('#file').on('input', function() {
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