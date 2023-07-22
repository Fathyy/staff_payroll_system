<?php
require __DIR__ . '/vendor/autoload.php';

require __DIR__ . "/config/database.php";
if (isset($_POST['payslip'])) :
    $emp_name =$_POST['employee_list'];
    $month =$_POST['month'];


    // get details of the employee chosen
    $sql = "SELECT * from employees where FullName ='$emp_name'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) :
        $row = mysqli_fetch_assoc($result);
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
        <?php
        $html .= '
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        </head>

        <body>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center lh-1 mb-2">
                        <h6 class="fw-bold mb-0"> Payslip </h6><br><span class="fw-normal fw-bold">Red stone Enterprises 
                            <br>
                            Kimathi Street. Nairobi, Kenya
                        </span>
                        <h6>' . $month . '</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">EMP Code</span> <small class="ms-3">39124</small> </div>
                                </div>
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">EMP Name</span> <small class="ms-3">' . $emp_name . '</small> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">ID No.</span> <small class="ms-3">101523065714</small> </div>
                                </div>
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">NOD</span> <small class="ms-3">28</small> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">Department</span> <small class="ms-3">' . $Department . '</small> </div>
                                </div>
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">Mode of Pay</span> <small class="ms-3">Bank Transfer</small> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">Designation</span> <small class="ms-3">' . $Designation . '</small> </div>
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
                                    <td>' . $food . '</td>
                                    <td>PAYE</td>
                                    <td>' . $paye . '</td>
                                </tr>
                                <tr>
                                    <th scope="row">Transport</th>
                                    <td>' . $transport . '</td>
                                    <td>NSSF</td>
                                    <td>' . $nssf . '</td>
                                </tr>
                                <tr>
                                    <th scope="row">Personal relief</th>
                                    <td>' . $personal_relief . '</td>
                                    <td>NHIF</td>
                                    <td> ' . $nhif . ' </td>
                                </tr>
                
                                <tr class="border-top">
                                    <th scope="row">Total Allowance</th>
                                    <td> ' . $total_allowances . ' </td>
                                    <td>Total Deductions</td>
                                    <td> ' . $total_deductions . ' </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-end"> <br> <span class="fw-bold">Net Pay:  ' . $net_pay . ' </span> </div>
                    </div>
                </div>
            </div>
        </div> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        </body>
        </html>  
        
        ';
        ?>
        
    <?php endif ?>
   

    <?php
    // insert payslip details into the database
    $query = "INSERT INTO payslip(FullName, Department, Designation, Date_issued, Food, Transport, Relief, 
    total_allowance, PAYE, NHIF, NSSF, total_deductions) 
    VALUES('$emp_name', '$Department', '$Designation', '$month', '$food', '$transport', '$personal_relief',
    '$total_allowances', '$paye', '$nhif', '$nssf', '$total_deductions')";
    $query_run = mysqli_query($conn, $query);
    ?>  
  
<?php endif ?>

<?php
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('Payslip.pdf');

?>


