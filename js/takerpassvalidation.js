const passwordInput = document.getElementById('password');
    const passwordMessage = document.getElementById('password-message');

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const isValid = this.checkValidity();

        if (password.length === 0) {
            passwordMessage.textContent = '';
            passwordMessage.className = 'password-requirements';
            return;
        }

        if (isValid) {
            passwordMessage.textContent = 'Password meets requirements.';
            passwordMessage.className = 'password-requirements valid';
        } else {
            passwordMessage.textContent = 'Password must be at least 6 characters long, contain one uppercase, one lowercase, and one number.';
            passwordMessage.className = 'password-requirements invalid';
        }
    });