<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';
session_start();
requireLogin();

$stmt = $pdo->query("SELECT * FROM properties ORDER BY created_at DESC");
$properties = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - KIROSAME Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .admin-table th,
        .admin-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .admin-table th {
            background-color: #f9fafb;
            font-weight: 600;
        }

        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            background: #eee;
        }

        .badge-rent {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .badge-sale {
            background-color: #d1fae5;
            color: #065f46;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <a href="dashboard.php" class="logo">Admin Panel</a>
            <div class="nav-links">
                <a href="../index.php" target="_blank">View Site</a>
                <span>Welcome,
                    <?php echo sanitize($_SESSION['username']); ?>
                </span>
                <a href="logout.php" class="btn btn-outline"
                    style="padding: 0.5rem 1rem; font-size: 0.875rem;">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 3rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h1>Dashboard</h1>
            <a href="add_property.php" class="btn btn-primary">+ Add New Property</a>
        </div>

        <div style="background: white; border-radius: 0.5rem; box-shadow: var(--shadow-sm); overflow: hidden;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($properties as $prop): ?>
                        <tr>
                            <td style="width: 100px;">
                                <?php if ($prop['image_url']): ?>
                                    <img src="../assets/uploads/<?php echo sanitize($prop['image_url']); ?>" alt="Prop"
                                        style="width: 80px; height: 60px; object-fit: cover; border-radius: 4px;">
                                <?php else: ?>
                                    <div style="width: 80px; height: 60px; background: #eee; border-radius: 4px;"></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo sanitize($prop['title']); ?>
                            </td>
                            <td>
                                <?php echo formatPrice($prop['price']); ?>
                            </td>
                            <td><span class="badge badge-<?php echo strtolower($prop['type']); ?>">
                                    <?php echo strtoupper($prop['type']); ?>
                                </span></td>
                            <td>
                                <a href="edit_property.php?id=<?php echo $prop['id']; ?>"
                                    style="color: #2563eb; margin-right: 1rem;">Edit</a>
                                <a href="delete_property.php?id=<?php echo $prop['id']; ?>"
                                    onclick="return confirm('Are you sure?')" style="color: #dc2626;">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>