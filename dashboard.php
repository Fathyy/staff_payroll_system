<?php include_once __DIR__ . "/includes/header.php";?>
<div class="container">  
    <div class="row mt-5">
        <div class="welcome-message mb-5">
            <div class="card d-flex justify-content-around align-items-center">
                <div class="">
                    <i class="fa-solid fa-handshake fs-3 text-primary"></i>
                </div>
                <h2>Welcome Administrator</h2>
            </div>
        </div>

        <div class="col-md-12 col-lg-4" >
            <div class="card mb-3">
                <div class="card-body d-flex justify-content-around align-items-center">
                    <?php require 'config/database.php';
                    $sql = "SELECT id from department";
                    $result = mysqli_query($conn, $sql);    
                    ?>
                    <h5><?php echo mysqli_affected_rows($conn)?> Departments</h5>
                    <i class="fa-solid fa-building fs-3 border text-primary rounded-circle p-3"
                    style="background-color:#ADD8E6;"></i>                          
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-4">
            <div class="card mb-3">
                    <div class="card-body d-flex justify-content-around align-items-center">
                        <?php require 'config/database.php';
                        $sql = "SELECT id from employees";
                        $result = mysqli_query($conn, $sql);    
                        ?>
                        <h5><?php echo mysqli_affected_rows($conn)?> Employees</h5>
                        <i class="fa-solid fa-users fs-3 border text-primary rounded-circle p-3"
                        style="background-color:#ADD8E6;"></i>                          
                    </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-4">
            <div class="card mb-3">
                    <div class="card-body d-flex justify-content-around align-items-center">
                        <?php require 'config/database.php';
                        $sql = "SELECT id from payslip";
                        $result = mysqli_query($conn, $sql);    
                        ?>
                        <h5><?php echo mysqli_affected_rows($conn)?> Payslips</h5>
                        <i class="fa-solid fa-receipt fs-3 border text-primary rounded-circle p-3"
                        style="background-color:#ADD8E6;"></i>                          
                    </div>
            </div>
        </div>

    </div>
</div>

<!-- <footer class="footer">
  <div class="container">
    <p class="copyright-text">© Copyright 2023 Mohamed Abdi </p>
  </div>
</footer> -->

<?php include_once __DIR__ . "/includes/footer.php";
?>

    