<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

if (!isset($_GET['id'])) {
    redirect('properties.php');
}

$id = (int) $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM properties WHERE id = ?");
$stmt->execute([$id]);
$prop = $stmt->fetch();

if (!$prop) {
    redirect('properties.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo sanitize($prop['title']); ?> - KIROSAME Platform
    </title>
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

    <div class="container" style="margin-top: 3rem; margin-bottom: 3rem;">
        <div class="property-detail" style="display: grid; grid-template-columns: 2fr 1fr; gap: 3rem;">

            <!-- Left Column: Media & Description -->
            <div>
                <?php
                $image = $prop['image_url'] ? 'assets/uploads/' . $prop['image_url'] : 'assets/images/placeholder.jpg';
                ?>
                <div
                    style="height: 400px; background-color: #eee; background-image: url('<?php echo sanitize($image); ?>'); background-size: cover; background-position: center; border-radius: 0.5rem; margin-bottom: 2rem;">
                </div>

                <?php if ($prop['video_url']): ?>
                    <div style="margin-bottom: 2rem;">
                        <h3>Property Video</h3>
                        <video controls style="width: 100%; border-radius: 0.5rem;">
                            <source src="assets/uploads/<?php echo sanitize($prop['video_url']); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                <?php endif; ?>

                <div style="background: white; padding: 2rem; border-radius: 0.5rem; box-shadow: var(--shadow-sm);">
                    <h2 style="margin-bottom: 1rem;">Description</h2>
                    <p style="color: var(--text-light); white-space: pre-line;">
                        <?php echo sanitize($prop['description']); ?>
                    </p>
                </div>
            </div>

            <!-- Right Column: Info & Contact -->
            <div>
                <div
                    style="background: white; padding: 2rem; border-radius: 0.5rem; box-shadow: var(--shadow-md); position: sticky; top: 100px;">
                    <span
                        style="background: #e0e7ff; color: #4338ca; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.875rem; text-transform: capitalize; display: inline-block; margin-bottom: 1rem;">
                        <?php echo sanitize($prop['type']); ?>
                    </span>
                    <h1 style="font-size: 2rem; margin-bottom: 0.5rem;">
                        <?php echo sanitize($prop['title']); ?>
                    </h1>
                    <p style="font-size: 1.5rem; font-weight: 700; color: var(--primary-color); margin-bottom: 1rem;">
                        <?php echo formatPrice($prop['price']); ?>
                    </p>
                    <p style="color: var(--text-light); margin-bottom: 2rem;">📍
                        <?php echo sanitize($prop['location']); ?>
                    </p>

                    <a href="https://wa.me/<?php echo sanitize($prop['whatsapp_number']); ?>?text=I'm interested in <?php echo urlencode($prop['title']); ?>"
                        target="_blank" class="btn btn-primary"
                        style="display: block; text-align: center; width: 100%; margin-bottom: 1rem; background-color: #25D366;">
                        Chat on WhatsApp
                    </a>
                    <button onclick="window.print()" class="btn btn-outline"
                        style="display: block; text-align: center; width: 100%;">Print Details</button>
                </div>
            </div>

        </div>
    </div>

    <footer>
        <div class="container" style="text-align: center;">
            <p>&copy; 2026 Kirosame Platform. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>