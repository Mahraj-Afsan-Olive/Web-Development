<?php
session_start(); // Start session for login system

// Check if user is logged in
$loggedIn = isset($_SESSION['username']) ? true : false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharma Care</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

    <header>
        <div class="container">
            <p>Your Trusted Healthcare Partner</p>
        </div>
        <div class="nav-container">
            <nav>
                <a href="about.php" class="nav-btn">About</a>
                <a href="visit-us.php" class="nav-btn">Visit Us</a>
                <?php if ($loggedIn): ?>
                    <a href="logout.php" class="nav-btn">Logout (<?php echo $_SESSION['username']; ?>)</a>
                <?php else: ?>
                    <a href="login.php" class="nav-btn">Log In</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <a href="learn-more.php" class="learn-more-btn">Learn More</a>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2025 Pharma Care. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
