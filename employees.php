<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ed20622ed8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />   
</head>
<body>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card" style="width:80%;">
                    <div class="card-header">
                        <span><b>Employee List</b></span>
						<button class="btn btn-primary btn-sm btn-block col-md-3 float-end" type="button" id="new_attendance_btn">
                            <span class="fa fa-plus"></span> Add Attendance
                        </button>
                    </div>
                    <div class="card-body">
                    
                        <table  id="table" class="table table-bordered table-hover table-responsive">
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
                                                <a href="" class="btn"
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



<!-- modal to view user information -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="false" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">User details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h3></h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
    $('#table').DataTable();
} );
</script>

  

    
</body>
</html>










