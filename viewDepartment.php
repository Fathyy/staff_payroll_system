<?php include_once __DIR__ . "/includes/header.php";?>
<!-- Add new department modal -->
<div class="modal fade" id="departmentAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="saveDepartment">
            <div class="modal-body">

                <div id="deptErrorMessage" class="alert alert-warning d-none"></div>
                
                <input type="hidden" name="department_id" id="department_id" >
                
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create Department</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Add new department modal -->


<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Department List
                        <button class="btn btn-primary float-end" type="button"
                        data-bs-toggle="modal" data-bs-target="#departmentAddModal">
                            <span class="fa fa-plus"></span> Add Department
                        </button>
                    </h4>
                    
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require __DIR__ . "/config/database.php";
                            $sql = "SELECT * FROM department";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) :
                                while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <td><?php echo $row['Name']?></td> 
                                        <td>
                                            <!-- Delete Record -->
                                            <!-- <a href="#"
                                            data-bs-toggle="tooltip" data-bs-title="Delete Record"><i class="fa-solid fa-trash"></i></a> -->
                                            <button type="button" value="<?=$row['id'];?>" class="deleteStudentBtn btn btn-danger btn-sm">Delete</button>
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
<?php include_once __DIR__ . "/includes/footer.php";?>
<script>
   $(document).on('submit', '#saveDepartment', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_department", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#deptErrorMessage').removeClass('d-none');
                        $('#deptErrorMessage').text(res.message);

                    }else if(res.status == 200){

                        $('#deptErrorMessage').addClass('d-none');
                        $('#departmentAddModal').modal('hide');
                        $('#saveDepartment')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        }); 

        // delete the department
        $(document).on('click', '.deleteStudentBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
                var department_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_department': true,
                        'department_id': department_id
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
    
