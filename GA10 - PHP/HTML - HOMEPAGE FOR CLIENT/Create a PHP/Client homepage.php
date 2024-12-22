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

// Fetch items from the database
$sql = "SELECT * FROM items";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOMEPAGE</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="client.css">
</head>
<body>
    <!-- Header Section -->
    <div class="header text-center">
        <h1>DAZZLE OASIS</h1>
        <div class="underline"></div>
    </div>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Navigation Buttons -->
            <div class="nav-buttons">
                <a href="linking homepage.php" class="btn btn-custom">HOME</a>
                <a href="linking homepage.php#discover" class="btn btn-custom">WHAT'S NEW</a>
                <a href="linking homepage.php#gifts" class="btn btn-custom">GIFTS</a>
                <a href="client homepage.php" class="btn btn-custom">SHOP</a>
                <a href="linking homepage.php#about us" class="btn btn-custom">ABOUT US</a>
            </div>

            <!-- Search Bar -->
            <div class="search-bar d-flex">
             <form action="search.php" method="get" class="d-flex">
               <input type="text" name="search" placeholder="Search..." class="form-control" />
                <button type="submit" class="btn btn-outline-secondary">
                <i class="fas fa-search"></i>
               </button>
             </form>
            </div>

            <!-- Icons -->
            <div class="icons">
                <a href="orderpage.php" class="fas fa-user"></a>
                <a href="" class="fas fa-shopping-bag"></a>
            </div>
        </div>
    </nav>

    <!-- Catalog Section -->
    <div class="container my-5">
        <h2 class="title mb-4">OUR PRODUCTS</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            // Check if there are any items in the database
            if ($result->num_rows > 0) {
                // Loop through each item and display it
                while ($row = $result->fetch_assoc()) {
                    $item_id = $row['item_id'];
                    $name = $row['name'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_path = $row['image_path']; // Assuming 'image_path' is the column that stores the image filename
                    ?>

                    <!-- Product Card -->
                    <div class="col">
                        <div class="card h-100">
                            <img src="IMGVID/<?php echo htmlspecialchars($image_path); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($name); ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($name); ?></h5>
                                <p class="card-text">$<?php echo number_format($price, 2); ?></p>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#productModal<?php echo $item_id; ?>">View Details</button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Detail Modal -->
                    <div class="modal fade" id="productModal<?php echo $item_id; ?>" tabindex="-1" aria-labelledby="productModalLabel<?php echo $item_id; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="productModalLabel<?php echo $item_id; ?>"><?php echo htmlspecialchars($name); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="IMGVID/<?php echo htmlspecialchars($image_path); ?>" class="img-fluid mb-3" alt="<?php echo htmlspecialchars($name); ?>">
                                    <p><strong>Price:</strong> $<?php echo number_format($price, 2); ?></p>
                                    <p><?php echo htmlspecialchars($description); ?></p>
                                    <!-- Quantity input field -->
                                    <form action="addtocart.php" method="POST">
                                        <input type="hidden" name="item_id" value="<?php echo $item_id; ?>"> <!-- Product ID -->
                                        <div class="mb-3">
                                            <label for="quantity" class="form-label">Quantity</label>
                                            <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1">
                                        </div>
                                        <button type="submit" class="btn btn-outline-success btn-sm">
                                            <i class="fas fa-shopping-cart"></i> Add to Cart
                                        </button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                echo "<p>No products available.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="copyright py-4">
        <p>&copy; 2024 Dazzle Oasis. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
