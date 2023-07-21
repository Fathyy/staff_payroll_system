<?php
include_once __DIR__ . "/includes/header.php";
require __DIR__ . "/config/database.php";
// select the salary from employee based on the id in the get request
if (isset($_GET['id'])) :
    $id = $_GET['id'];
    $sql = "SELECT * from employees where id ='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) :
        $row = mysqli_fetch_assoc($result);
        $salary = $row['Salary'];
        ?>

        <!-- show the allowances, deductions info of the employee -->
        <div class="container">
            <div class="card p-2">
                <!-- details of the employee -->
                <div class="row">
                    <table class="table table-bordered table-responsive w-100">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Designation</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td><?php echo $row['FullName']?></td>
                                <td><?php echo $row['Department']?></td>
                                <td><?php echo $row['Designation']?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="row">
                    <!-- allowances -->
                    <div class="col-md-6">
                        <h4>Allowances</h4>
                        <?php 
                        $total_allowances = 0;
                        $food = 4000;
                        $transport = 2000;
                        $personal_relief = 2400;
                        $total_allowances = $food + $transport + $personal_relief;
                        
                        ?>
                        <p>Food Ksh<?php echo $food ?></p>
                        <p>Transport: Ksh<?php echo $transport ?></p>
                        <p>Personal Relief: Ksh<?php echo $personal_relief ?></p>
                        <p>Total Allowances: Ksh<b><?php echo $total_allowances ?></b></p>

                    </div>
                    <!-- deductions -->
                    <div class="col-md-6">
                        <h4>Deductions</h4>
                        <!-- get the salary from db -->
                        <?php
                            $paye = 0;
                            $nhif = 1700;
                            $nssf = 1080;
                            $total_deductions = 0;
                            // calculate PAYE of an individual
                            $first_bracket = (0.1*24000);
                            $second_bracket =(0.25* 8333);
                            $third_bracket =($salary -32333) * 0.3;
                            $paye = round($first_bracket + $second_bracket + $third_bracket);
                            $total_deductions = $paye + $nhif + $nssf;
                            ?>
                            <p>PAYE: <?php echo $paye?></p>
                            <p>NHIF: <?php echo $nhif?></p>
                            <p>NSSF: <?php echo $nssf?></p>
                            <p><b>Total deductions: <?php echo $total_deductions?></b></p>
                    
                            <?php
                            // calulate the net pay
                            $net_pay = ($salary + $total_allowances) - $total_deductions;   
                            ?>
                            <h5>Net Pay: <?php echo $net_pay?></h5>
                    </div>
                </div>

            </div>
        </div>
        
    <?php endif ?>
<?php endif?>


<?php include_once __DIR__ . "/includes/footer.php";?>