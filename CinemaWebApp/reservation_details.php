<?php
session_start();
include("connection.php");
$con = new conct(); 
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['reservation_id'])) {
    exit("Invalid request");
}

$reservation_id = $_GET['reservation_id'];

// Fetch reservation details
$query = "SELECT r.user_id, r.show_id, r.room_id, r.number_of_tickets, r.ticket_unique_number, r.total_amount, 
                 m.title as movie_title, st.show_time, 
                 GROUP_CONCAT(s.seat_number ORDER BY s.seat_number ASC) as selected_seats
          FROM reservations r
          JOIN shows sh ON r.show_id = sh.id
          JOIN movies m ON sh.movie_id = m.id
          JOIN showtimes st ON sh.show_time_id = st.id
          JOIN reservation_seats rs ON r.reservation_id = rs.reservation_id
          JOIN seats s ON rs.seat_id = s.seat_id
          WHERE r.reservation_id = ?
          GROUP BY r.reservation_id";

$stmt = $con->conn->prepare($query);
$stmt->bind_param("i", $reservation_id);
$stmt->execute();
$result = $stmt->get_result();
$reservation = $result->fetch_assoc();

if (!$reservation) {
    exit("Reservation not found");
}

$username = $_SESSION['username'] ?? 'Guest'; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reservation Details</title>
    
    <style>
        body {
            background: url('images/backround.png')no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
        }

        .container {
            padding: 5%;
            box-shadow: 0px 5px 10px 0px #00000033;
            background: rgba(255, 255, 255, 0.8); 
            margin: 5% auto;
            max-width: 600px;
        }

        .btn-blue {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Congratulations, <?php echo htmlspecialchars($username); ?>! 🎉 Your booking was successful!</h1>
    <p>Movie Title: <?php echo htmlspecialchars($reservation['movie_title']); ?></p>
    <p>Show Time: <?php echo htmlspecialchars($reservation['show_time']); ?></p>
    <p>Selected Seats: <?php echo htmlspecialchars($reservation['selected_seats']); ?></p>
    <p>Total Amount: $<?php echo htmlspecialchars($reservation['total_amount']); ?></p>
    <p>Reservation ID: <?php echo htmlspecialchars($reservation['ticket_unique_number']); ?></p>
    <a href="index.php" class="btn-blue">Return to Home</a>
</div>
</body>
</html>
