<?php
// The admin should be logged in to access this page
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: login.php");
    exit;
}
?>

<?php require __DIR__ . '/includes/user-sidebar.php';?>


<!-- main-section -->
<main id="view-user" style="
    width:calc(100% - 250px);
    padding: .5em;">
<?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';
include $page.'.php';
?>
</main>


