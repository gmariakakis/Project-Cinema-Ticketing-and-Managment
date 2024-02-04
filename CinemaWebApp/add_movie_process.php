<?php
// Start the session to maintain a user session across different pages
session_start();

// Include the database connection file
include("connection.php");

// Create a new database connection object
$con = new conct();

// Check if the request method is POST, indicating form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather data from the POST request and store in an associative array
    $data = [
        'title' => $_POST['title'],          // Title of the movie
        'description' => $_POST['description'], // Description of the movie
        'image_url' => $_POST['image_url'],     // URL of the movie's image
        'cast' => $_POST['cast']                // Cast information of the movie
    ];

    // Call the insert method of the database connection object to insert data into the 'movies' table
    $result = $con->insert('movies', $data);

    // Check if the insert operation returned a numeric value (likely an ID), indicating success
    if (is_numeric($result)) {
        // Redirect to the dashboard with a success status
        header("Location: dashboard.php?status=add_success");
    } else {
        // Redirect to the dashboard with an error status
        header("Location: dashboard.php?status=add_error");
    }
} else {
    // If the request method is not POST, redirect to the dashboard
    header("Location: dashboard.php");
}
?>
