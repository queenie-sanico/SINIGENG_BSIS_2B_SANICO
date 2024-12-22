<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign-Up Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="signup.css">
</head>

<body>
  <div class="name text-center py-4">
    <h1>DAZZLE OASIS</h1>
    <div class="underline my-2"></div>
  </div>

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container d-flex justify-content-between align-items-center">
      <!-- Navigation Buttons -->
      <div class="nav-buttons">
        <a href="homepage.php" class="btn btn-custom">HOME</a>
        <a href="homepage.php#discover" class="btn btn-custom">WHAT'S NEW</a>
        <a href="homepage.php#gifts" class="btn btn-custom">GIFTS</a>
        <a href="login form.php" class="btn btn-custom">SHOP</a>
        <a href="homepage.php#about us" class="btn btn-custom">ABOUT US</a>
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
        <a href="loginform.php" class="fas fa-user me-3"></a>
        <a href="loginform.php" class="fas fa-shopping-bag"></a>
      </div>
    </div>
  </nav>

  <!-- Sign-Up Form -->
  <div class="login-container container my-5">
    <h2 class="text-center mb-4">Sign Up</h2>
    <form action="signup process.php" method="POST">
      <div class="form-group mb-3">
        <label for="first-name">First Name</label>
        <input type="text" name="firstname" id="first-name" class="form-control" placeholder="First Name" required>
      </div>

      <div class="form-group mb-3">
        <label for="last-name">Last Name</label>
        <input type="text" name="lastname" id="last-name" class="form-control" placeholder="Last Name" required>
      </div>

      <div class="form-group mb-3">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
      </div>

      <div class="form-group mb-3">
        <label for="password">Create Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
      </div>

      <div class="form-group mb-3">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="Confirm your password" required>
      </div>

      <div class="form-group mb-3">
        <label for="contact">Contact Number</label>
        <input type="text" id="contact" name="contact" class="form-control" placeholder="Enter your contact number" required>
      </div>

      <div class="form-group mb-3">
        <label for="address">Address</label>
        <input type="text" id="address" name="address" class="form-control" placeholder="Enter your address" required>
      </div>

      <div class="form-group mb-3">
        <label for="age">Age</label>
        <input type="number" id="age" name="age" class="form-control" placeholder="Enter your age" required>
      </div>

      <div class="form-group mb-3">
        <label for="birthday">Birthday</label>
        <input type="date" id="birthday" name="birthday" class="form-control" required>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary login-button">Sign Up</button>
      </div>
    </form>
    <p class="text-center mt-3">
      Already have an account? <a href="login form.php" class="register-link">Login</a>
    </p>
  </div>
</body>

</html>
