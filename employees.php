<?php
include_once __DIR__ . "/includes/header.php";

require __DIR__ . "/config/database.php";
?>
<!-- Add new employee modal -->
<div class="modal fade" id="employeeAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="saveEmployee">
            <div class="modal-body">

                <div id="empErrorMessage" class="alert alert-warning d-none"></div>
                
                <!-- <input type="hidden" name="employee_id" id="employee_id" > -->
                
                <div class="mb-3">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" class="form-control" id="name"/>
                </div>
                <div class="mb-3">
                    <label for="department">Department</label>
                 <!-- select relevant department from the database -->
                 <select name="department" id="department">
                    <option value=""></option>
                    <?php
                    $dept = "SELECT * FROM department ORDER BY Name asc";
                    $result = mysqli_query($conn, $dept);
                    if (mysqli_num_rows($result) > 0) :
                        while ($row = mysqli_fetch_assoc($result)) :?>
                            <option value="<?php echo $row['id']?>"
                                <?php echo isset($department_id) && $department_id == $row['id'] ? 'selected' : ""?>>
                                <?php echo $row['Name']?>
                            </option>
                        <?php endwhile?>
                    <?php endif?>
                    
                 </select>
                </div>
                <div class="mb-3">
                    <label for="designation">Designation</label>
                    <input type="text" name="designation" class="form-control" id="designation"/>
                </div>
                <div class="mb-3">
                    <label for="salary">Salary</label>
                    <input type="text" name="salary" class="form-control" id="salary"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create employee</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Add new employee modal -->


<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Employee List
                        <button class="btn btn-primary float-end" type="button"
                        data-bs-toggle="modal" data-bs-target="#employeeAddModal">
                            <span class="fa fa-plus"></span> Add Attendance
                        </button>
                    </h4>
                    
                </div>
                <div class="card-body">
                    <table id="myTable" class="table table-bordered table-hover table-responsive">
                        <colgroup>
                            <col width="20%">
                            <col width="20%">
                            <col width="20%">
                            <col width="20%">
                            <col width="20%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>employee</th>
                                <th>Designation</th>
                                <th>Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM employees";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) :
                                while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <td><?php echo $row['Full Name']?></td> 
                                        <td><?php echo $row['Department']?></td>
                                        <td><?php echo $row['Designation']?></td>
                                        <td><?php echo $row['Salary']?></td> 
                                        <td>
                                            <!-- Edit -->
                                            <a href="#?id=<?php echo htmlspecialchars($row['id'])?>" 
                                            data-bs-toggle="tooltip" data-bs-title="Edit Record">
                                            <i class="fa-regular fa-pen-to-square"></i></a>

                                            <!-- Delete Record -->
                                            <a href="#?id=<?php echo htmlspecialchars($row['id'])?>"
                                            data-bs-toggle="tooltip" data-bs-title="Delete Record">
                                            <i class="fa-solid fa-trash"></i></a>

                                            <!-- the view link below shows a tooltip and opens a modal to show user details -->
                                            <!-- View Record -->
                                            <a href=""
                                            data-bs-toggle="tooltip" data-bs-title="View Record" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="fa-regular fa-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php endwhile ?>
                            <?php endif?>
                        </tbody>
                    </table>
        
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . "/includes/footer.php";?>
<script>
    $(document).on('submit', '#saveEmployee', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_employee", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#empErrorMessage').removeClass('d-none');
                        $('#empErrorMessage').text(res.message);

                    }else if(res.status == 200){

                        $('#empErrorMessage').addClass('d-none');
                        $('#employeeAddModal').modal('hide');
                        $('#saveEmployee')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });
</script>











