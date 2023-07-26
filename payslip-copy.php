<?php
require __DIR__ . '/vendor/autoload.php';

require __DIR__ . "/config/database.php";

if (isset($_POST['payslip'])) :
    $emp_name =$_POST['employee_list'];
    $date =$_POST['date'];


    // get details of the employee chosen
    $sql = "SELECT * from employees where FullName ='$emp_name'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) :
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $Department = $row['Department'];
        $Designation = $row['Designation'];
        $salary = $row['Salary'];
        $Gender = $row['Gender'];
        $National_id = $row['National_id'];

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
    <?php endif ?>

        <?php
        // insert payslip details into the database
        $query = "INSERT INTO payslip(emp_id, Date_issued, Food, Transport, Relief, 
        total_allowance, PAYE, NHIF, NSSF, total_deductions, Net_pay) 
        VALUES('$id','$date', '$food', '$transport', '$personal_relief',
        '$total_allowances', '$paye', '$nhif', '$nssf', '$total_deductions', '$net_pay')";
        $query_run = mysqli_query($conn, $query);
        // Get the id of the last inserted record provided it has an auto increment function
        $lastInsertedId = mysqli_insert_id($conn);
        $selectQuery = "SELECT * FROM payslip p, employees e WHERE p.emp_id = e.id AND
        p.emp_id = '$lastInsertedId'";
        $resultt = mysqli_query($conn, $selectQuery);
        if (mysqli_num_rows($resultt) > 0) {
            while($payslip = mysqli_fetch_assoc($resultt)) {
                $html ="";
                $html .='

            <!-- The payslip -->
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center lh-1 mb-2" style="text-align:center;">
                            <h6 class="fw-bold mb-0" style="margin-bottom: 1rem;"> Payslip </h6><br><span class="fw-normal fw-bold">Red stone Enterprises 
                                <br>
                                Kimathi Street. Nairobi, Kenya
                            </span>
                            <h6> '.$payslip['Date_issued']. '</h6>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div> <span class="fw-bolder">EMP Code</span> <small class="ms-3">39124</small> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div> <span class="fw-bolder">EMP Name</span> <small class="ms-3">'.$payslip['FullName'].'</small> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div> <span class="fw-bolder">ID No.</span> <small class="ms-3">77376363</small> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div> <span class="fw-bolder">Gender</span> <small class="ms-3">Null</small> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div> <span class="fw-bolder">Department</span> <small class="ms-3">'.$payslip['Department'].'</small> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div> <span class="fw-bolder">Mode of Pay</span> <small class="ms-3">Bank Transfer</small> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div> <span class="fw-bolder">Designation</span> <small class="ms-3">'.$payslip['Designation'].'</small> </div>
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
                                        <td>'.$payslip['Food'].'</td>
                                        <td>PAYE</td>
                                        <td>'.$payslip['PAYE'].'</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Transport</th>
                                        <td>'.$payslip['Transport'].'</td>
                                        <td>NSSF</td>
                                        <td>'.$payslip['NSSF'].'</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Personal relief</th>
                                        <td>'.$payslip['Relief'].'</td>
                                        <td>NHIF</td>
                                        <td> '.$payslip['NHIF'].'</td>
                                    </tr>
                    
                                    <tr class="border-top">
                                        <th scope="row">Total Allowance</th>
                                        <td>'.$payslip['total_allowance'].'</td>
                                        <td>Total Deductions</td>
                                        <td>'.$payslip['total_deductions'].'</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-end"> <br> <span class="fw-bold">Net Pay: '.$payslip['Net_pay'].'</span> </div>
                        </div>
                    </div>
                </div>
            </div>  
            ';
}
        } 
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

ob_end_clean();
// Output the generated PDF to Browser
$dompdf->stream('Payslip.pdf', ['Attachment'=> 0]);
?>

    


