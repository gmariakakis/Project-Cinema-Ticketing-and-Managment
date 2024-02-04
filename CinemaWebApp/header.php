
<html>
<?php
// PHP block to handle server-side functionality

// Include the database connection settings
include("connection.php");

// Start or resume a session
session_start();

// Regenerate session ID for security purposes
session_regenerate_id();

// Implement session timeout for user inactivity
$timeout = 600; // Timeout duration in seconds (e.g., 600 seconds equals 10 minutes)
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    // Check if the last activity was more than the timeout duration ago
    session_unset();     // Unset session variables
    session_destroy();   // Destroy the session
}
$_SESSION['last_activity'] = time(); // Update the session's last activity time stamp
?>

<head>
   
    <title>Penguins Main</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="styling.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="images/logo.png" type="image/png" sizes="16x16">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark fixed-top">
    <!-- Navigation bar content -->
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="images/logo.png" style="width:50px;"/> <!-- Logo image -->
        </a>
        <!-- Responsive navigation bar toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h4 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Penguins Cinema</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <!-- Display username if user is logged in -->
                        <?php if (isset($_SESSION['username'])): ?>
                            <h2>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
                        <?php endif; ?>
                    </li>
                    <!-- Navigation links -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact us</a>
                    </li>
                    <hr class="hr" />
                    <!-- Conditional navigation links based on user login status -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <!-- Links for logged-in users -->
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Log out</a>
                        </li>
                    <?php else: ?>
                        <!-- Links for guests -->
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Log in</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">Sign up</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</nav>
<style>.main-content{
    padding-top: 50px;
}</style>
<div class="main-content">
    <!-- Main content goes here -->