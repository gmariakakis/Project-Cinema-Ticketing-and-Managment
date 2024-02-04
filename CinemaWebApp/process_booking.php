<?php
session_start();
include("connection.php");

if (empty($_SESSION['user_id']) || empty($_POST['show_id']) || empty($_POST['selected_seats'])) {
    exit("Invalid request");
}

function generateUniqueTicketNumber() {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $ticketNumber = '';

    for ($i = 0; $i < 10; $i++) {
        $randomIndex = rand(0, strlen($characters) - 1);
        $ticketNumber .= $characters[$randomIndex];
    }

    return $ticketNumber;
}

$con = new conct();
$show_id = $_POST['show_id'];
$selected_seats = $_POST['selected_seats'];
$number_of_tickets = count($selected_seats);
$ticket_unique_number = generateUniqueTicketNumber();

// Start transaction
$con->conn->begin_transaction();

try {
    // Fetch room type and room_id
    $roomQuery = "SELECT room_id, type FROM rooms JOIN shows ON rooms.id = shows.room_id WHERE shows.id = ?";
    $roomStmt = $con->conn->prepare($roomQuery);
    $roomStmt->bind_param("i", $show_id);
    $roomStmt->execute();
    $roomResult = $roomStmt->get_result();
    $roomData = $roomResult->fetch_assoc();

    if (!$roomData) {
        throw new Exception("Room not found");
    }

    // Pricing based on room type
    $pricePerTicket = 0;
    switch ($roomData['type']) {
        case 'IMAX':
            $pricePerTicket = 5;
            break;
        case 'Regular':
            $pricePerTicket = 2;
            break;
        case '3D':
            $pricePerTicket = 4;
            break;
        default:
            throw new Exception("Unknown room type");
    }

    $total_amount = $pricePerTicket * $number_of_tickets;
    $user_id = $_SESSION['user_id'];

    // Insert reservation
    $reservationQuery = "INSERT INTO reservations (user_id, show_id, room_id, number_of_tickets, ticket_unique_number, total_amount, status) VALUES (?, ?, ?, ?, ?, ?, 'Pending')";
    $reservationStmt = $con->conn->prepare($reservationQuery);
    $reservationStmt->bind_param("iiiisi", $user_id, $show_id, $roomData['room_id'], $number_of_tickets, $ticket_unique_number, $total_amount);
    $reservationStmt->execute();
    $reservation_id = $con->conn->insert_id;

    foreach ($selected_seats as $seat_id) {
        $insertQuery = "INSERT INTO reservation_seats (reservation_id, seat_id) VALUES (?, ?)";
        $insertStmt = $con->conn->prepare($insertQuery);
        $insertStmt->bind_param("ii", $reservation_id, $seat_id);
        $insertStmt->execute();
    }

    $con->conn->commit();
    header("Location: reservation_details.php?reservation_id=" . $reservation_id); // Redirect to reservation details page
    exit;
} catch (Exception $e) {
    $con->conn->rollback();
    echo "Error during booking: " . $e->getMessage();
}

$con->conn->close();
?>