document.addEventListener('DOMContentLoaded', function() {
    const profileForm = document.querySelector('#profile-form');

    // Fetch user profile data on page load
    fetch('controller/userController.php?action=fetchProfile')
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById('name').value = data.name || '';
                document.getElementById('email').value = data.email || '';
            }
        })
        .catch(error => console.error('Error fetching profile:', error));

    profileForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();

        const formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('password', password);

        fetch('controller/userController.php?action=updateProfile', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Profile updated successfully');
            } else {
                alert(data.error || 'Update failed');
            }
        })
        .catch(error => console.error('Error updating profile:', error));
    });
});
