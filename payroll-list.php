<?php
require __DIR__ . "/config/database.php";
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                        <tr>
                            <td>
                            <?php
                            // Get the names as a dropdown list       
                            $sql = "SELECT * from employees";
                            $result =mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) :?>
                                    <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Name
                                    </button>
                                    <ul class="dropdown-menu">
                                    <?php while ($row = mysqli_fetch_assoc($result)) :?>
                                        <li><a href="payslip.php?id=<?php echo $row['id']?>" class="dropdown-item">
                                        <?php echo $row['FullName']?></a></li>
                                        <?php endwhile?>
                                    </ul>
                                </div> 
                                
                            <?php endif ?>                            
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>