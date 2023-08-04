<?php
include_once __DIR__ . "/includes/header.php";
require __DIR__ . "/config/database.php";
?>

<style>
    <?php include "css/style.css"?>
</style>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Employee Deductions</h4>
                </div>

                <div class="card-body d-sm-block d-flex justify-content-between">
                    <!-- form to create deduction -->
                    <div class="col-md-6 border inner-one">
                        <form action="action.php" method="post" class="p-3" id="deductionsForm">
                        <input type="hidden" name="deduction_id" id="deduction_id">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="text" name="amount" id="amount" class="form-control">
                            </div>

                            <button type="submit" id="submit" class="btn btn-primary btn-lg">Create deduction</button>
                        </form>
                    </div>

                    <div class="col-md-6 inner-one--lesser">
                        <!-- display the deductions information on this side -->
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // display deductions from the db
                                $sql = "SELECT * FROM deductions";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) :
                                    while ($row = mysqli_fetch_assoc($result)) :?>
                                    <tr>
                                        <td><?php echo $row['name']?></td>
                                        <td><?php echo $row['Amount']?></td>
                                        <!-- edit or delete actions for the deductions -->
                                        <td>
                                            <!-- Delete deduction -->
                                            <button class="deleteDeductionBtn btn btn-sm btn-outline-danger w-auto" type="button"
                                            value="<?php echo $row['id']?>">
                                            <i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                        <?php endwhile ?>
                                    <?php endif ?>
                            </tbody>
                        </table>

                    </div>

                </div>

                
            </div>
        </div>
        
        
    </div>
</div>

<?php include_once __DIR__ . "/includes/footer.php"?>
<script>
    $(document).on('submit', '#deductionsForm', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_deduction", true);

            $.ajax({
                type: "POST",
                url: "action.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#empErrorMessage').text(res.message);

                    }else if(res.status == 200){
                        $('#deductionsForm')[0].reset();
                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        // delete the deduction
        $(document).on('click', '.deleteDeductionBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this deduction?'))
            {
                var deduction_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: {
                        'delete_deduction': true,
                        'deduction_id': deduction_id
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