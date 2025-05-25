$(document).ready(function() {
    // Function to check if user is logged in
    function checkLoginStatus() {
        $.ajax({
            url: 'AuthCheck.php', // Change this to your actual PHP file path
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.loggedIn) {
                    // User is logged in
                    document.getElementById('loginStatus').innerText = 'PROFILE';
                } else {
                    // User is not logged in
                    document.getElementById('loginStatus').innerText = 'LOGIN/SIGNUP';
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('Error:', error);
            }
        });
    }

    // Call the function to check login status on page load
    checkLoginStatus();
});