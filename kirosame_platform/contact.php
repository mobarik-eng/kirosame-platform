<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - KIROSAME Platform</title>
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
                <a href="contact.php" class="active">Contact</a>
                <a href="admin/login.php" class="btn btn-primary">Admin Login</a>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 3rem; margin-bottom: 3rem;">
        <h1 style="text-align: center; margin-bottom: 2rem;">Contact Us</h1>
        <div
            style="background: white; padding: 3rem; border-radius: 0.5rem; max-width: 600px; margin: 0 auto; box-shadow: var(--shadow-sm); text-align: center;">
            <p style="font-size: 1.25rem; margin-bottom: 2rem;">We'd love to hear from you. Reach out to us for any
                inquiries.</p>

            <div style="margin-bottom: 2rem;">
                <h3 style="color: var(--primary-color);">WhatsApp</h3>
                <p>+252 63 1234567</p>
            </div>

            <div style="margin-bottom: 2rem;">
                <h3 style="color: var(--primary-color);">Email</h3>
                <p>info@kirosame.com</p>
            </div>

            <div style="margin-bottom: 2rem;">
                <h3 style="color: var(--primary-color);">Office</h3>
                <p>Main Street, Hargeisa, Somaliland</p>
            </div>

            <a href="https://wa.me/252631234567" class="btn btn-primary" target="_blank">Chat on WhatsApp</a>
        </div>
    </div>

    <footer>
        <div class="container" style="text-align: center;">
            <p>&copy; 2026 Kirosame Platform. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>