<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dazzleoasis";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all orders for all users
$sql = "SELECT order_id, user_id, product_id, quantity, total_price, order_status, order_date 
        FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);

$orders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

$conn->close();
?>
