const passwordInput = document.getElementById('password');
const showPasswordBtn = document.getElementById('showPasswordBtn');
const eyeIcon = document.getElementById('eyeIcon');

showPasswordBtn.addEventListener('click', togglePasswordVisibility);

function togglePasswordVisibility() {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.add('closed');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('closed');
    }
}
