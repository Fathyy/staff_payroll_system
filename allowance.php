<?php
require __DIR__ . '/includes/navbar.php';

require __DIR__ . "/config/database.php";
?>
<div class="container">
    <div class="row m-3">
        <div class="col-md-6 border" style="width:30%;">
            <form action="action.php" method="post" class="p-3">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="text" name="amount" id="amount" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" 
                    cols="15" rows="5"></textarea>
                </div>
                <button type="submit" id="submit" class="btn btn-primary btn-lg" name="allowance">Save</button>
            </form>
        </div>
        <div class="col-md-6 ms-4">
            <!-- display the allowance information on this side -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // display allowance from the db
                    $sql = "SELECT * FROM allowance";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) :
                        while ($row = mysqli_fetch_assoc($result)) :?>
                        <tr>
                            <td><?php echo $row['name']?></td>
                            <td><?php echo $row['Amount']?></td>
                    <!-- edit or delete actions for the allowance -->
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

<!-- Ajax code -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('#submit').submit(function(e){
            var formData = {
            name: $("#name").val(),
            amount: $("#amount").val(),
    };

    $.ajax({
        method: "POST",
        url: "action.php",
        data: formData,
        dataType: "json",
        encode: true,
    }).done(function(data){
        console.log(data);
    });
        e.preventDefault()
            });

    });
</script>