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

// Get the item_id from the URL
if (isset($_GET['id'])) {
    $item_id = $_GET['id'];

    // Prepare SQL query to fetch the product details
    $sql = "SELECT * FROM items WHERE item_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $item_id);

    // Execute the query and fetch the result
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<div class='product-details'>";
        echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
        echo "<p><strong>Price:</strong> $" . number_format($row['price'], 2) . "</p>";
        echo "<p><strong>Quantity:</strong> " . $row['quantity'] . " available</p>";
        // Optionally, you can add an "Add to Cart" button or other actions here
        echo "</div>";
    } else {
        echo "Product not found.";
    }

    // Close the prepared statement
    $stmt->close();
} else {
    echo "Invalid product.";
}

// Close the database connection
$conn->close();
?>
