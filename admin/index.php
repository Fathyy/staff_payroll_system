<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: login.php");
    exit;
}

require __DIR__ . '/../includes/header.php';
echo "This is the admin side";

?>
<a href="../logout.php">Logout</a>

<?php require __DIR__ . '/../includes/footer.php';?>

