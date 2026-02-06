<?php
// includes/db.php

// Define the path to the SQLite database file
$dbPath = __DIR__ . '/../kirosame.sqlite';

try {
    // Create a new PDO instance for SQLite
    $pdo = new PDO("sqlite:$dbPath");
    
    // Set error mode to exception for easier debugging
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Create tables if they don't exist
    $commands = [
        "CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS properties (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT NOT NULL,
            description TEXT,
            price REAL NOT NULL,
            location TEXT NOT NULL,
            type TEXT NOT NULL CHECK(type IN ('rent', 'sale')),
            image_url TEXT,
            video_url TEXT,
            whatsapp_number TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )"
    ];

    foreach ($commands as $command) {
        $pdo->exec($command);
    }
    
    // Seed admin user if not exists (username: admin, password: password123)
    // Note: In production, password should be hashed. We use password_hash here.
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = 'admin'");
    $stmt->execute();
    if ($stmt->fetchColumn() == 0) {
        $password = password_hash('password123', PASSWORD_DEFAULT);
        $insert = $pdo->prepare("INSERT INTO users (username, password) VALUES ('admin', ?)");
        $insert->execute([$password]);
    }

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
