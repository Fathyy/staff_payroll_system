<?php
// The user should be logged in to access this page
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: login.php");
    exit;
}
// require __DIR__ . '/includes/sidebar.php'
include_once __DIR__ . "/includes/sidebar.php";?>

<script src="js/script.js"></script>


