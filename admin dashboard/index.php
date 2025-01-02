<?php
// Start the session
session_start();

// Include necessary files and database connection
include('db_connection.php'); // Your database connection file

// Initialize variables
$totalAdmins = 0;
$totalRestaurants = 0;
$totalPosts = 0;
$totalRequests = 0;

// Fetch data from the database
$query = "SELECT COUNT(*) as count FROM admins";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalAdmins = $row['count'];

$query = "SELECT COUNT(*) as count FROM restaurants";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalRestaurants = $row['count'];

$query = "SELECT COUNT(*) as count FROM posts";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalPosts = $row['count'];

$query = "SELECT COUNT(*) as count FROM requests";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalRequests = $row['count'];
?>
