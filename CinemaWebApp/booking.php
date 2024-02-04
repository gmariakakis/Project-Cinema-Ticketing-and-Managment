<?php

include("header.php");


if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit;
}

$con = new conct();
$selected_movie_id = $_GET['movie_id'] ?? null;
$selected_date = $_GET['date'] ?? null;
$selected_show_id = $_GET['show_id'] ?? null;
$tickets_selected = $_GET['tickets'] ?? 1;


$movie = null;
if ($selected_movie_id) {
    $movie_query = $con->select('movies', $selected_movie_id);
    $movie = $movie_query->fetch_assoc();
}
?>
<style>.seating-layout {
    display: grid;
    grid-template-columns: repeat(10, 1fr);
    grid-template-rows: repeat(5, 1fr); 
    gap: 5px;
    max-width: 500px; 
    margin: auto;
}

.seat {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 30px; 
    height: 30px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: #fff;
}

.seat input[type="checkbox"] {
    display: none; 
}

.seat.available {
    background-color: #fff; 
}

.seat.reserved {
    background-color: #f00;
    pointer-events: none; 
    opacity: 0.5; 
}

.seat.chosen {
    background-color: #0f0;
}

.btn-selected {
    background-color: #007bff; 
    color: white;
}

.btn-unselected {
    background-color: #f8f9fa; 
    color: black;
}
.container{
    padding-top: 40px;


</style>

<div class="container mt-4">
<?php if ($selected_movie_id && $movie): ?>
     <!-- Display movie details if a movie is selected -->
        <h2 style="padding-top: 30px;"><?php echo htmlspecialchars($movie['title']); ?></h2>
        <?php if (!empty($movie['image_url'])): ?>
        <!-- Display movie image if available -->
            <img src="<?php echo htmlspecialchars($movie['image_url']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>" style="max-height: 100px; max-width: 100px;" class="img-fluid">
        <?php endif; ?>
        <p><?php echo htmlspecialchars($movie['description']); ?></p>
    <?php endif; ?>
    <h2>Book Your Tickets</h2>

    <!-- Form for selecting a movie -->
    <form action="booking.php" method="get">
        <div class="form-group">
            <label for="movie_id">Choose a Movie:</label>
            <select name="movie_id" id="movie_id" class="form-select" onchange="this.form.submit()">
                <option value="">Select a Movie</option>
                 <!-- PHP code to populate movie options from the database -->
                <?php
                $movies_query = "SELECT id, title FROM movies";
                $movies_result = $con->conn->query($movies_query);
                while ($movie = $movies_result->fetch_assoc()) {
                    echo "<option value='" . $movie['id'] . "' " . ($movie['id'] == $selected_movie_id ? "selected" : "") . ">" . htmlspecialchars($movie['title']) . "</option>";
                }
                ?>
            </select>
        </div>
    </form>

    <?php if ($selected_movie_id): ?>
        <!-- Show Date Selection -->
        <h3>Choose Show Date</h3>
        <?php
        // Fetch show dates with available seats for the selected movie
       $show_dates_query = "SELECT DISTINCT show_date FROM shows WHERE movie_id = ?";
$stmt = $con->conn->prepare($show_dates_query);
$stmt->bind_param("i", $selected_movie_id);
$stmt->execute();
$show_dates_result = $stmt->get_result();

while ($row = $show_dates_result->fetch_assoc()) {
    $date_style = ($row['show_date'] == $selected_date) ? 'background-color: #007bff; color: white;' : 'background-color: #f8f9fa; color: black;';
    echo "<a href='booking.php?movie_id=" . $selected_movie_id . "&date=" . $row['show_date'] . "' class='btn' style='" . $date_style . "'>" . $row['show_date'] . "</a> ";
}
        ?>

        <?php if ($selected_date): ?>
            <!-- Show Time and Room Selection -->
            <h3>Available Showtimes</h3>
            <?php
             $showtimes_query = "SELECT shows.id, showtimes.show_time, rooms.name, rooms.type 
             FROM shows 
             JOIN showtimes ON shows.show_time_id = showtimes.id 
             JOIN rooms ON shows.room_id = rooms.id 
             WHERE shows.movie_id = ? AND shows.show_date = ?";

            $showtimes_stmt = $con->conn->prepare($showtimes_query);
            $showtimes_stmt->bind_param("is", $selected_movie_id, $selected_date);
            $showtimes_stmt->execute();
            $showtimes_result = $showtimes_stmt->get_result();

          while ($showtime = $showtimes_result->fetch_assoc()) {
    $showtime_style = ($showtime['id'] == $selected_show_id) ? 'background-color: #007bff; color: white;' : 'background-color: #f8f9fa; color: black;';
    echo "<a href='booking.php?movie_id=" . $selected_movie_id . "&date=" . $selected_date . "&show_id=" . $showtime['id'] . "' class='btn' style='" . $showtime_style . "'>" . $showtime['show_time'] . " - " . $showtime['name'] . " (" . $showtime['type'] . ")</a> ";
}
            ?>

   <?php if ($selected_show_id): ?>
    <!-- Seat Selection Layout -->
 
    <?php
    // Fetch seat information for the selected show
    
     $seats_query = "SELECT s.seat_id, s.seat_number, 
                           (CASE 
                                WHEN rs.reservation_id IS NOT NULL THEN 'reserved' 
                                ELSE 'available' 
                            END) as status
                    FROM seats s
                    LEFT JOIN reservation_seats rs ON s.seat_id = rs.seat_id
                    LEFT JOIN reservations r ON rs.reservation_id = r.reservation_id AND r.show_id = ?
                    WHERE s.room_id = (SELECT room_id FROM shows WHERE id = ?)";
    $seats_stmt = $con->conn->prepare($seats_query);
    $seats_stmt->bind_param("ii", $selected_show_id, $selected_show_id);
    $seats_stmt->execute();
    $result = $seats_stmt->get_result();

    $seats = [];
    while ($row = $result->fetch_assoc()) {
        $seats[$row['seat_number']] = $row;
    }
    ?>

    <h3>Select Your Seats</h3>
    <form id="seatSelectionForm" action="process_booking.php" method="post">
        <input type="hidden" name="show_id" value="<?php echo $selected_show_id; ?>">
        <div class="seating-layout">
            <?php foreach ($seats as $seat): ?>
                <label class="seat <?php echo $seat['status']; ?>">
                    <input type="checkbox" 
                           name="selected_seats[]" 
                           value="<?php echo $seat['seat_id']; ?>"
                           <?php echo $seat['status'] != 'available' ? 'disabled' : ''; ?>
                           onclick="toggleSeat(this);">
                    <span class="seat-label"><?php echo $seat['seat_number']; ?></span>
                </label>
            <?php endforeach; ?>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Book Selected Seats</button>
    </form>
    <script>
        //js fuction for the checkboxes
        function toggleSeat(checkbox) {
            var label = checkbox.closest('.seat');
            if (checkbox.checked) {
                label.classList.add('chosen');
            } else {
                label.classList.remove('chosen');
            }
        }
    </script>
<?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include("footer.php"); ?>
