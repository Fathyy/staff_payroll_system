<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: login.php");
    exit;
}

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/sidebar.php';

?>

<?php require __DIR__ . '/includes/footer.php';?>

