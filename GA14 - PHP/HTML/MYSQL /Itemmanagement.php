<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'dazzleoasis');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Admin login handling
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE email = ? AND role = 'admin'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['user_id'] = $user['user_id'];
        } else {
            $login_error = "Invalid email or password.";
        }
    } else {
        $login_error = "Invalid email or password.";
    }
}

// Logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}

// Handle new item addition
if (isset($_POST['add_item'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $image_path = $_POST['image_path'];

    $stmt = $conn->prepare("INSERT INTO items (name, description, price, quantity, category, image_path) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdiss", $name, $description, $price, $quantity, $category, $image_path);
    if ($stmt->execute()) {
        $item_added = "Item added successfully!";
    } else {
        $item_added = "Error adding item.";
    }
}

// If the admin is not logged in, show the login form
if (!isset($_SESSION['admin_logged_in'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
   
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (isset($login_error)) { echo "<p>$login_error</p>"; } ?>
        <form method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
<?php
    exit;
}

// If logged in, show the item management dashboard
if (isset($_SESSION['admin_logged_in'])) {
    $result = $conn->query("SELECT * FROM items");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Item Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="header">
        <h1>Item Management</h1>
        <div class="underline"></div>
    </div>

    <div class="navbar">
        <div class="nav-buttons">
            <a href="?logout=true">Logout</a>
            <a href="#add-item-form">Add New Item</a>
        </div>
    </div>

    <div class="catalog-title">
        <h2>Items List</h2>
    </div>

    <div class="items-list">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="item-card">
                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <p>Price: $<?php echo $row['price']; ?></p>
                <p>Quantity: <?php echo $row['quantity']; ?></p>
                <p>Category: <?php echo $row['category']; ?></p>
            </div>
        <?php } ?>
    </div>

    <!-- Add New Item Form -->
    <div id="add-item-form">
        <h2>Add New Item</h2>
        <form method="POST">
            <label for="name">Item Name:</label>
            <input type="text" name="name" required>
            <label for="description">Description:</label>
            <textarea name="description" required></textarea>
            <label for="price">Price:</label>
            <input type="number" step="0.01" name="price" required>
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" required>
            <label for="category">Category:</label>
            <input type="text" name="category">
            <label for="image_path">Image Path:</label>
            <input type="text" name="image_path">
            <button type="submit" name="add_item">Add Item</button>
        </form>

        <?php if (isset($item_added)) { echo "<p>$item_added</p>"; } ?>
    </div>

</body>
</html>
<?php
}
?>
