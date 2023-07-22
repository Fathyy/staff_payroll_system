<?php
include_once __DIR__ . "/includes/header.php";?>
<div class="container">
    <div class="row mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Welcome <?php 
                if (isset($_SESSION['auth'])) {
                    $welcome_name = $_SESSION['auth']['fname'];
                }
                echo $welcome_name?></h2>
            </div>

            <div class="card-body">
                <h5>Hello you can finish setting up your account <a href="user-account.php">here</a></h5>
            </div>
        </div>

        

    </div>
</div>
<?php include_once __DIR__ . "/includes/footer.php";
?>

    