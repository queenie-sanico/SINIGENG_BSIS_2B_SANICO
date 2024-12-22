<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="log in.css">
<head>
<body>
    <!-- Header -->
    <div class="name">
        <h1>DAZZLE OASIS</h1>
        <div class="underline"></div>
    </div>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Navigation Buttons -->
            <div class="nav-buttons">
                <a href="homepage.php" class="btn btn-custom">HOME</a>
                <a href="homepage.php#discover" class="btn btn-custom">WHAT'S NEW</a>
                <a href="homepage.php#gifts" class="btn btn-custom">GIFTS</a>
                <a href="loginform.php" class="btn btn-custom">SHOP</a>
                <a href="homepage.php#about-us" class="btn btn-custom">ABOUT US</a>
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
                <a href="loginform.php" class="fas fa-user"></a>
                <a href="loginform.php" class="fas fa-shopping-bag"></a>
            </div>
        </div>
    </nav>

    <!-- Login Container -->
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="login process.php">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="options d-flex justify-content-between align-items-center">
                <div>
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Remember Me</label>
                </div>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>
            <button type="submit" class="login-button btn btn-custom">Login</button>
        <form>
        <p>Don't have an account? <a href="signupform.php" class="register-link">Register</a></p>
        <p>Sign up and be a seller today! <a href="signupadmin.php" class="register-link">Register</a></p>
    <div>
    
<body>
<html>
