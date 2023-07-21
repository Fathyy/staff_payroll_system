<?php
include_once __DIR__ . "/includes/header.php";
require __DIR__ . "/config/database.php";
// select employee details
if (isset($_GET['id'])) :
    $id = $_GET['id'];
    $sql = "SELECT * from employees where id ='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) :
        $row = mysqli_fetch_assoc($result);
        $name = $row['FullName'];
        $Department = $row['Department'];
        $Designation = $row['Designation'];
        $salary = $row['Salary'];

        // Allowances
        $total_allowances = 0;
        $food = 4000;
        $transport = 2000;
        $personal_relief = 2400;
        $total_allowances = $food + $transport + $personal_relief;
        
        // Deductions calculation
        $paye = 0;
        $nhif = 1700;
        $nssf = 1080;
        $total_deductions = 0;
        $net_pay = 0;
        // calculate PAYE of an individual
        $first_bracket = (0.1*24000);
        $second_bracket =(0.25* 8333);
        $third_bracket =($salary -32333) * 0.3;
        $paye = round($first_bracket + $second_bracket + $third_bracket);
        $total_deductions = $paye + $nhif + $nssf;
        $net_pay = ($salary + $total_allowances) - $total_deductions;
        ?>

        <!-- The payslip -->
        <div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center lh-1 mb-2">
                <h6 class="fw-bold mb-0"> Payslip </h6><br><span class="fw-normal fw-bold">Red stone Enterprises 
                    <br>
                    Kimathi Street. Nairobi, Kenya
                </span>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">EMP Code</span> <small class="ms-3">39124</small> </div>
                        </div>
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">EMP Name</span> <small class="ms-3"><?php echo $name?></small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">PF No.</span> <small class="ms-3">101523065714</small> </div>
                        </div>
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">NOD</span> <small class="ms-3">28</small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">ESI No.</span> <small class="ms-3"></small> </div>
                        </div>
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Mode of Pay</span> <small class="ms-3">Bank Transfer</small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Designation</span> <small class="ms-3"><?php echo $Designation?></small> </div>
                        </div>
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Ac No.</span> <small class="ms-3">*******0701</small> </div>
                        </div>
                    </div>
                </div>
                <table class="mt-4 table table-bordered">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col">Earnings</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Deductions</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Food</th>
                            <td><?php echo $food ?></td>
                            <td>PAYE</td>
                            <td><?php echo $paye ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Transport</th>
                            <td><?php echo $transport ?></td>
                            <td>NSSF</td>
                            <td><?php echo $nssf ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Personal relief</th>
                            <td><?php echo $personal_relief ?></td>
                            <td>NHIF</td>
                            <td><?php echo $nhif ?></td>
                        </tr>
        
                        <tr class="border-top">
                            <th scope="row">Total Allowance</th>
                            <td><?php echo $total_allowances ?></td>
                            <td>Total Deductions</td>
                            <td><?php echo $total_deductions ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="d-flex justify-content-end"> <br> <span class="fw-bold">Net Pay: <?php echo $net_pay ?></span> </div>
            </div>
        </div>
    </div>
</div>   
        
    <?php endif ?>
<?php endif?>


<?php include_once __DIR__ . "/includes/footer.php";?>