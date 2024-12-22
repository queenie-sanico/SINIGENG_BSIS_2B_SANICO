<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = ""; // Replace with your DB password
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

$user_id = $_SESSION['user_id']; // Retrieve user ID dynamically

// Fetch cart items for the logged-in user
$sql_cart = "SELECT * FROM cart WHERE user_id = ?";
$stmt_cart = $conn->prepare($sql_cart);
$stmt_cart->bind_param("i", $user_id);
$stmt_cart->execute();
$result_cart = $stmt_cart->get_result();

// Insert cart items into the orders table (if cart is not empty)
if ($result_cart->num_rows > 0) {
    while ($row = $result_cart->fetch_assoc()) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $total_price = $row['total_price'];
        $order_status = 'pending'; // Default status
        $order_date = date('Y-m-d H:i:s'); // Current timestamp

        // Insert into orders table
        $sql_insert_order = "INSERT INTO orders (user_id, product_id, quantity, total_price, order_status, order_date)
                             VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_order = $conn->prepare($sql_insert_order);
        $stmt_order->bind_param("iiidss", $user_id, $product_id, $quantity, $total_price, $order_status, $order_date);

        if ($stmt_order->execute()) {
            // After insertion, delete the cart item (optional)
            $sql_delete_cart_item = "DELETE FROM cart WHERE cart_id = ?";
            $stmt_delete_cart = $conn->prepare($sql_delete_cart_item);
            $stmt_delete_cart->bind_param("i", $row['cart_id']);
            $stmt_delete_cart->execute();
        } else {
            echo "Error inserting order: " . $stmt_order->error;
        }
    }
}

// Fetch orders for the logged-in user
$sql_orders = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";
$stmt_orders = $conn->prepare($sql_orders);
$stmt_orders->bind_param("i", $user_id);
$stmt_orders->execute();
$result_orders = $stmt_orders->get_result();

$orders = [];
if ($result_orders->num_rows > 0) {
    while ($row = $result_orders->fetch_assoc()) {
        $orders[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="orderpage.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- Content Area -->
    <div class="content">
        <h2>Welcome, User</h2>

        <!-- Orders Section -->
        <div id="orders" class="mt-5">
            <h1>Orders</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)) : ?>
                        <?php foreach ($orders as $index => $order) : ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td>#<?php echo htmlspecialchars($order['order_id']); ?></td>
                                <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                                <td>
                                    <span class="badge 
                                        <?php 
                                        echo match ($order['order_status']) {
                                            'pending' => 'bg-warning',
                                            'processed' => 'bg-primary',
                                            'shipped' => 'bg-info',
                                            'delivered' => 'bg-success',
                                            'cancelled' => 'bg-danger',
                                            default => 'bg-secondary',
                                        };
                                        ?>">
                                        <?php echo ucfirst(htmlspecialchars($order['order_status'])); ?>
                                    </span>
                                </td>
                                <td>$<?php echo number_format($order['total_price'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="empty-row">No orders found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Exit Button -->
        <div class="text-center mt-4">
            <a href="client homepage.php" class="btn btn-danger">Exit to Homepage</a>
        </div>
    </div>
</body>

</html>
