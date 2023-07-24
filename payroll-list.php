<?php
require __DIR__ . "/config/database.php";
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Generate Payslip for employee</h4>
                </div>
                <div class="card-body">
                    <form action="payslip.php" method="post" class="row">
                        <div class="mb-3 col-md-4">
                        <select name="employee_list" class="form-select" aria-label="Default select example">
                            <option selected>Select Employee</option>
                            <?php 
                            // Choose employee to process his/her payslip   
                            $sql = "SELECT * from employees";
                            $result =mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) :
                                while ($row = mysqli_fetch_assoc($result)) :?>
                                    <option value="<?php echo $row['FullName']?>">
                                        <?php echo $row['FullName']?>
                                    </option>
                                <?php endwhile?>
                            <?php endif ?>
                        </select> 
                        </div>

                        <!--date  -->
                        <div class="mb-3 col-md-4">
                            <label for="date">Issued Date</label>
                            <input type="date" name="date" id="date">
                        </div>

                        <div class="mb-3 col-md-4">
                            <!-- generate payslip button -->
                            <input type="submit" value="Generate payslip" name="payslip" class="btn btn-warning col-12">
                        </div>    
                    </form>    
                </div>           
            </div>
        </div>
    </div>
</div>