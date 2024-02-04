<?php
session_start();
include("connection.php");


$con = new conct();
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['reservation_id']) && isset($_POST['action'])) {
        $reservation_id = $_POST['reservation_id'];
        $action = $_POST['action'];

        // Start transaction
        $con->conn->begin_transaction();

        try {
            // Check if action is to deny
            if ($action === 'deny') {
                // Delete from reservation_seats
                $querySeats = "DELETE FROM reservation_seats WHERE reservation_id = ?";
                $stmtSeats = $con->conn->prepare($querySeats);
                $stmtSeats->bind_param("i", $reservation_id);
                if (!$stmtSeats->execute()) {
                    throw new Exception("Error deleting from reservation_seats: " . $stmtSeats->error);
                }
                $stmtSeats->close();

                // Delete from reservations
                $queryReservations = "DELETE FROM reservations WHERE reservation_id = ?";
                $stmtReservations = $con->conn->prepare($queryReservations);
                $stmtReservations->bind_param("i", $reservation_id);
                if (!$stmtReservations->execute()) {
                    throw new Exception("Error deleting from reservations: " . $stmtReservations->error);
                }
                $stmtReservations->close();
            } elseif ($action === 'accept') {
                // Update status to Confirmed for accept action
                $status = 'Confirmed';
                $query = "UPDATE reservations SET status = ? WHERE reservation_id = ?";
                $stmt = $con->conn->prepare($query);
                $stmt->bind_param("si", $status, $reservation_id);
                if (!$stmt->execute()) {
                    throw new Exception("Error updating reservation: " . $stmt->error);
                }
                $stmt->close();
            } else {
                throw new Exception("Invalid action");
            }

            // Commit transaction
            $con->conn->commit();
            header("Location: dashboard.php?status=success");
        } catch (Exception $e) {
            $con->conn->rollback();
            header("Location: dashboard.php?status=error&message=" . urlencode($e->getMessage()));
        }
    } else {
        header("Location: dashboard.php?status=missing_data");
    }
} else {
    header("Location: dashboard.php");
}
?>