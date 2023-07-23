<?php 
session_start();
include_once __DIR__ . "/includes/header.php";
require __DIR__ . "/config/database.php";

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
                    if (isset($_SESSION['auth'])) :
                        $user_id = $_SESSION['auth']['id'];
                    
                        // Get existing user details such as Name and Email
                        $sql = "SELECT * FROM employees WHERE id ='$user_id'";
                        $result =mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) :
                            $row = mysqli_fetch_assoc($result);
                            if ($row) :?>
                            <form method="POST" action="action.php">
                                <div class="row">
                                    <!-- Full name -->
                                    <div class="mb-3">
                                        <label for="fullName" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="fullName" name="fullName"
                                        value="<?php echo $result['FullName'] ?? ""?>">
                                    </div>
                
                                    <!-- email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                        value="<?php echo $result['Email'] ?? ""?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Gender -->
                                    <div class="mb-3 col-md-4 form-check">Choose your gender
                                        <label for="male" style="display: block;">
                                        <input type="radio" name="gender" id="male" value="Male"/>
                                        Male
                                        </label>

                                        <label for="female" style="display: block;">
                                        <input type="radio" name="gender" id="female" value="Female"/>
                                        Female
                                        </label>     
                                    </div>

                                    <!-- department -->
                                    <div class="col-md-4">
                                        <select name="department" class="form-select">
                                            <option selected>Select Department</option>
                                            <?php
                                            $dept = "SELECT * FROM department ORDER BY Name asc";
                                            $result = mysqli_query($conn, $dept);
                                            if (mysqli_num_rows($result) > 0) :
                                                while ($row = mysqli_fetch_assoc($result)) :?>
                                                    <option value="<?php echo $row['Name']?>">
                                                        <?php echo $row['Name']?>
                                                    </option>
                                                <?php endwhile?>
                                                <?php endif?>
                                        </select>
                                    </div>

                                    <!-- designation -->
                                    <div class="mb-3 col-md-4">
                                        <label for="designation" class="form-label">Designation</label>
                                        <input type="text" class="form-control" id="designation">
                                    </div>
                                </div>


                                <div class="row">
                                    <!-- Salary -->
                                    <div class="col-md-4 mb-3">
                                        <label for="salary" class="form-label">Salary</label>
                                        <input type="text" class="form-control" id="salary">
                                    </div>
                                    <!-- National Id -->
                                    <div class="col-md-4 mb-3">
                                        <label for="nat_id" class="form-label">National Id</label>
                                        <input type="text" class="form-control" id="nat_id">
                                    </div>

                                    <!-- NHIF -->
                                    <div class="col-md-4 mb-3">
                                        <label for="nhif" class="form-label">NHIF No</label>
                                        <input type="text" class="form-control" id="nhif">
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- NSSF -->
                                    <div class="mb-3 col-md-6">
                                        <label for="nssf" class="form-label">NSSF no</label>
                                        <input type="text" class="form-control" id="nssf">
                                    </div>
                                    
                                    <div class="mb-3 col-md-6">
                                        <label for="update" class="form-label">Submit below</label>
                                        <button type="submit" class="btn btn-primary" id="update">Update details</button>
                                    </div>
                                </div>                  
                            </form>
                                
                            <?php endif ?>
                        <?php endif ?>
                    <?php endif ?>


        
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . "/includes/footer.php";?>