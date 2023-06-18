<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: login.php");
    exit;
}

require __DIR__ . '/includes/header.php';
include ('includes/sidebar.php')?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
 <?php include ('includes/navbar.php')
?>

<?php require __DIR__ . '/includes/footer.php';?>

