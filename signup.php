<?php
session_start();
require_once __DIR__ . "/includes/header.php";            
?>

<div class="container">
    <div class="row flex-container justify-content-center align-items-center">
        <div class="col-md-6 border py-4 px-5">
            <h3 class="header">Signup Form</h3>
            <form action="action.php" method="post">
                <?php
                if (isset($_SESSION['errors'])) {
                    $error = $_SESSION['errors'];
                    unset($_SESSION['errors']);
                }
                ?>
                <!-- row for first name and last name -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname">
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname">
                            </div>
                        </div>
                    
                </div>
                
                <!-- email -->
                <div class="row">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                        <small style="color:red"><?php echo $error['email'] ?? ""?></small>
                    </div>
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