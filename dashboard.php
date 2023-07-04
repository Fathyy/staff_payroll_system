<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php require __DIR__ . '/includes/navbar.php'?>
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
</body>
</html>

    