<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "dazzleoasis";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the search query is set
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];

    // Start the session to store search query
    session_start();
    $_SESSION['search_query'] = $search_query;

    // Redirect to the homepage to display search results
    header("Location: searchresult.php");
    exit();
}

// Close the database connection
$conn->close();
?>
