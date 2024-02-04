<?php
// delete_reservation.php
session_start();
include("connection.php");

$con = new conct();

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reservation_id'])) {
    $reservation_id = $_POST['reservation_id'];

    // Start transaction
    $con->conn->begin_transaction();

    try {
        // Delete from reservation_seats first to maintain referential integrity
        $stmtSeats = $con->conn->prepare("DELETE FROM reservation_seats WHERE reservation_id = ?");
        $stmtSeats->bind_param("i", $reservation_id);
        $stmtSeats->execute();
        $stmtSeats->close();

        // Delete the reservation
        $stmtReservation = $con->conn->prepare("DELETE FROM reservations WHERE reservation_id = ?");
        $stmtReservation->bind_param("i", $reservation_id);
        $stmtReservation->execute();
        $stmtReservation->close();

        // If everything is fine, commit the transaction
        $con->conn->commit();
        header("Location: dashboard.php?status=delete_success");
    } catch (Exception $e) {
        // If there is an error, rollback the transaction
        $con->conn->rollback();
        header("Location: dashboard.php?status=delete_error&message=" . urlencode($e->getMessage()));
    }
} else {
    header("Location: dashboard.php?status=delete_error&message=Missing reservation ID");
}
?>