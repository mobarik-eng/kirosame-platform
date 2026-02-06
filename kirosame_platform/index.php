<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIROSAME Platform - Modern Real Estate</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">KIROSAME</a>
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="properties.php">Properties</a>
                <a href="contact.php">Contact</a>
                <a href="admin/login.php" class="btn btn-primary">Admin Login</a>
            </div>
        </div>
    </nav>

    <header class="hero">
        <div class="container hero-content">
            <h1>Find Your Dream Home</h1>
            <p>Discover the perfect property for sale or rent with Kirosame Platform.</p>
            <a href="properties.php" class="btn btn-primary">Browse Properties</a>
        </div>
    </header>

    <main class="container" style="margin-top: 4rem; margin-bottom: 4rem;">
        <h2 style="text-align: center; margin-bottom: 2rem;">Featured Properties</h2>
        <!-- Property Grid Placeholder -->
        <div class="property-grid"
            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
            <?php
            // Fetch latest 3 properties
            $stmt = $pdo->query("SELECT * FROM properties ORDER BY created_at DESC LIMIT 3");
            $properties = $stmt->fetchAll();

            if (count($properties) > 0) {
                foreach ($properties as $prop) {
                    echo '<div class="property-card">';
                    echo '<h3>' . sanitize($prop['title']) . '</h3>';
                    echo '<p>' . formatPrice($prop['price']) . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p style="text-align: center; grid-column: 1/-1;">No properties listed yet.</p>';
            }
            ?>
        </div>
    </main>

    <footer>
        <div class="container" style="text-align: center;">
            <p>&copy; 2026 Kirosame Platform. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>