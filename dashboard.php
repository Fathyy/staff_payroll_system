<?php require __DIR__ . '/includes/navbar.php';?>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3" style="max-width: 18rem;">
                <div class="card-header">Department</div>
                <div class="card-body">
                    <h1 class="card-text">
                        <?php require 'config/database.php'
                        $sql = "SELECT ";
                        ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-3" style="max-width: 18rem;">
                <div class="card-header">Employees</div>
                <div class="card-body">
                    <h1 class="card-text"></h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-3" style="max-width: 18rem;">
                <div class="card-header">Payslip</div>
                <div class="card-body">
                    <h1 class="card-text"></h1>
                </div>
            </div>
        </div>
    </div>