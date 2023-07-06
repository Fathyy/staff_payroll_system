<?php
// The user should be logged in to access this page
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: login.php");
    exit;
}
require __DIR__ . '/includes/navbar.php';

require __DIR__ . "/config/database.php";
?>
<div class="container">
    <div class="row m-3">
        <div class="col-md-6" style="width:30%; border:1px solid black">
            <form action="action.php" method="post" class="p-3">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" 
                    cols="15" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg" name="expenses">Save</button>
            </form>
        </div>
        <div class="col-md-6 ms-4">
            <!-- display the expenses information on this side -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // display expenses from the db
                    $sql = "SELECT * FROM expenses";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) :
                        while ($row = mysqli_fetch_assoc($result)) :?>
                        <tr>
                            <td><?php echo $row['name']?></td>
                    <!-- edit or delete actions for the expenses -->
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
</div>