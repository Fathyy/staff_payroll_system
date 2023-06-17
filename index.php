<?php
session_start();
require __DIR__ . '/includes/header.php';

if (!isset($_SESSION['auth'])) {
    header("Location: login.php");
    exit;
}
?>
<?php require __DIR__ . '/includes/footer.php';?>

