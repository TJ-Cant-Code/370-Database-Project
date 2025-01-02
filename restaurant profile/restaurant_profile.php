<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get restaurant profile
function getRestaurantProfile($conn, $restaurantId) {
    $sql = "SELECT name, menu_photo, description FROM restaurants WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $restaurantId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Function to get restaurant reviews
function getRestaurantReviews($conn, $restaurantId) {
    $sql = "SELECT review, rating FROM reviews WHERE restaurant_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $restaurantId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Assuming you want to view the profile of the restaurant with ID 1
$restaurantId = 1;
$restaurantProfile = getRestaurantProfile($conn, $restaurantId);
$restaurantReviews = getRestaurantReviews($conn, $restaurantId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($restaurantProfile['name']); ?> - Profile</title>
    <link rel="stylesheet" href="stylesss.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($restaurantProfile['name']); ?></h1>
        <img src="<?php echo htmlspecialchars($restaurantProfile['menu_photo']); ?>" alt="Menu Photo" class="menu-photo">
        <p><?php echo htmlspecialchars($restaurantProfile['description']); ?></p>

        <h2>Reviews</h2>
        <?php if (empty($restaurantReviews)): ?>
            <p>No reviews available.</p>
        <?php else: ?>
            <?php foreach ($restaurantReviews as $review): ?>
                <div class="review">
                    <p><?php echo htmlspecialchars($review['review']); ?></p>
                    <p>Rating: <?php echo htmlspecialchars($review['rating']); ?>/5</p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
