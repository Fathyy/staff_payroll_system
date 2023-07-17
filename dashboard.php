<?php include_once __DIR__ . "/includes/header.php";?>
<div class="container">
    <div class="row mt-5">

        <div class="col-md-4" style="width:25%;">
            <div class="card mb-3">
                <div class="card-header">Departments</div>
                <div class="card-body">
                    <h1 class="card-text">
                        <?php require 'config/database.php';
                        $sql = "SELECT id from department";
                        $result = mysqli_query($conn, $sql);
                        echo mysqli_affected_rows($conn);
                        ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4" style="width:25%;">
            <div class="card mb-3">
                <div class="card-header">Employees</div>
                <div class="card-body">
                    <h1 class="card-text">
                        <?php require 'config/database.php';
                        $sql = "SELECT id from employees";
                        $result = mysqli_query($conn, $sql);
                        echo mysqli_affected_rows($conn);
                        ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4" style="width:25%;">
            <div class="card mb-3">
                <div class="card-header">Payslip</div>
                <div class="card-body">
                    <h1 class="card-text">
                        <?php require 'config/database.php';
                        // change this one to payslip later
                        $sql = "SELECT id from department";
                        $result = mysqli_query($conn, $sql);
                        echo mysqli_affected_rows($conn);
                        ?>
                    </h1>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include_once __DIR__ . "/includes/footer.php";
?>

    