document.addEventListener('DOMContentLoaded', function() {
    // Example Ajax call
    document.querySelector('#someElement').addEventListener('click', function() {
        fetch('ajax_handler.php', {
            method: 'POST',
            body: new URLSearchParams({ action: 'someAction' })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // Handle response data
        });
    });
});
