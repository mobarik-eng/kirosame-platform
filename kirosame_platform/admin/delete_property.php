<?php
// admin/delete_property.php
require_once '../includes/db.php';
require_once '../includes/functions.php';
session_start();
requireLogin();

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Optional: Get file paths to delete files from server
    // $stmt = $pdo->prepare("SELECT image_url, video_url FROM properties WHERE id = ?");
    // $stmt->execute([$id]);
    // $prop = $stmt->fetch();
    // if ($prop) {
    //    if ($prop['image_url']) @unlink('../assets/uploads/' . $prop['image_url']);
    //    if ($prop['video_url']) @unlink('../assets/uploads/' . $prop['video_url']);
    // }

    $stmt = $pdo->prepare("DELETE FROM properties WHERE id = ?");
    $stmt->execute([$id]);
}

redirect('dashboard.php');
?>