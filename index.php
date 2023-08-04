<?php
// The user should be logged in to access this page
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: login.php");
    exit;
}
?>

<?php require __DIR__ . '/includes/user-sidebar.php';?>

<style>
    <?php include "css/style.css"?>
</style>

<!-- main-section -->
<div class="main-wrapper">
    <main id="view-panel">
        <!-- button to open sidebar in small screens -->
        <div class="container">
                <div id="small-button" class="small-button">
                <i class="fa-solid fa-align-left fs-3"></i>
                </div>
            </div>
        <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        include $page.'.php';
        ?>
    </main>
</div>

<script>
    <?php require_once("js/script.js");?>
</script>


