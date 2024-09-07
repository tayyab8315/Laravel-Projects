import './bootstrap';

$(document).ready(function() {
    // Hide the alert after 3 seconds
    setTimeout(function() {
        $("#alertBox").fadeOut('slow');
    }, 3000);
});