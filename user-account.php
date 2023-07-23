<?php 
include_once __DIR__ . "/includes/header.php";
require __DIR__ . "/config/database.php";
// update employee details
if (isset($_SESSION['auth'])) :
    $user_id = $_SESSION['auth']['id'];


    if (isset($_POST['update'])) {
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $department = $_POST['department'];
        $designation = $_POST['designation'];
        $salary = $_POST['salary'];
        $nat_id = $_POST['nat_id'];
        $nhif = $_POST['nhif'];
        $nssf = $_POST['nssf'];

        $query = "UPDATE employees SET FullName = '$fullName', Email ='$email',
        Gender ='$gender', Department ='$department', Designation ='$designation', 
        Salary ='$salary', National_id ='$nat_id', 
        Nhif_no ='$nhif', Nssf_no ='$nssf' WHERE id='$user_id'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $_SESSION['update_success'] ="Details updated successfully";
        }
    }

    ?>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Complete your profile</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        
                            // Get existing user details such as Name and Email
                            $sql = "SELECT * FROM employees WHERE id ='$user_id'";
                            $result =mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) :
                                $row = mysqli_fetch_assoc($result);
                                if ($row) :?>
                                <form method="POST" action="">
                                    <div class="row">
                                        <!-- Full name -->
                                        <div class="mb-3">
                                            <label for="fullName" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="fullName" name="fullName"
                                            value="<?php echo $row['FullName'] ?? ""?>">
                                        </div>
                    
                                        <!-- email -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email" name="email"
                                            value="<?php echo $row['Email'] ?? ""?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Gender -->
                                        <div class="mb-3 col-md-4 form-check">Choose your gender
                                            <label for="male" style="display: block;">
                                            <input type="radio" name="gender" id="male" value="Male"
                                            value="<?php echo $row['Gender'] ?? ""?>">
                                            Male
                                            </label>

                                            <label for="female" style="display: block;">
                                            <input type="radio" name="gender" id="female" value="Female"
                                            value="<?php echo $row['Gender'] ?? ""?>">
                                            Female
                                            </label>     
                                        </div>

                                        <!-- department -->
                                        <div class="col-md-4">
                                            <select name="department" class="form-select">
                                                <option selected>Select Department</option>
                                                <?php
                                                $dept = "SELECT * FROM department ORDER BY Name asc";
                                                $rresult = mysqli_query($conn, $dept);
                                                if (mysqli_num_rows($rresult) > 0) :
                                                    while ($roww = mysqli_fetch_assoc($rresult)) :?>
                                                        <option value="<?php echo $roww['Name']?>">
                                                            <?php echo $roww['Name']?>
                                                        </option>
                                                    <?php endwhile?>
                                                    <?php endif?>
                                            </select>
                                        </div>

                                        <!-- designation -->
                                        <div class="mb-3 col-md-4">
                                            <label for="designation" class="form-label">Designation</label>
                                            <input type="text" class="form-control" name="designation" id="designation"
                                            value="<?php echo $row['Designation'] ?? ""?>">
                                        </div>
                                    </div>


                                    <div class="row">
                                        <!-- Salary -->
                                        <div class="col-md-4 mb-3">
                                            <label for="salary" class="form-label">Salary</label>
                                            <input type="text" class="form-control" id="salary" name="salary"
                                            value="<?php echo $row['Salary'] ?? ""?>">
                                        </div>
                                        <!-- National Id -->
                                        <div class="col-md-4 mb-3">
                                            <label for="nat_id" class="form-label">National Id</label>
                                            <input type="text" class="form-control" id="nat_id" name="nat_id"
                                            value="<?php echo $row['National_id'] ?? ""?>">
                                        </div>

                                        <!-- NHIF -->
                                        <div class="col-md-4 mb-3">
                                            <label for="nhif" class="form-label">NHIF No</label>
                                            <input type="text" class="form-control" id="nhif" name="nhif"
                                            value="<?php echo $row['Nhif_no'] ?? ""?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- NSSF -->
                                        <div class="mb-3 col-md-6">
                                            <label for="nssf" class="form-label">NSSF no</label>
                                            <input type="text" class="form-control" id="nssf" name="nssf"
                                            value="<?php echo $row['Nssf_no'] ?? ""?>">
                                        </div>
                                        
                                        <div class="mb-3 col-md-6">
                                            <label for="update" class="form-label">Submit below</label>
                                            <button type="submit" class="btn btn-primary" name="update">Update details</button>
                                        </div>
                                    </div>                  
                                </form>
                                    
                                <?php endif ?>
                            <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif?>

<?php include_once __DIR__ . "/includes/footer.php";?>
<script>
    <?php 
    if (isset($_SESSION['update_success'])) :?>
        alertify.set('notifier','position', 'top-right');
        alertify.success('<?php echo $_SESSION['update_success']?>');

        unset($_SESSION['update_success']);
    <?php endif ?>
    
</script>