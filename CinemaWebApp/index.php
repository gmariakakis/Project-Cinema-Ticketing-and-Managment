<?php
include("header.php");


$con = new conct();
$result = $con->select_all('movies'); // Fetching data from the 'movies' table

$carouselData = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $carouselData[] = $row;
    }
}
?>





   <!-- Carousel -->
   <div id="demo" class="carousel slide" data-bs-ride="carousel" style="height:600px; background-color: rgba(0, 0, 0, 0.5);">
        <div class="carousel-indicators">
            <?php foreach ($carouselData as $index => $row): ?>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index == 0 ? 'active' : ''; ?>"></button>
            <?php endforeach; ?>
        </div>

        <div class="carousel-inner">
            <?php foreach ($carouselData as $index => $row): ?>
                <div class="carousel-item <?php echo $index == 0 ? 'active' : ''; ?>">
                    <img src="<?php echo $row["image_url"]; ?>" alt="<?php echo htmlspecialchars($row["title"]); ?>" class="d-block w-100" style="height:600px; object-fit: contain;">
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Left and right controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
<!--End of Carousel-->


<!-- Movie Cards Section -->

<div class="container my-4">
    <div class="row gy-4 justify-content-center">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php foreach ($result as $row): ?>
                <div class="col-md-2">
                    <a href="movies.php?id=<?php echo $row['id']; ?>" class="card-link">
                        <div class="card bg-dark text-white">
                            <img src="<?php echo $row['image_url']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['title']); ?>">
                            <div class="card-body bg-dark">
                                <h5 class="card-title text-white"><?php echo $row['title']; ?></h5>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No movies found.</p>
        <?php endif; ?>
    </div>
</div>

<?php include("footer.php") ?>
