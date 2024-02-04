<?php
include("connection.php");

$con = new conct(); // Create an instance of the conct class

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['contact_email'];
    $phone = $_POST['contact_phone'];
    $message = $_POST['contact_message'];

    // Check if the connection is successful
    if ($con->conn) {
        // Prepare and bind
        $stmt = $con->conn->prepare("INSERT INTO contact_messages (email, phone, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $phone, $message);

        // Execute and check for success
        if($stmt->execute()){
            $stmt->close();
            $con->conn->close();
            // Redirect to thank_you.php
            header("Location: thank_you.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: Failed to connect to the database.";
    }

    $con->conn->close();
}
?>