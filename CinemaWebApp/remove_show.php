<?php
include("connection.php");
$con = new conct();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $show_id = $_POST['id'];

    // Delete query
    $sql = "DELETE FROM shows WHERE id = ?";
    $stmt = $con->conn->prepare($sql);
    $stmt->bind_param("i", $show_id);

    if ($stmt->execute()) {
        // Redirect to the dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
?>
