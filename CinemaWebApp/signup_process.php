<?php
// signup_process.php
include("connection.php");
$con = new conct();
// Check if the signup form has been submitted
if (isset($_POST['signup_submit'])) {
    // Prepare data array with user input, hashing the password
    $data = [
        'username' => $_POST['username'], // User's chosen username
        'email' => $_POST['email'],       // User's email address
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT) // Hashed password for security
    ];

    // Attempt to insert the new user data into the 'users' table
    $result = $con->insert('users', $data);

    // Check if the insert operation was successful (returns a numeric result)
    if (is_numeric($result)) {
        // Set user session variables upon successful registration
        $_SESSION['user_id'] = $result;        // Store user ID in session
        $_SESSION['username'] = $_POST['username']; // Store username in session

        // Redirect to the index page
        header("Location: index.php");
    } else {
        // Redirect back to the signup page with an error parameter if registration fails
        header("Location: signup.php?error=registration_failed");
    }
} else {
    // Redirect to the signup page if the form hasn't been submitted
    header("Location: signup.php");
}
?>