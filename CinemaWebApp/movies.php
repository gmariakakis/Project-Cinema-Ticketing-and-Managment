
<?php
include("header.php");

$con = new conct();
$movie_id = $_GET['id'] ?? null; 

if ($movie_id) {
    
    $movie_query = "SELECT * FROM movies WHERE id = ?";
    $movie_stmt = $con->conn->prepare($movie_query);
    $movie_stmt->bind_param("i", $movie_id);
    $movie_stmt->execute();
    $movie_result = $movie_stmt->get_result();
    $movie = $movie_result->fetch_assoc();

    if ($movie) {
        ?>
        <div class='container mt-5'>
            <div class='row'>
                <div class='col-md-6'>
                    <img src='<?php echo $movie['image_url']; ?>' alt='<?php echo $movie['title']; ?>' class='img-fluid'>
                </div>
                <div class='col-md-6'>
                    <h2 class='mb-3'><?php echo $movie['title']; ?></h2>
                    <p><strong>Cast:</strong> <?php echo $movie['cast']; ?></p>
                    <p><strong>Description:</strong> <?php echo $movie['description']; ?></p>
                    
                  
                    <a href='booking.php?movie_id=<?php echo $movie_id; ?>' class='btn btn-primary'>Book Now</a>
                    
                </div>
            </div>
        </div>
        <?php
    } else {
        echo "<div class='container'><p>Movie not found.</p></div>";
    }
    $movie_stmt->close();
} else {
    echo "<div class='container'><p>No movie ID provided.</p></div>";
}

include("footer.php");
?>
