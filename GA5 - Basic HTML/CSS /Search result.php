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

// Start the session and fetch the search query
session_start();
$search_query = isset($_SESSION['search_query']) ? $_SESSION['search_query'] : '';

// Initialize an array to hold items
$items = [];

if (!empty($search_query)) {
    // Prepare SQL query to search for items based on the search term
    $sql = "SELECT * FROM items WHERE name LIKE ? OR description LIKE ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $search_term = "%" . $search_query . "%";
        $stmt->bind_param("ss", $search_term, $search_term);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap');
        @import url('https://fonts.cdnfonts.com/css/gill-sans-2');
        @import url('https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@400&display=swap');

        /* General Body Styles */
        body {
            margin: 0;
            font-family: 'Lora', serif;
            background-color: #973131;
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Content Section Styling */
        .content {
            padding: 30px;
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .content h2 {
            font-family: 'Cinzel', serif;
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: white;
        }

        /* Card Container Styling */
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        /* Individual Card Styles */
        .card {
            background-color: #f5e7b2;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3);
        }

        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
            background-color: #eee; /* Fallback background color */
        }

        /* Placeholder Image Styling */
        .card img[alt=""] {
            content: url('placeholder-image.jpg'); /* Replace with your placeholder image URL */
        }

        /* Card Text Styles */
        .card-title {
            font-family: 'Cinzel', serif;
            font-size: 1.5rem;
            color: #973131;
            margin: 10px 0;
        }

        .card-description {
            font-family: 'Source Serif Pro', serif;
            font-size: 0.9rem;
            color: #333;
            margin: 10px 0;
        }

        .card-details {
            font-size: 0.9rem;
            color: #333;
        }

        .card-details p {
            margin: 5px 0;
            font-family: 'Source Serif Pro', serif;
        }

        /* Empty Row Styling */
        .empty-row {
            text-align: center;
            color: #f5e7b2;
            font-size: 1.2rem;
            font-family: 'Source Serif Pro', serif;
            margin-top: 20px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .content {
                padding: 20px;
            }

            .content h2 {
                font-size: 2rem;
            }

            .card img {
                height: 120px;
            }
        }
    </style>
</head>
<body>
    <div class="content">
        <h2>Search Results</h2>

        <?php if (!empty($items)): ?>
            <div class="card-container">
                <?php foreach ($items as $item): ?>
                    <div class="card">
                        <img src="images/<?php echo htmlspecialchars($item['item_id']); ?>.jpg" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <div class="card-title"><?php echo htmlspecialchars($item['name']); ?></div>
                        <div class="card-description"><?php echo htmlspecialchars($item['description']); ?></div>
                        <div class="card-details">
                            <p>Price: <?php echo htmlspecialchars(number_format($item['price'], 2)); ?></p>
                            <p>Quantity: <?php echo htmlspecialchars($item['quantity']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="empty-row">No items found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
