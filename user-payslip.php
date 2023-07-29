<!-- display the user payslips here -->
<?php

require __DIR__ . "/config/database.php";

if (isset($_SESSION['auth'])) :
    $user_id = $_SESSION['auth']['id'];
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>My Payslips</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Date issued (mm-dd-yy)</th>
                                <th>View Payslip</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            // get the payslip based on unique session id
                            $sql ="SELECT * FROM payslip WHERE emp_id ='$user_id'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) :
                                while ($row = mysqli_fetch_assoc($result)) :
                                    $date = $row['Date_issued'];
                                ?>
                            <tr>
                                <td><?php echo $date?></td>
                                <td><a href="individual-payslip.php?id=<?php echo $user_id?>&date=<?php echo $date?>"
                                class="btn btn-warning w-auto">View Payslip</a></td>
                            </tr>
                            <?php endwhile?>
                            <?php endif?>
                            
                        </tbody>
                    </table>
                </div>           
            </div>
        </div>
    </div>
</div>
<?php endif?>