<?php 
include("header.php");

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit;
}
$con = new conct();
// Fetch movies
$movies = $con->select_all("movies");

// Fetch rooms
$rooms = $con->select_all("rooms");

// Fetch showtimes
$showtimes = $con->select_all("showtimes");
?>

<div class="container mt-4">
    <h1>Welcome to the Cinema Dashboard</h1>

   <h2>Manage Reservations</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Unique Number</th>
                <th>Username</th>
                <th>Movie Title</th>
                <th>Show Date & Time</th>
                <th>Room</th>
                <th>Seat Numbers</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $query = "SELECT r.ticket_unique_number, u.username, m.title, sh.show_date, st.show_time, ro.name AS room_name, GROUP_CONCAT(se.seat_number ORDER BY se.seat_number) as seat_numbers, r.status, r.reservation_id
                      FROM reservations r
                      JOIN users u ON r.user_id = u.id
                      JOIN shows sh ON r.show_id = sh.id
                      JOIN movies m ON sh.movie_id = m.id
                      JOIN showtimes st ON sh.show_time_id = st.id
                      JOIN rooms ro ON sh.room_id = ro.id
                      JOIN reservation_seats rs ON r.reservation_id = rs.reservation_id
                      JOIN seats se ON rs.seat_id = se.seat_id
                      GROUP BY r.reservation_id";
            $result = $con->conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["ticket_unique_number"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["show_date"]) . " " . htmlspecialchars($row["show_time"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["room_name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["seat_numbers"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["status"]) . "</td>";

                    // Action buttons for Accept/Deny/Delete
                    echo "<td>";
                    if ($row["status"] !== 'Confirmed') {
                        // Accept/Deny buttons
                        echo "<form action='update_reservations.php' method='post' style='display: inline;'>
                                <input type='hidden' name='reservation_id' value='" . htmlspecialchars($row["reservation_id"]) . "'>
                                <input type='hidden' name='action' value='accept'>
                                <button type='submit' class='btn btn-success'>Accept</button>
                              </form>
                              <form action='update_reservations.php' method='post' style='display: inline;'>
                                <input type='hidden' name='reservation_id' value='" . htmlspecialchars($row["reservation_id"]) . "'>
                                <input type='hidden' name='action' value='deny'>
                                <button type='submit' class='btn btn-danger'>Deny</button>
                              </form>";
                    } else {
                        // Delete button for confirmed reservations
                        echo "<form action='delete_reservation.php' method='post' style='display: inline;'>
                                <input type='hidden' name='reservation_id' value='" . htmlspecialchars($row["reservation_id"]) . "'>
                                <button type='submit' class='btn btn-danger'>Delete</button>
                              </form>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No reservations found</td></tr>";
            }
            ?>
        </tbody>
    </table>
   

      <!-- Movie Management -->
<h2>Manage Movies</h2>
<table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Cast</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM movies";
        $result = $con->conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><img src='" . htmlspecialchars($row["image_url"]) . "' alt='Movie Image' style='width: 100px;'></td>";
                echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["cast"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                echo "<td>
                      <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editMovieModal" . $row["id"] . "'>Edit</button>
                         <form action='remove_movie_process.php' method='post' style='display: inline;'>
                             <input type='hidden' name='id' value='" . $row["id"] . "'>
                             <button type='submit' class='btn btn-danger'>Remove</button>
                         </form>
                     </td>";
                echo "</tr>";

                // Modal for editing movie
                echo "<div class='modal fade' id='editMovieModal" . $row["id"] . "' tabindex='-1' role='dialog' aria-labelledby='editMovieModalLabel' aria-hidden='true'>
                         <div class='modal-dialog' role='document'>
                             <div class='modal-content'>
                                 <div class='modal-header'>
                                     <h5 class='modal-title' id='editMovieModalLabel'>Edit Movie</h5>
                                     <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                         <span aria-hidden='true'>&times;</span>
                                     </button>
                                 </div>
                                 <div class='modal-body'>
                                     <form action='edit_movie_process.php' method='post'>
                                         <input type='hidden' name='id' value='" . $row["id"] . "'>
                                         <div class='form-group'>
                                             <label>Title</label>
                                             <input type='text' class='form-control' name='title' value='" . htmlspecialchars($row["title"]) . "' required>
                                         
                                          </div>
                                         <div class='form-group'>
                                             <label>Description</label>
                                             <textarea class='form-control' name='description'>" . htmlspecialchars($row["description"]) . "</textarea>
                                         </div>
                                         <div class='form-group'>
                                             <label>Image URL</label>
                                             <input type='text' class='form-control' name='image_url' value='" . htmlspecialchars($row["image_url"]) . "'>
                                         </div>
                                         <div class='form-group'>
                                             <label>Cast</label>
                                             <textarea class='form-control' name='cast'>" . htmlspecialchars($row["cast"]) . "</textarea>
                                         </div>
                                         <button type='submit' class='btn btn-primary'>Save changes</button>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>";
            }
        } else {
            echo "<tr><td colspan='5'>No movies found</td></tr>";
        }
        ?>
    </tbody>
</table>
<!-- Add New Movie Form -->
<form action="add_movie_process.php" method="post">
    <input type="text" name="title" placeholder="Title" required>
    <input type="text" name="description" placeholder="Description">
    <input type="text" name="image_url" placeholder="Image URL">
    <input type="text" name="cast" placeholder="Cast">
    <button type="submit" class="btn btn-success">Add New Movie</button>
</form>
<!--Create Shows Form -->
<h2>Create a Show</h2>
<form action="process_create_show.php" method="post">
    <div class="form-group">
        <label for="movie">Movie:</label>
        <select name="movie_id" id="movie" class="form-control">
            <?php while($movie = $movies->fetch_assoc()): ?>
                <option value="<?= $movie['id'] ?>"><?= htmlspecialchars($movie['title']) ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="room">Room:</label>
        <select name="room_id" id="room" class="form-control">
            <?php while($room = $rooms->fetch_assoc()): ?>
                <option value="<?= $room['id'] ?>"><?= htmlspecialchars($room['name']) ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
    <label for="show_date">Show Date:</label>
    <input type="date" class="form-control" name="show_date" id="show_date" required>
</div>


    <div class="form-group">
        <label for="show_time">Show Time:</label>
        <select name="show_time_id" id="show_time" class="form-control">
            <?php while($showtime = $showtimes->fetch_assoc()): ?>
                <option value="<?= $showtime['id'] ?>"><?= htmlspecialchars($showtime['show_time']) ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Create Show</button>
</form>
<!-- Movie Selection for Show Management -->
<h2>Manage Shows</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="form-group">
        <label for="selected_movie">Select Movie:</label>
        <select name="selected_movie" id="selected_movie" class="form-control" onchange="this.form.submit()">
            <option value="">Select a movie</option>
            <?php
            $movies_result = $con->select_all("movies");
            while ($movie = $movies_result->fetch_assoc()) {
                $selected = (isset($_POST['selected_movie']) && $_POST['selected_movie'] == $movie['id']) ? 'selected' : '';
                echo "<option value='" . $movie['id'] . "' $selected>" . htmlspecialchars($movie['title']) . "</option>";
            }
            ?>
        </select>
    </div>
</form>

<?php
if (isset($_POST['selected_movie'])) {
    $selected_movie = $_POST['selected_movie'];

    // Fetch shows for the selected movie
    $query = "SELECT shows.id, shows.movie_id, shows.show_date, shows.show_time_id, shows.room_id, showtimes.show_time, rooms.name 
          FROM shows 
          JOIN showtimes ON shows.show_time_id = showtimes.id 
          JOIN rooms ON shows.room_id = rooms.id 
          WHERE shows.movie_id = '$selected_movie'";

    $result = $con->conn->query($query);

    if ($result->num_rows > 0) {
        echo "<table class='table'>";
        echo "<thead><tr><th>Date</th><th>Time</th><th>Room</th><th>Action</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['show_date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['show_time']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>
                  <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editShowModal" . $row['id'] . "'>Edit</button>
                  <form action='remove_show.php' method='post' style='display: inline;'>
                      <input type='hidden' name='id' value='" . $row['id'] . "'>
                      <button type='submit' class='btn btn-danger'>Remove</button>
                  </form>
                  </td>";
            echo "</tr>";

            // Modal for editing show with pre-populated data
             echo "<div class='modal fade' id='editShowModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='editShowModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='editShowModalLabel'>Edit Show</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <form action='edit_show_process.php' method='post'>
                          <input type='hidden' name='id' value='" . $row['id'] . "'>
    <input type='hidden' name='movie_id' value='" . $row['movie_id'] . "'>
                            <div class='form-group'>
                                <label for='show_date'>Show Date:</label>
                                <input type='date' class='form-control' name='show_date' value='" . $row['show_date'] . "' required>
                            </div>
                            <div class='form-group'>
                                <label for='show_time'>Show Time:</label>
                                <select name='show_time_id' class='form-control'>";
    foreach ($showtimes as $showtime) {
        $selected = ($showtime['id'] == $row['show_time_id']) ? 'selected' : '';
        echo "<option value='" . $showtime['id'] . "' $selected>" . htmlspecialchars($showtime['show_time']) . "</option>";
    }
    echo "</select>
            </div>
            <div class='form-group'>
                <label for='room'>Room:</label>
                <select name='room_id' class='form-control'>";
    foreach ($rooms as $room) {
        $selected = ($room['id'] == $row['room_id']) ? 'selected' : '';
        echo "<option value='" . $room['id'] . "' $selected>" . htmlspecialchars($room['name']) . "</option>";
    }
    echo "</select>
            </div>
            <button type='submit' class='btn btn-primary'>Save changes</button>
        </form>
    </div>
</div>
</div>";
}
        echo "</tbody></table>";
    } else {
        echo "<p>No shows found for the selected movie.</p>";
    }
}
?>
    <!-- Contact Messages Section -->
<h2>Contact Messages</h2>
<table class="table">
    <thead>
        <tr>
            <th>Email</th>
            <th>Phone</th>
            <th>Message</th>
            <th>Submitted At</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT email, phone, message, submitted_at FROM contact_messages";
        $result = $con->conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["message"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["submitted_at"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No contact messages found</td></tr>";
        }
        ?>
    </tbody>
</table>
</div>

<?php
include("footer.php");
?>