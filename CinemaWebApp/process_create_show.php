<?php
// process_create_show.php
include("connection.php");
$con = new conct();

// Check if the form is submitted via the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from the POST request and store it in an associative array
    $data = [
        'movie_id' => $_POST['movie_id'],      // Movie ID from the form
        'room_id' => $_POST['room_id'],        // Room ID from the form
        'show_date' => $_POST['show_date'],    // Show date from the form
        'show_time_id' => $_POST['show_time_id'] // Show time ID from the form
    ];

    // Call the 'insert' method to insert the data into the 'shows' table
    $result = $con->insert('shows', $data);

    // Check if the result of the insertion is a numeric value, indicating success
    if (is_numeric($result)) {
        // Redirect to the dashboard with a success status and message
        header("Location: dashboard.php?status=success&message=Show created");
    } else {
        // Redirect to the dashboard with an error status and message if insertion fails
        header("Location: dashboard.php?status=error&message=Error creating show");
    }
} else {
    // Redirect to the dashboard with an error status and message if the request is not POST
    header("Location: dashboard.php?status=error&message=Invalid request");
}
?>