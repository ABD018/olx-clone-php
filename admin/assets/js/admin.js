$(document).ready(function() {
    // Load Users
    $.ajax({
        url: 'ajax/fetchAllUsers.php',
        method: 'GET',
        success: function(data) {
            $('#usersTable').html(data);
        }
    });

    // Load Ads
    $.ajax({
        url: 'ajax/fetchAllAds.php',
        method: 'GET',
        success: function(data) {
            $('#adsTable').html(data);
        }
    });
});
