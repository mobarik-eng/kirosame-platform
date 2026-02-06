<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';
session_start();
requireLogin();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $type = $_POST['type'];
    $whatsapp = $_POST['whatsapp'];

    // File Upload Handling
    $image_url = '';
    $video_url = '';
    $upload_dir = __DIR__ . '/../assets/uploads/';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '_img.' . $ext;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $filename)) {
            $image_url = $filename;
        }
    }

    if (isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
        $ext = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '_vid.' . $ext;
        if (move_uploaded_file($_FILES['video']['tmp_name'], $upload_dir . $filename)) {
            $video_url = $filename;
        }
    }

    if ($title && $price && $location) {
        $stmt = $pdo->prepare("INSERT INTO properties (title, description, price, location, type, whatsapp_number, image_url, video_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$title, $description, $price, $location, $type, $whatsapp, $image_url, $video_url])) {
            $success = "Property added successfully!";
        } else {
            $error = "Failed to add property.";
        }
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Property - KIROSAME Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
        }

        .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            background: white;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <a href="dashboard.php" class="logo">Admin Panel</a>
            <div class="nav-links">
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php" class="btn btn-outline"
                    style="padding: 0.5rem 1rem; font-size: 0.875rem;">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 3rem; margin-bottom: 3rem; max-width: 800px;">
        <h1 style="margin-bottom: 2rem;">Add New Property</h1>

        <?php if ($error): ?>
            <div
                style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div
                style="background-color: #d1fae5; color: #065f46; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <?php echo $success; ?> <a href="dashboard.php" style="text-decoration: underline;">Back to Dashboard</a>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data"
            style="background: white; padding: 2rem; border-radius: 0.5rem; box-shadow: var(--shadow-sm);">
            <div class="form-group">
                <label class="form-label">Property Title *</label>
                <input type="text" name="title" required class="form-control"
                    placeholder="e.g. Modern Villa in Hargeisa">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Price ($) *</label>
                    <input type="number" name="price" required class="form-control" placeholder="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Type *</label>
                    <select name="type" class="form-select">
                        <option value="rent">Rent</option>
                        <option value="sale">Sale</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Location *</label>
                <input type="text" name="location" required class="form-control" placeholder="City, District">
            </div>

            <div class="form-group">
                <label class="form-label">WhatsApp Number *</label>
                <input type="text" name="whatsapp" required class="form-control" placeholder="25263...">
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" rows="5" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Main Image</label>
                <input type="file" name="image" accept="image/*" class="form-control">
            </div>

            <div class="form-group">
                <label class="form-label">Property Video (Optional)</label>
                <input type="file" name="video" accept="video/*" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Add Property</button>
        </form>
    </div>
</body>

</html>