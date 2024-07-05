$(document).ready(function(){
    $('#event_name').on('input', function() {
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
    $('#event_desc').on('input', function() {
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
    var today = new Date().toISOString().split('T')[0];
    $('#event_date').attr('min', today);

    $('#event_date').on('change', function() {
        var selectedDate = new Date($(this).val());
        var currentDate = new Date(today);
        
        if (selectedDate >= currentDate) {
            // Valid: present or future date
            $(this).prop('disabled', false);
        } else {
            // Invalid: past date
            $(this).prop('disabled', true);
        }
    });
});




$(document).ready(function(){
    $('#event_time').on('change', function() {
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
    $('#event_location').on('input', function() {
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
    $('#event_image').on('input', function() {
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



