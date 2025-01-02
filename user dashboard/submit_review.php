<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $review = $_POST['review'];
    $photos = $_FILES['photos'];

    // Handle the review and photo upload logic here
    // This example just displays the review text and photo names

    echo "<h1>Your Review</h1>";
    echo "<p>$review</p>";

    if ($photos['error'][0] == UPLOAD_ERR_NO_FILE) {
        echo "<p>No photos uploaded.</p>";
    } else {
        echo "<h2>Uploaded Photos</h2>";
        foreach ($photos['name'] as $photo) {
            echo "<p>$photo</p>";
        }
    }
}
?>
