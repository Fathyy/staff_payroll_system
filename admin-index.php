<?php
// The user should be logged in to access this page
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: login.php");
    exit;
}
require __DIR__ . '/includes/sidebar.php';
?>

<!-- main-section -->
<main id="view-panel" style="
    width:calc(100% - 250px);
    padding: .5em;">
<?php $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
include $page.'.php';
?>
</main>


