<?php
include_once __DIR__ . "/includes/header.php";
?>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card" style="width:80%;">
                    <div class="card-header">
                        <span><b>Employee List</b></span>
						<button class="btn btn-primary btn-sm col-md-3 float-end" type="button" id="new_attendance_btn">
                            <span class="fa fa-plus"></span> Add Attendance
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="table" class="table table-bordered table-hover table-responsive">
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
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Salary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require __DIR__ . "/config/database.php";
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
<script type="text/javascript">
    $(document).ready( function () {
    $('#table').DataTable();
} );
</script>










