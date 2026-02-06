<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';
session_start();

if (isLoggedIn()) {
    redirect('dashboard.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        redirect('dashboard.php');
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - KIROSAME</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body
    style="display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f3f4f6;">
    <div
        style="background: white; padding: 2.5rem; border-radius: 0.5rem; width: 100%; max-width: 400px; box-shadow: var(--shadow-lg);">
        <h2 style="text-align: center; margin-bottom: 2rem; color: var(--primary-color);">Admin Login</h2>

        <?php if ($error): ?>
            <div
                style="background-color: #fee2e2; color: #991b1b; padding: 0.75rem; border-radius: 0.25rem; margin-bottom: 1.5rem; text-align: center;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Username</label>
                <input type="text" name="username" required
                    style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Password</label>
                <input type="password" name="password" required
                    style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Sign In</button>
        </form>
        <p style="text-align: center; margin-top: 2rem;">
            <a href="../index.php" style="color: var(--text-light); font-size: 0.875rem;">&larr; Back to Home</a>
        </p>
    </div>
</body>

</html>