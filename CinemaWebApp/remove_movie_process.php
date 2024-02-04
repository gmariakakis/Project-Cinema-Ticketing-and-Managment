<?php
session_start();
include("connection.php");
$con = new conct();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $movie_id = $_POST['id'];

    // Start transaction
    $con->conn->begin_transaction();

    try {
        // Delete shows associated with the movie
        $stmtShows = $con->conn->prepare("DELETE FROM shows WHERE movie_id = ?");
        $stmtShows->bind_param("i", $movie_id);
        $stmtShows->execute();
        $stmtShows->close();

        // Delete the movie
        $stmtMovie = $con->conn->prepare("DELETE FROM movies WHERE id = ?");
        $stmtMovie->bind_param("i", $movie_id);
        $stmtMovie->execute();
        $stmtMovie->close();

        $con->conn->commit();
        header("Location: dashboard.php?status=remove_success");
    } catch (Exception $e) {
        $con->conn->rollback();
        header("Location: dashboard.php?status=remove_error&message=" . urlencode($e->getMessage()));
    }
} else {
    header("Location: dashboard.php");
}
?>
