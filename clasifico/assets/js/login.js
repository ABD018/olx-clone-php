document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.login-form');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Clear previous error messages
        document.querySelectorAll('.error-message').forEach(function(el) {
            el.textContent = '';
        });

        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        let hasError = false;

        // Basic validation
        if (email === '') {
            document.getElementById('email-error').textContent = 'Email is required';
            hasError = true;
        } else if (!validateEmail(email)) {
            document.getElementById('email-error').textContent = 'Invalid email format';
            hasError = true;
        }
        if (password === '') {
            document.getElementById('password-error').textContent = 'Password is required';
            hasError = true;
        }

        if (hasError) return;

        const formData = new FormData(this);
        const action = 'login';

        fetch(`controller/userController.php?action=${action}`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = 'index.php';
            } else {
                document.getElementById('form-error').textContent = data.error || 'Login failed';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('form-error').textContent = 'Login failed';
        });
    });

    function validateEmail(email) {
        const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return re.test(email);
    }

    // Add input event listeners for styling and error message removal
    document.querySelectorAll('.login-form input').forEach(function(input) {
        input.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.style.borderColor = 'green';
                document.getElementById(`${this.id}-error`).textContent = '';
            } else {
                this.style.borderColor = 'red';
            }
        });
    });
});
