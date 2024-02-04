<?php
// Start or resume a session
session_start();

// Include the database connection file
include("connection.php"); 

// Check if the login form has been submitted
if (isset($_POST['login_submit'])) {
    // Retrieve the username and password from the POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create a new database connection instance
    $con = new conct();
    // Prepare an SQL query to fetch the user with the given username
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $con->conn->prepare($query);
    // Bind the username parameter to the prepared statement
    $stmt->bind_param("s", $username);
    // Execute the prepared statement
    $stmt->execute();
    // Retrieve the result of the query
    $result = $stmt->get_result();
    // Fetch the user data as an associative array
    $user = $result->fetch_assoc();

    // Check if the user exists and the password is correct
    if ($user && password_verify($password, $user['password'])) {
        // Set session variables for the user
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin']; 

        // Check if the user is an admin and redirect accordingly
        if ($user['is_admin']) {
            header("Location: dashboard.php");
        } else {
            // Redirect to the intended page or the index page
            $redirectURL = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : 'index.php';
            unset($_SESSION['redirect_url']);
            header("Location: $redirectURL");
            exit;
        } 
    } 
    // Close the statement
    $stmt->close();
} else {
    // Redirect to the login page if the script is accessed directly
    header("Location: login.php");
    exit;
}
?>
