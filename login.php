<?php
session_start();
require_once __DIR__ . "/includes/header.php";?>
<style>
    <?php include "css/style.css"?>
</style>
<div class="container">
    <div class="row d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-6 py-4 px-5 small-login" style="border: 1px solid black;">
        <h2 style="text-align:center;">Staff Payroll system</h2>
            <h3 class="header">Login Form</h3>
            <form action="action.php" method="post">
                <!-- email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <div class="btn">
                        <button type="submit" class="small-login btn btn-primary text-center" name="login">Login</button>
                    </div>

                    <div>
                    <p>Don't have an account? Signup <a href="signup.php">Here</a></p>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once __DIR__ . "/includes/footer.php";?>

<script>
    // display invalid credential error
    <?php 
    if (isset($_SESSION['error'])) :?>
        alertify.set('notifier','position', 'top-right');
        alertify.success('<?php echo $_SESSION['error']?>');

        unset($_SESSION['error']);
    <?php endif?>    
</script>