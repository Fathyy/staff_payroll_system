<?php include_once __DIR__ . "/includes/header.php";
require __DIR__ . "/config/database.php";

?>

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3>Complete your profile</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="action.php">
                    <div class="row">
                        <!-- Gender -->
                        <div class="mb-3 col-md-6">Choose your gender
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
                        <div class="col-md-6">
                            <select name="department" id="department">
                                <option value="">Select Department</option>
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
                    </div>

                    <!-- designation -->
                    <div class="mb-3">
                        <label for="designation" class="form-label">Designation</label>
                        <input type="text" class="form-control" id="designation">
                    </div>

                    <!-- Salary -->
                    <div class="mb-3">
                        <label for="salary" class="form-label">Salary</label>
                        <input type="text" class="form-control" id="salary">
                    </div>

                    <!-- National Id -->
                    <div class="mb-3">
                        <label for="nat_id" class="form-label">National Id</label>
                        <input type="text" class="form-control" id="nat_id">
                    </div>

                    <!-- NHIF -->
                    <div class="mb-3">
                        <label for="nhif" class="form-label">NHIF No</label>
                        <input type="text" class="form-control" id="nhif">
                    </div>

                    <!-- NSSF -->
                    <div class="mb-3">
                        <label for="nssf" class="form-label">NSSF no</label>
                        <input type="text" class="form-control" id="nssf">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . "/includes/footer.php";?>