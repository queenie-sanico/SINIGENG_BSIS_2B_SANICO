<?php
session_start();

// Database connection setup
$servername = "localhost";
$username = "root";  // Update with your database username
$password = "";      // Update with your database password
$dbname = "dazzleoasis";  // Your database name

// Create connection (with error suppression)
$conn = @mysqli_connect($servername, $username, $password, $dbname);

// Check connection and stop script if connection fails
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login form.php"); // Redirect to login form if not logged in
    exit;
}

$user_id = $_SESSION['user_id'];  // Get the user ID from the session

// Fetch the cart items for the logged-in user
$query = "SELECT * FROM cart WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

// Check for errors in the query execution
if (!$result) {
    die("Error fetching cart items: " . mysqli_error($conn));
}

// Initialize total price
$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Bag</title>
    <link rel="stylesheet" href="shoppingbag.css">  <!-- Assuming you have styles.css for layout -->
</head>
<body>
    <!-- Shopping Bag Section -->
    <div class="catalog-title">
        <h2>Your Shopping Bag</h2>
    </div>

    <div class="shopping-bag">
        <ul>
            <?php
            // Check if there are any items in the cart
            if (mysqli_num_rows($result) > 0) {
                // Loop through each cart item and display its details
                while ($row = mysqli_fetch_assoc($result)) {
                    $product_name = $row['product_name'];
                    $quantity = $row['quantity'];
                    $total_item_price = $row['total_price'];
                    $total_price += $total_item_price; // Add item price to the total

                    // Display product details in the list
                    echo "<li><strong>$product_name</strong> - Quantity: $quantity - Price: $$total_item_price</li>";
                }
            } else {
                echo "<li>Your shopping bag is empty!</li>";
            }
            ?>
        </ul>

        <!-- Display Total Price -->
        <div class="total-price">
            <p><strong>Total Price: $<?php echo number_format($total_price, 2); ?></strong></p>
        </div>

        <!-- Place Order Button -->
        <button class="btn-custom" onclick="window.location.href='orderpage.php'">Place Order</button>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="copyright">
            &copy; 2024 Your Company. All rights reserved.
        </div>
    </div>
</body>
</html>

<?php
// Close the database connection after use
mysqli_close($conn);
?>
