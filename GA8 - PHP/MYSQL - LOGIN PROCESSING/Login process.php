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
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$email = $_POST['email'];
$password = $_POST['password'];
// Correct query to fetch user details
$sql = "SELECT user_id, password FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
$stmt->bind_param("s", $email); // Bind the email
$stmt->execute();
$stmt->store_result();
// Check if user exists
if ($stmt->num_rows > 0) {
$stmt->bind_result($user_id, $hashed_password);
$stmt->fetch();
// Verify password
if (password_verify($password, $hashed_password)) {
session_start();
$_SESSION['user_id'] = $user_id; // Store user ID in session
echo "Login successful! Redirecting...";
header("Location: client homepage.php");
exit;
} else {
echo "Invalid password.";
}
} else {
echo "No user found with this email.";
}
$stmt->close();
} else {
echo "Error: " . $conn->error;
}
}
$conn->close();
?>
