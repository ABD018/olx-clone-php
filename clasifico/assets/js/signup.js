document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.signup-form');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Clear previous error messages
        document.querySelectorAll('.error-message').forEach(function(el) {
            el.textContent = '';
        });

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const confirmPassword = document.getElementById('confirm_password').value.trim();
        const role = document.getElementById('role').value; // Get selected role
        let hasError = false;

        // Basic validation
        if (name === '') {
            document.getElementById('name-error').textContent = 'Name is required';
            hasError = true;
        }
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
        } else if (!validatePassword(password)) {
            document.getElementById('password-error').textContent = 'Password must be 6-12 characters long, contain at least one uppercase letter, and can include only @ as a special character';
            hasError = true;
        }
        if (confirmPassword === '') {
            document.getElementById('confirm_password-error').textContent = 'Confirm password is required';
            hasError = true;
        } else if (password !== confirmPassword) {
            document.getElementById('confirm_password-error').textContent = 'Passwords do not match';
            hasError = true;
        }

        if (hasError) return;

        const formData = new FormData(this);
       // formData.append('role', role); 

        fetch('controller/userController.php?action=signup', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = 'login.php';
            } else {
                document.getElementById('form-error').textContent = data.error || 'Signup failed';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('form-error').textContent = 'Signup failed';
        });
    });

    function validateEmail(email) {
        const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return re.test(email);
    }

    function validatePassword(password) {
        const re = /^(?=.*[A-Z])[A-Za-z0-9@]{6,12}$/;
        return re.test(password);
    }

    // Add input event listeners for styling and error message removal
    document.querySelectorAll('.signup-form input').forEach(function(input) {
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
