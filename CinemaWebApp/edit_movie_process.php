<?php
session_start();
include("connection.php");

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    // Redirect if not logged in or not admin
    header("Location: login.php");
    exit;
}

$con = new conct();

// Check if the form has been submitted via POST method and if the 'id' field is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Collect data from the form submission
    $movie_id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $cast = $_POST['cast'];

    // Perform basic validation on the input data
    if (empty($title) || empty($movie_id)) {
        // Redirect to the dashboard with a validation error status if validation fails
        header("Location: dashboard.php?status=validation_error");
        exit;
    }

    // Prepare an SQL query to update the movie details
    $query = "UPDATE movies SET title=?, description=?, image_url=?, cast=? WHERE id=?";
    $stmt = $con->conn->prepare($query);

    // Check if the statement preparation was successful
    if (!$stmt) {
        // Redirect to the dashboard with a statement preparation error status
        header("Location: dashboard.php?status=stmt_preparation_error");
        exit;
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("ssssi", $title, $description, $image_url, $cast, $movie_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the dashboard with a success status if execution is successful
        header("Location: dashboard.php?status=edit_success");
    } else {
        // Redirect to the dashboard with an execution error status
        header("Location: dashboard.php?status=edit_error");
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Redirect to the dashboard with an invalid request status if the request is not valid
    header("Location: dashboard.php?status=invalid_request");
}
?>