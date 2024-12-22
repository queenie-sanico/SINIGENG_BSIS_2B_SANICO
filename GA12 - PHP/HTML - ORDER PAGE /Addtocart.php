<?php
session_start();
include('db connection.php');  // Ensure the database connection is established

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login form.php"); // Redirect to login form if not logged in
    exit;
}

$user_id = $_SESSION['user_id'];  // Get the user ID from the session

// Check if the item_id and quantity are passed for adding to the cart
if (isset($_POST['item_id']) && isset($_POST['quantity'])) {
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];

    // Fetch product details from the `items` table
    $query = "SELECT * FROM items WHERE item_id = '$item_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        $product_name = $product['name'];
        $price = $product['price'];
        $total_price = $price * $quantity;

        // Check if the product already exists in the user's cart
        $check_query = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$item_id'";
        $check_result = mysqli_query($conn, $check_query);

        if ($check_result && mysqli_num_rows($check_result) > 0) {
            // Update the quantity and total price if the product already exists in the cart
            $update_query = "UPDATE cart 
                             SET quantity = quantity + $quantity, 
                                 total_price = total_price + $total_price 
                             WHERE user_id = '$user_id' AND product_id = '$item_id'";
            mysqli_query($conn, $update_query);
        } else {
            // Insert the new product into the cart
            $insert_query = "INSERT INTO cart (user_id, product_id, product_name, quantity, total_price) 
                             VALUES ('$user_id', '$item_id', '$product_name', '$quantity', '$total_price')";
            mysqli_query($conn, $insert_query);
        }

        // Redirect to the shoppingbag.php after adding product to the cart
        header("Location: shoppingbag.php");
        exit;
    } else {
        echo "Product not found.";
    }
}

// Fetch the cart items for the logged-in user to display them in the shopping bag
$query = "SELECT * FROM cart WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

// Check for errors in the query execution
if (!$result) {
    die("Error fetching cart items: " . mysqli_error($conn));
}
?>
