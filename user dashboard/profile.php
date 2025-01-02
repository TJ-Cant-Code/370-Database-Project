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

// Function to get user profile
function getUserProfile($conn, $userId) {
    $sql = "SELECT username, email, profile_picture, bio FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Assuming the logged-in user has user ID 1
$userId = 1;
$userProfile = getUserProfile($conn, $userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>My Profile</h1>
        <div class="profile">
            <img src="<?php echo htmlspecialchars($userProfile['profile_picture']); ?>" alt="Profile Picture" class="profile-picture">
            <h2><?php echo htmlspecialchars($userProfile['username']); ?></h2>
            <p>Email: <?php echo htmlspecialchars($userProfile['email']); ?></p>
            <p>Bio: <?php echo htmlspecialchars($userProfile['bio']); ?></p>
        </div>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>

