<?php
require __DIR__ . '/includes/navbar.php';?>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <table class="table table-bordered table-hover" style="width:80%;">
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
                                    <!-- Edit -->
                                    <a href="#?id=<?php echo htmlspecialchars($row['id'])?>" 
                                    data-bs-toggle="tooltip" data-bs-title="Edit Record"><i class="fa-regular fa-pen-to-square"></i></a>

                                    <!-- Delete Record -->
                                    <a href="#?id=<?php echo htmlspecialchars($row['id'])?>"
                                    data-bs-toggle="tooltip" data-bs-title="Delete Record"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    <?php endif?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    
