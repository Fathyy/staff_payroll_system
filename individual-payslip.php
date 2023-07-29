<?php
require_once __DIR__ . "/config/database.php";
require_once __DIR__ . "/fpdf/fpdf.php";

if (isset($_GET['id'])) :
    $id  = $_GET['id'];

    $sql = "SELECT * from employees where id ='$id'";
    $result = mysqli_query($conn, $sql);
    // get details of the employee chosen
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
<?php endif ?>

        <?php
        $row_data=[
            'FullName'=>'',
            'Department'=>'',
            'Designation'=>'',
            'ID_no'=>'',
            'Salary'=>'',
            'Email'=>'',
            'Date_issued'=>'',
            'mode_of_pay'=>'',
            'Food'=>'',
            'Transport'=>'',
            'Relief'=>'',
            'total_allowance'=>'',
            'Paye'=>'',
            'nhif'=>'',
            'nssf'=>'',
            'total_deductions'=>'',
            'net_pay'=>'' 
        ]; 
        
        // fetch multiple data from employees and payslip tables  
if (isset($_GET['date'])) {
    $date  = $_GET['date'];

    $selectQuery = "SELECT e.FullName, e.Email, e.Department, e.Designation,
        e.Salary, e.National_id, p.Date_issued, p.Food, p.Transport,
        p.Relief, p.total_allowance, p.PAYE, p.NHIF, p.NSSF,
        p.total_deductions, p.Net_pay FROM payslip p, employees e 
        WHERE e.id=p.emp_id AND p.Date_issued='$date'";
    $resultt = mysqli_query($conn, $selectQuery);
    if (mysqli_num_rows($resultt) > 0) {
        while($payslip = mysqli_fetch_assoc($resultt)) {
            // store the payslip data into an array

            $row_data=[
                'FullName'=>$payslip['FullName'],
                'Department'=>$payslip['Department'],
                'Designation'=>$payslip['Designation'],
                'ID_no'=> $payslip['National_id'],
                'Salary'=> $payslip['Salary'],
                'Email'=> $payslip['Email'],
                'Date_issued'=> $payslip['Date_issued'],
                'mode_of_pay'=> 'Bank Transfer',
                'Food'=> $payslip['Food'],
                'Transport'=> $payslip['Transport'],
                'Relief'=> $payslip['Relief'],
                'total_allowance'=> $payslip['total_allowance'],
                'Paye'=> $payslip['PAYE'],
                'nhif'=> $payslip['NHIF'],
                'nssf'=> $payslip['NSSF'],
                'total_deductions'=> $payslip['total_deductions'],
                'net_pay'=>$payslip['Net_pay']
            ];

        }
    }
}    

    class PDF extends FPDF
    {
        function Header(){
            
            //Display Company Info
            $this->SetFont('Arial','B',14);
            $this->Cell(50,10,"Red stone Enterprises",0,1);
            $this->SetFont('Arial','',14);
            $this->Cell(50,7,"Kimathi Street,",0,1);
            
            
            //Display INVOICE text
            $this->SetY(15);
            $this->SetX(-40);
            $this->SetFont('Arial','B',18);
            $this->Cell(50,10,"PAYSLIP",0,1);
            
            //Display Horizontal line
            $this->Line(0,48,210,48);
        }
        
        function body($row_data){
            
            //Name, dept and designation
            $this->SetY(55);
            $this->SetX(10);
            $this->SetFont('Arial','B',14);
            $this->Cell(50,10,"Emp Name : " .$row_data['FullName'],0,1);
            $this->Cell(50,10,"Department : ".$row_data['Department'],0,1);
            $this->Cell(50,10,"Designation : ".$row_data['Designation'],0,1);
            $this->Cell(50,10,"Date Issued : ".$row_data['Date_issued'],0,1);
                
            //id no
            $this->SetY(55);
            $this->SetX(-90);
            $this->Cell(50,10,"National Id : ".$row_data['ID_no'],0,1);
            
            //email
            $this->SetY(63);
            $this->SetX(-90);
            $this->Cell(50,10,"Email : ".$row_data['Email']);

            //mode of pay
            $this->SetY(71);
            $this->SetX(-90);
            $this->Cell(50,10,"Mode of Pay : ".$row_data['mode_of_pay']);

            
            //Display Salary before tax
            $this->SetY(89);
            $this->SetX(-80);
            $this->Cell(50,10,"Salary before tax : ".$row_data['Salary']);

            
            //Display Table headings
            $this->SetY(105);
            $this->SetX(10);
            $this->SetFont('Arial','B',14);
            $this->Cell(47.5,10,"Allowances",1,0,"C");
            $this->Cell(47.5,10,"Amount",1,0,"C");
            $this->Cell(47.5,10,"Deductions",1,0,"C");
            $this->Cell(47.5,10,"Amount",1,1,"C");

            $this->SetFont('Arial','',14);
            $this->Cell(47.5,10,"Food",1,0,"C");
            $this->Cell(47.5,10,$row_data['Food'],1,0,"C");
            $this->Cell(47.5,10,"PAYE",1,0,"C");
            $this->Cell(47.5,10,$row_data['Paye'],1,1,"C");

            $this->SetFont('Arial','',14);
            $this->Cell(47.5,10,"Transport",1,0,"C");
            $this->Cell(47.5,10,$row_data['Transport'],1,0,"C");
            $this->Cell(47.5,10,"NSSF",1,0,"C");
            $this->Cell(47.5,10,$row_data['nssf'],1,1,"C");

            $this->SetFont('Arial','',14);
            $this->Cell(47.5,10,"Relief",1,0,"C");
            $this->Cell(47.5,10,$row_data['Relief'],1,0,"C");
            $this->Cell(47.5,10,"NHIF",1,0,"C");
            $this->Cell(47.5,10,$row_data['nhif'],1,1,"C");

            $this->SetFont('Arial','',14);
            $this->Cell(47.5,10,"Total Allowance",1,0,"C");
            $this->Cell(47.5,10,$row_data['total_allowance'],1,0,"C");
            $this->Cell(47.5,10,"Total Deductions",1,0,"C");
            $this->Cell(47.5,10,$row_data['total_deductions'],1,1,"C");
            
            
            

            //Display table total row
            $this->SetFont('Arial','B',14);
            $this->Cell(150,9,"Net Pay (after tax)",1,0,"R");
            $this->Cell(40,9,$row_data['net_pay'],1,1,"R");
            
        }   
    }
    
    //Create A4 Page with Portrait 
    $fpdf = new PDF("P","mm","A4");
    $fpdf->AddPage();
    $fpdf->body($row_data);
    $fpdf->Output();
        ?>
            





    

    
    
   



    


