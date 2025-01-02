<?php
session_start();
include 'db_connect.php'; // Include your database connection file

$email = $_POST['email'];
$password = md5($_POST['password']); // Encrypting for security

$query = "SELECT * FROM users WHERE email = ? AND password = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['role'] = $user['role'];

    // Redirect based on role
    switch ($user['role']) {
        case 'admin':
            header('Location: ../html/admin_dashboard.html');
            break;
        case 'restaurant_rep':
            header('Location: ../html/restaurant_dashboard.html');
            break;
        case 'end_user':
            header('Location: ../html/user_dashboard.html');
            break;
    }
} else {
    echo "Invalid email or password.";
}
?>
