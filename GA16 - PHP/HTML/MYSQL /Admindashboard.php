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

// Check if the admin is logged in and if the role is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: loginadmin.php"); // Redirect to login if not admin
    exit();
}

// Fetch all orders with user details
$sql_orders = "SELECT o.order_id, o.user_id, o.product_id, o.quantity, o.total_price, o.order_status, o.order_date, 
                      u.firstname, u.lastname, u.email
               FROM orders o
               INNER JOIN users u ON o.user_id = u.user_id
               ORDER BY o.order_date DESC";
$result_orders = $conn->query($sql_orders);

$orders = [];
if ($result_orders->num_rows > 0) {
    while ($row = $result_orders->fetch_assoc()) {
        $orders[] = $row;
    }
}

// Fetch sales analytics
$sql_sales = "SELECT 
                    SUM(total_price) AS total_sales, 
                    COUNT(DISTINCT user_id) AS total_clients
             FROM orders";
$result_sales = $conn->query($sql_sales);
$sales = $result_sales->fetch_assoc();

// Calculate average order value
$average_order_value = $sales['total_clients'] > 0 ? $sales['total_sales'] / $sales['total_clients'] : 0;

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admindash.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <!-- Admin Dashboard Title -->
        <div class="header text-center">
            <h1>Admin Dashboard</h1>
            <div class="underline"></div>
        </div>

        <!-- Sales Analytics Section -->
        <div id="sales-analytics" class="mt-5">
            <h2>Sales Analytics</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Total Sales</th>
                        <th>Total Clients</th>
                        <th>Average Order Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>$<?php echo number_format($sales['total_sales'], 2); ?></td>
                        <td><?php echo number_format($sales['total_clients']); ?></td>
                        <td>$<?php echo number_format($average_order_value, 2); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Client Orders Section -->
        <div id="orders" class="mt-5">
            <h2>Client Orders</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Username</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)) : ?>
                        <?php foreach ($orders as $index => $order) : ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td>#<?php echo htmlspecialchars($order['order_id']); ?></td>
                                <td><?php echo htmlspecialchars($order['firstname']) . ' ' . htmlspecialchars($order['lastname']); ?></td>
                                <td><?php echo htmlspecialchars($order['product_id']); // Fetch product name if available ?></td>
                                <td><?php echo htmlspecialchars($order['quantity']); ?></td>
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
                                <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                                <td>$<?php echo number_format($order['total_price'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="8" class="empty-row">No orders found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Exit Button Section -->
        <div class="text-center mt-4">
            <a href="homepage.php" class="btn btn-danger">Exit to Homepage</a>
        </div>
    </div>
</body>

</html>
