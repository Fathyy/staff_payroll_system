<?php
// The user should be logged in to access this page
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: login.php");
    exit;
}

require __DIR__ . '/includes/navbar.php';
require __DIR__ . '/includes/header.php';?>


<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <table class="table table-bordered table-hover table-responsive" style="width:80%;">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Department</th>
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

<!-- Ajax jquery cdn -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    // open the modal
    $(document).ready(function(){
        $(".btn").on('click', function(e){
            // prevent the form from submitting
            e.preventDefault();
            $("#myModal").modal('show');
        });
    });
</script>
<?php require __DIR__ . '/includes/footer.php';?>


