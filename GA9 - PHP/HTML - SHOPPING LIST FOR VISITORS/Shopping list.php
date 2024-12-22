<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping List</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assuming the CSS is saved in styles.css -->
</head>
<body>

    <div class="header">
        <h1>Shopping List</h1>
        <div class="underline"></div>
    </div>

    <div class="navbar">
        <div class="nav-buttons">
            <a href="#">Home</a>
            <a href="#">Categories</a>
            <a href="#">Contact</a>
        </div>
    </div>

    <div class="search-bar">
        <input type="text" id="search" placeholder="Search for items...">
        <button id="search-btn">Search</button>
    </div>

    <div class="catalog-title">
        <h2>Your Shopping List</h2>
    </div>

    <div class="list-container">
        <div class="card">
            <div class="product-img" style="background-image: url('path_to_image.jpg');"></div>
            <div class="card-content">
                <h3>Item 1</h3>
                <button class="btn-custom">Add to Cart</button>
            </div>
        </div>

        <div class="card">
            <div class="product-img" style="background-image: url('path_to_image.jpg');"></div>
            <div class="card-content">
                <h3>Item 2</h3>
                <button class="btn-custom">Add to Cart</button>
            </div>
        </div>

        <!-- Repeat for more items -->
    </div>

    <div class="footer">
        <div class="copyright">
            &copy; 2024 Your Company. All rights reserved.
        </div>
    </div>

</body>
</html>
