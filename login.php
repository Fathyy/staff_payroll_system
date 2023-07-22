<?php
require_once __DIR__ . "/includes/header.php";?>

<div class="container">
    <div class="row flex-container justify-content-center align-items-center vh-100">
        <div class="col-md-6 py-4 px-5" style="border: 1px solid black;">
        <div class="img">
            <img src="images\red-stone-logo.jpg" alt="">
        </div>
            <h3 class="header">Login Form</h3>
            <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> -->
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
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                    </div>

                    <div>
                    <p>Don't have an account? Signup <a href="signup.php">Here</a></p>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once __DIR__ . "/includes/footer.php";?>