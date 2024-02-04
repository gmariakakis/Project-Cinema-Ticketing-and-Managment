<?php
include("connection.php");
$con = new conct();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$show_id = $_POST['id'] ;
$movie_id = $_POST['movie_id'] ;
$room_id = $_POST['room_id'] ;
$show_date = $_POST['show_date'];
$show_time_id = $_POST['show_time_id'];

  $overlapQuery = "SELECT id FROM shows 
                 WHERE room_id = ? 
                 AND show_date = ? 
                 AND show_time_id = ? 
                 AND id != ?"; 
  $stmt = $con->conn->prepare($overlapQuery);
$stmt->bind_param("isis", $room_id, $show_date, $show_time_id, $show_id);
$stmt->execute();
$result = $stmt->get_result();
  if ($result->num_rows > 0) {
    // Overlapping show found
    echo "Error: Another show is already scheduled in the same room at the same date and time.";
} else {
    // No overlapping show, proceed with update
    $updateQuery = "UPDATE shows SET movie_id = ?, room_id = ?, show_date = ?, show_time_id = ? WHERE id = ?";
    $updateStmt = $con->conn->prepare($updateQuery);
    $updateStmt->bind_param("iisii", $movie_id, $room_id, $show_date, $show_time_id, $show_id);

    if ($updateStmt->execute()) {
        // Redirect to the dashboard or display success message
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error updating record: " . $updateStmt->error;
    }
}} else {
    echo "No POST data received.";
}
?>
