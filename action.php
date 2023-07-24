<?php
session_start();
require __DIR__ . "/config/database.php";

if (isset($_POST['signup'])) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $error=[];

    if (empty($fullName) || empty($email) || empty($password) || empty($cpassword)) {
        $_SESSION['error'] = "This field cannot be empty";
    }

    $sanitisedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ($sanitisedEmail) {
        $validatedEmail = filter_var($sanitisedEmail, FILTER_VALIDATE_EMAIL);
        if ($validatedEmail == false) {
            $error['email'] = "Incorrect email format";
        }
    }

    // check if the password contains 8 characters and has letters and numbers.
    if (! preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{8,}$/',$_POST["password"])) {
        $error['password'] = "Password must contain numbers and letters and must be at least 8 characters long!";
    }
    if ($password !== $cpassword) {
        $error['cpassword'] ="Passwords should match";
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    if (count($error) === 0) {
        # if there is no error, insert user into the DB
        $sql = "INSERT INTO employees(FullName, Email, password_hash) VALUES('$fullName', '$email', '$password_hash')";
        $result = mysqli_query($conn, $sql);
                header("Location: login.php");
                exit;
    }
    else{
        // stay in the signup page if there are errors
        $_SESSION['errors'] = $error;
        header("Location: signup.php");
        exit;

    }
}

// process the login form now
elseif (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM employees WHERE Email ='$email'";
    $result = mysqli_query($conn, $sql);
    // if user exists in the database
    if (mysqli_num_rows($result) > 0) {
        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password_hash'])) {
                $id = $row['id'];
                $fname =$row['FullName'];
                $role = $row['role'];

                $_SESSION['auth'] = array(
                    'id'=>$id,
                    'fname'=>$fname
                );
                // if the role is 1, that's an admin 
                $_SESSION['role'] = $role;
                if ($role == 1) {
                    header("Location: admin-index.php");
                    exit;
                }
                // otherwise take to user homepage
                header("Location: index.php");
                exit;
            }
        } 
    }
    // if user is not found in the database
    else {
        $_SESSION['error'] = "User not found!";
        header("Location: login.php");
        exit;

    }
}

//process the allowance form
else if(isset($_POST['save_allowance']))
{
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);

    if($name == NULL || $amount == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'This field is mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $sql = "INSERT INTO allowance(name, Amount)
    VALUES('$name', '$amount')";
    $result = mysqli_query($conn, $sql);

    if($result)
    {
        $res = [
            'status' => 200,
            'message' => 'Allowance Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Allowance Not Created'
        ];
        echo json_encode($res);
        return;
    }
}

// delete an allowance
else if(isset($_POST['delete_allowance']))
{
    $allowance_id = mysqli_real_escape_string($conn, $_POST['allowance_id']);

    $query = "DELETE FROM allowance WHERE id='$allowance_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Allowance Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Allowance Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}


// process a deduction
else if(isset($_POST['save_deduction']))
{
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);

    if($name == NULL || $amount == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'This field is mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $sql = "INSERT INTO deductions(name, Amount)
    VALUES('$name', '$amount')";
    $result = mysqli_query($conn, $sql);

    if($result)
    {
        $res = [
            'status' => 200,
            'message' => 'Deduction Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Deduction Not Created'
        ];
        echo json_encode($res);
        return;
    }
}

// delete a deduction
else if(isset($_POST['delete_deduction']))
{
    $deduction_id = mysqli_real_escape_string($conn, $_POST['deduction_id']);

    $query = "DELETE FROM deductions WHERE id='$deduction_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'deduction Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'deduction Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
?>