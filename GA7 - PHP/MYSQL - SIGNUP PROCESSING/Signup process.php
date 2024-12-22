<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "dazzleoasis";
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
// Get form data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$first = $_POST['firstname'];
$last = $_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['contact'];
$addr = $_POST['address'];
$pass = $_POST['password'];
$num = $_POST['age'];
$date = $_POST['birthday'];
// Hash the password
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
// Prepare SQL query
$sql = "INSERT INTO users (firstname, lastname, contact, email, address, age, birthday, password) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt) {
// Correct the type string to match the 8 variables
$stmt->bind_param("ssssisss", $first, $last, $phone, $email, $addr, $num, $date, 
$hashed_password);
// Execute and check
if ($stmt->execute()) {
header("Location: client homepage.php");
} else {
echo "Error: " . $stmt->error;
}
$stmt->close();
} else {
echo "Error: " . $conn->error;
}
}
$conn->close();
?>
