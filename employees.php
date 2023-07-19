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
                
                <input type="hidden" name="employee_id" id="employee_id" >
                
                <div class="mb-3">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" class="form-control" id="name"/>
                </div>
                <div class="mb-3">
                    <label for="department">Department</label>
                 <!-- select relevant department from the database -->
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

<!-- Update employee modal -->
<div class="modal fade" id="employeeEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateEmployee">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="employee_id" id="employee_id" >

                <div class="mb-3">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" class="form-control" id="name"/>
                </div>
                <div class="mb-3">
                    <label for="department">Department</label>
                 <!-- select relevant department from the database -->
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
                <button type="submit" class="btn btn-primary">Update Employee</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- View employee Modal -->
<div class="modal fade" id="employeeViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Employee</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="">Full Name</label>
                    <p id="view_fname" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Department</label>
                    <p id="view_department" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Designation</label>
                    <p id="view_designation" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Salary</label>
                    <p id="view_salary" class="form-control"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Employee List
                        <button class="btn btn-primary float-end w-auto" type="button"
                        data-bs-toggle="modal" data-bs-target="#employeeAddModal">
                            <span class="fa fa-plus"></span> Add Employee
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
                                        <td><?php echo $row['FullName']?></td> 
                                        <td><?php echo $row['Department']?></td>
                                        <td><?php echo $row['Designation']?></td>
                                        <td><?php echo $row['Salary']?></td> 
                                        <td>
                                            <center>
                                            <!-- Edit -->
                                            <button class="editEmployeeBtn btn btn-sm btn-outline-primary w-auto" type="button"
                                            value="<?php $row['id']?>">
                                            <i class="fa-regular fa-pen-to-square"></i></button>

                                            <!-- View Employee -->
                                            <button class="viewEmployeeBtn btn btn-sm btn-outline-warning w-auto" type="button"
                                            value="<?php $row['id']?>">
                                            <i class="fa-regular fa-eye"></i></button>

                                            <!-- Delete Employee -->
                                            <button class="deleteEmployeeBtn btn btn-sm btn-outline-danger w-auto" type="button"
                                            value="<?php $row['id']?>">
                                            <i class="fa-solid fa-trash"></i></button>
                                            </center>
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
    // create employee
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

        // view employee details
        $(document).on('click', '.viewEmployeeBtn', function () {
            var employee_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "code.php?employee_id=" + employee_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#view_fname').text(res.data.FullName);
                        $('#view_department').text(res.data.Department);
                        $('#view_designation').text(res.data.Designation);
                        $('#view_salary').text(res.data.Salary);
                        

                        $('#employeeViewModal').modal('show');
                    }
                }
            });
        });

        // update employee details
        $(document).on('click', '.editEmployeeBtn', function () {

            var employee_id = $(this).val();

            $.ajax({
                type: "GET",
                url: "code.php?employee_id=" + employee_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {
                        alert(res.message);
                    }
                    else if(res.status == 200){

                        $('#employee_id').val(res.data.id);
                        $('#name').val(res.data.FullName);
                        $('#department').val(res.data.Department);
                        $('#designation').val(res.data.Designation);
                        $('#salary').val(res.data.Salary);

                        $('#employeeEditModal').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateEmployee', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_employee", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                        
                        $('#employeeEditModal').modal('hide');
                        $('#updateEmployee')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        // delete employee
        $(document).on('click', '.deleteEmployeeBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this employee?'))
            {
                var employee_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_employee': true,
                        'employee_id': employee_id
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if(res.status == 500) {

                            alert(res.message);
                        }else{
                            alertify.set('notifier','position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable').load(location.href + " #myTable");
                        }
                    }
                });
            }
        });
</script>











