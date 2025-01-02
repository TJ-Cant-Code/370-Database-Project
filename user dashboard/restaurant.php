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

// Function to get all restaurants
function getAllRestaurants($conn) {
    $sql = "SELECT name, address, profile_picture, description FROM restaurants";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Fetch all restaurants
$restaurants = getAllRestaurants($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurants</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Restaurants</h1>
        <?php foreach ($restaurants as $restaurant): ?>
            <div class="restaurant">
                <img src="<?php echo htmlspecialchars($restaurant['profile_picture']); ?>" alt="Restaurant Picture" class="restaurant-picture">
                <h2><?php echo htmlspecialchars($restaurant['name']); ?></h2>
                <p>Address: <?php echo htmlspecialchars($restaurant['address']); ?></p>
                <p><?php echo htmlspecialchars($restaurant['description']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
