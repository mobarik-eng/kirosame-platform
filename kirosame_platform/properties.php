<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties - KIROSAME Platform</title>
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
                <a href="properties.php" class="active">Properties</a>
                <a href="contact.php">Contact</a>
                <a href="admin/login.php" class="btn btn-primary">Admin Login</a>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 3rem; margin-bottom: 3rem;">
        <h1 style="margin-bottom: 2rem;">All Properties</h1>

        <div class="property-grid"
            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
            <?php
            $stmt = $pdo->query("SELECT * FROM properties ORDER BY created_at DESC");
            $properties = $stmt->fetchAll();

            if (count($properties) > 0) {
                foreach ($properties as $prop) {
                    $image = $prop['image_url'] ? 'assets/uploads/' . $prop['image_url'] : 'assets/images/placeholder.jpg';
                    echo '<a href="property.php?id=' . $prop['id'] . '" class="property-card-link">';
                    echo '<div class="property-card" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; overflow: hidden; transition: transform 0.2s;">';
                    echo '<div style="height: 200px; background-color: #eee; background-image: url(\'' . sanitize($image) . '\'); background-size: cover; background-position: center;"></div>';
                    echo '<div style="padding: 1.5rem;">';
                    echo '<h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">' . sanitize($prop['title']) . '</h3>';
                    echo '<p style="color: var(--primary-color); font-weight: 700; font-size: 1.1rem; margin-bottom: 0.5rem;">' . formatPrice($prop['price']) . '</p>';
                    echo '<p style="color: var(--text-light);">' . sanitize($prop['location']) . '</p>';
                    echo '<div style="margin-top: 1rem; display: flex; justify-content: space-between; align-items: center;">';
                    echo '<span style="background: #e0e7ff; color: #4338ca; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.875rem; text-transform: capitalize;">' . sanitize($prop['type']) . '</span>';
                    echo '<span style="color: var(--primary-color); font-weight: 500;">View Details &rarr;</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a>';
                }
            } else {
                echo '<p style="grid-column: 1/-1;">No properties found.</p>';
            }
            ?>
        </div>
    </div>

    <footer>
        <div class="container" style="text-align: center;">
            <p>&copy; 2026 Kirosame Platform. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>