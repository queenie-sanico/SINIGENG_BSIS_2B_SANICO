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

    // Set the role to 'admin' for this sign-up
    $role = 'admin';

    // Prepare SQL query to insert data into admin_users table
    $sql = "INSERT INTO admin_users (firstname, lastname, email, contact, address, age, birthday, password, role) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters to the SQL query
        $stmt->bind_param("ssssissss", $first, $last, $email, $phone, $addr, $num, $date, $hashed_password, $role);
        
        // Execute and check
        if ($stmt->execute()) {
            // Redirect to login page after successful sign-up
            header("Location: adminhomepage.php");  // You can change this to wherever you'd like to redirect
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
