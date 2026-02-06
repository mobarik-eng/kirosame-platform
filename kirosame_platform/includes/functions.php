<?php
// includes/functions.php

function sanitize($text)
{
    return htmlspecialchars(trim($text), ENT_QUOTES, 'UTF-8');
}

function formatPrice($price)
{
    return '$' . number_format($price, 0);
}

function redirect($url)
{
    header("Location: $url");
    exit;
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function requireLogin()
{
    if (!isLoggedIn()) {
        redirect('/admin/login.php');
    }
}
?>