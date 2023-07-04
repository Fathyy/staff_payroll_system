<?php

require __DIR__ . '/includes/navbar.php';

// inserting new allowance information into the db
require __DIR__ . "/config/database.php";
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO allowance(name, description)
    VALUES('$name', '$description')";
    $result = mysqli_query($conn, $sql);
}
?>
<div class="row mt-5">
    <div class="col-md-6">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" 
                cols="30" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="save">Save</button>
        </form>
    </div>
    <div class="col-md-6">
        <!-- display the allowance information on this side -->
        <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // display allowances from the db
    $sql = "SELECT * FROM allowance";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) :
        while ($row = mysqli_fetch_assoc($result)) :?>
        <tr>
            <td><?php echo $row['name']?></td>
        </tr> 
        
        <!-- edit or delete actions for the allowance -->
        <tr>
            <td>
                <!-- Edit -->
                <a href="#?id=<?php echo htmlspecialchars($row['id'])?>" 
                data-bs-toggle="tooltip" data-bs-title="Edit Record"><i class="fa-regular fa-pen-to-square"></i></a>

                <!-- Delete Record -->
                <a href="#?id=<?php echo htmlspecialchars($row['id'])?>"
                data-bs-toggle="tooltip" data-bs-title="Delete Record"><i class="fa-solid fa-trash"></i></a>

                <!-- View Record -->
                <a href="#?id=<?php echo htmlspecialchars($row['id'])?>"
                data-bs-toggle="tooltip" data-bs-title="View Record"><i class="fa-regular fa-eye"></i></a>
            </td>
        </tr>
        <?php endwhile ?>
    <?php endif ?>
  </tbody>
</table>

    </div>
</div>