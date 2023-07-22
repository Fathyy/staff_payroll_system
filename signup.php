<?php
session_start();
require_once __DIR__ . "/includes/header.php";            
?>

<div class="container">
    <div class="row flex-container justify-content-center align-items-center vh-100">
        <div class="col-md-6 py-4 px-5" style="border: 1px solid black;">
        <div class="img">
            <img src="images\red-stone-logo.jpg" alt="">
        </div>
            <h3 class="header">Signup Form</h3>
            <form action="action.php" method="post">
                <?php
                if (isset($_SESSION['errors'])) {
                    $error = $_SESSION['errors'];
                    unset($_SESSION['errors']);
                }
                ?>
                <!-- Full name -->
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullName">
                        </div>
                
                <!-- email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                        <small style="color:red"><?php echo $error['email'] ?? ""?></small>
                    </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <small style="color:red"><?php echo $error['password'] ?? ""?></small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="cpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="cpassword" name="cpassword">
                            <small style="color:red"><?php echo $error['cpassword'] ?? ""?></small>
                        </div>
                    </div>
                </div>

                <div class="btn">
                <button type="submit" class="btn btn-primary" name="signup">Signup</button>
                </div>
                
                <div>
                    <p>Already have an account? Log in <a href="login.php">Here</a></p>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once __DIR__ . "/includes/footer.php";?>