<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']); 

    if (!$name) {
        echo "This field cannot be empty";  
    }

    require_once __DIR__ . '/config/database.php';
    
        // inserting new user to DB query
        $query = "INSERT INTO department (Name) VALUES()";
        $stmt = $dbh->prepare("INSERT INTO department(Name)
        VALUES(?)"); 
        $stmt->bindParam(1, $name, PDO::PARAM_STR); 
        $stmt->execute();
        $lastInsertId=$dbh->lastInsertId();
            if ($lastInsertId){
                echo "Department successfully created";
            }
   }

?>
<?php require_once __DIR__ . '/includes/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <h4 class="float-start">Profile create page</h4>
            <a href="index.php" class="float-end btn btn-primary">Back</a>
        </div>

        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
</div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'?>