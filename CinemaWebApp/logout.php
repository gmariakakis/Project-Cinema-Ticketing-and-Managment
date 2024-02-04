<?php
session_start();
session_destroy(); // Destroys the session and logs out the user
header("Location: index.php"); // Redirect to the home page or login page
exit;
?>
