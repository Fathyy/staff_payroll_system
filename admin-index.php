<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: login.php");
    exit;
}

require __DIR__ . '/includes/header.php';


require __DIR__ . '/includes/sidebar.php'?>
<div class="content">
    <p>Hello this is the admin page</p>

</div>
<script src="js/script.js"></script>
<?php require __DIR__ . '/includes/footer.php';?>


