$(document).ready(function() {
  $('#password-toggle').on('click', function() {
    const passwordField = $('#password');
    const passwordIcon = $('#password-icon');

    if (passwordField.attr('type') === 'password') {
      passwordField.attr('type', 'text');
      passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
      passwordField.attr('type', 'password');
      passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
    }
  });

  $('#confirm-password-toggle').on('click', function() {
    const confirmPasswordField = $('#confirm_password');
    const confirmPasswordIcon = $('#confirm-password-icon');

    if (confirmPasswordField.attr('type') === 'password') {
      confirmPasswordField.attr('type', 'text');
      confirmPasswordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
      confirmPasswordField.attr('type', 'password');
      confirmPasswordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
    }
  });

  $('#password, #confirm_password').on('input', function() {
    const password = $('#password').val();
    const confirmedPassword = $('#confirm_password').val();

    const isValidPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/.test(password);
    const isMatched = password === confirmedPassword;

    if (isValidPassword) {
      $('#password').removeClass('is-invalid').addClass('is-valid');
      $('#password1-error').hide();
    } else {
      $('#password').removeClass('is-valid').addClass('is-invalid');
      $('#password1-error').text('Password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, and one digit.');
      $('#password1-error').show();
    }

    if (isMatched) {
      $('#confirm_password').removeClass('is-invalid').addClass('is-valid');
      $('#password1-error').hide();
    } else {
      $('#confirm_password').removeClass('is-valid').addClass('is-invalid');
      $('#password1-error').text('Passwords do not match.');
      $('#password1-error').show();
    }
  });
});
