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
    <link rel="stylesheet" href="homepage.css">
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
                <a href="homepage.php" class="btn btn-custom">HOME</a>
                <a href="#discover" class="btn btn-custom">WHAT'S NEW</a>
                <a href="#gifts" class="btn btn-custom">GIFTS</a>
                <a href="login form.php" class="btn btn-custom">SHOP</a>
                <a href="#about us" class="btn btn-custom">ABOUT US</a>
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
                <a href="login form.php" class="fas fa-user"></a>
                <a href="login form.php" class="fas fa-shopping-bag"></a>
            </div>
        </div>
    </nav>

    <!-- Video Section -->
    <div class="video-container">
        <video autoplay loop muted>
            <source src="IMGVID/vidcut jewelry.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- DISCOVER Section -->
    <section class="container py-5" id="discover">
        <h2 class="section-title text-center">DISCOVER</h2>
        <div class="row g-4">
            <!-- Earrings -->
            <div class="col-md-4">
                <div class="card">
                    <img src="IMGVID/bracelet.jpg" alt="Earrings" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">EARRINGS</h5>
                        <p class="card-text">
                            Elevate your style with our exquisite collection of earrings, designed to complement every occasion.
                            From delicate studs that add a touch of elegance to bold statement pieces that turn heads, our earrings are crafted with precision and care.
                            Made with high-quality materials such as sterling silver, gold plating, and premium gemstones, these accessories are not only beautiful but also durable.
                            Perfect as a gift or a treat for yourself, our earrings blend timeless designs with modern trends to suit every taste.
                            Discover your next favorite pair today!
                        </p>
                    </div>
                </div>
            </div>

            <!-- Necklaces -->
            <div class="col-md-4">
                <div class="card">
                    <img src="IMGVID/necklace.jpg" alt="Necklaces" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">NECKLACES</h5>
                        <p class="card-text">
                            Discover timeless elegance with our exquisite collection of necklaces.
                            Whether you're looking for a statement piece or something delicate for everyday wear, our necklaces are crafted with attention to detail and quality.
                            From sparkling gemstones to minimalist designs, each necklace is made to complement any occasion, adding a touch of sophistication to your style.
                            Perfect as a gift or a treat for yourself, our necklaces are available in various styles and lengths, ensuring there's something for every taste and preference.
                            Find your perfect match today and let your jewelry speak volumes!
                        </p>
                    </div>
                </div>
            </div>

            <!-- Bracelets -->
            <div class="col-md-4">
                <div class="card">
                    <img src="IMGVID/bracelet.jpg" alt="Bracelets" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">BRACELETS</h5>
                        <p class="card-text">
                            Discover our stunning collection of bracelets, crafted to add a touch of elegance to any outfit.
                            From timeless designs featuring premium materials like sterling silver and gold to trendy pieces adorned with sparkling crystals, gemstones, and charms, our bracelets cater to every style and occasion.
                            Whether you're looking for a sleek minimalist design, a statement cuff, or a personalized piece to treasure forever, our selection ensures there's something perfect for you or a loved one.
                            Elevate your look with bracelets that blend beauty and quality seamlessly!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- THE SPECIALS Section -->
    <section class="container py-5" id="gifts">
        <h2 class="section-head text-center mb-5">THE SPECIALS</h2>

        <!-- First Product Section -->
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <img src="IMGVID/sapphire ring.png" alt="Midnight Dew" class="special-image img-fluid">
            </div>
            <div class="col-md-6">
                <h5 class="special-title">MIDNIGHT DEW</h5>
                <p class="special-text">
                    Elegance meets serenity with the Midnight Dew Sapphire Ring. This minimalist design features a stunning blue sapphire, reminiscent of the deep, tranquil hues of midnight skies.
                    The sapphire’s rich color is elegantly set in a sleek, simple band, allowing its natural beauty to shine through without distraction.
                    The Midnight Dew is perfect for those who appreciate understated sophistication, making it a timeless addition to any jewelry collection.
                    Whether for daily wear or a special occasion, this ring embodies the quiet beauty of twilight, bringing a touch of refined luxury to every moment.
                </p>
            </div>
        </div>

        <!-- Second Product Section -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="IMGVID/braceletstar.jpg" alt="Starry Serenity" class="special-image img-fluid">
            </div>
            <div class="col-md-6">
                <h5 class="special-title">STARRY SERENITY</h5>
                <p class="special-text">
                    Embrace the quiet beauty of the night sky with the Starry Serenity Silver Bracelet.
                    Crafted from premium sterling silver, this bracelet features delicate star-shaped accents that shimmer like constellations in a serene evening sky.
                    Its minimalist design adds a touch of celestial elegance to any outfit, making it perfect for everyday wear or as a subtle statement for special occasions.
                    The Starry Serenity is more than just jewelry—it’s a reminder to carry a piece of the cosmos with you, wherever you go.
                </p>
            </div>
        </div>
    </section>

    <!-- ABOUT US Section -->
    <section class="container py-5" id="about us">
        <h2 class="section-head text-center mb-5">ABOUT US</h2>
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3 class="about-title">Our Story</h3>
                <p class="about-text">
                    Welcome to Dazzle Oasis, your ultimate destination for exquisite jewelry that combines timeless elegance with modern charm.
                    At Dazzle Oasis, we believe every piece of jewelry tells a unique story, and we are here to help you shine brighter in every chapter of your life.
                    Our curated collection features stunning designs crafted with precision, quality materials, and a passion for artistry.
                    Whether you’re looking for a sparkling statement piece, a sentimental gift, or a subtle touch of luxury for everyday wear, we have something special for everyone.
                </p>
                <h3 class="about-title">Our Mission</h3>
                <p class="about-text">
                    Our mission is to inspire confidence and self-expression through unique designs that reflect individuality and style.
                    We strive to provide exceptional service and unforgettable experiences for our customers.
                </p>
            </div>
            <div class="col-md-6">
                <img src="IMGVID/admin.jpg" alt="About Us" class="img-fluid rounded">
            </div>
        </div>
    </section>

    <!-- Bootstrap and Font Awesome Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
