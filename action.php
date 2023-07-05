<?php
session_start();
require __DIR__ . "/config/database.php";

if (isset($_POST['signup'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $error=[];

    if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($cpassword)) {
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
        # insert user into the DB
        $sql = "INSERT INTO users(fname, lname, email, password_hash) VALUES('$fname', '$lname', '$email', '$password_hash')";
        $result = mysqli_query($conn, $sql);
                header("Location: login.php");
                exit;
        // if (mysqli_num_rows($result) > 0) {
        //     if ($row = mysqli_fetch_assoc($result)) {
        //         // if the person has signed up, take them to the login page
                    
        //     }
            
        
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

    $sql = "SELECT * FROM users WHERE email ='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password_hash'])) {
                $id = $row['id'];
                $fname =$row['fname'];
                $role = $row['role'];

                $_SESSION['auth'] = array(
                    'id'=>$id,
                    'fname'=>$fname
                );
                $_SESSION['role'] = $role;
                if ($role == 1) {
                    header("Location: admin-index.php");
                    exit;
                }
                header("Location: index.php");
                exit;
            }
        } 
    }
    else {
        $_SESSION['error'] = "Invalid credentials!";
    }
}

// process the allowance form
elseif (isset($_POST['allowance'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO allowance(name, description)
    VALUES('$name', '$description')";
    $result = mysqli_query($conn, $sql);
        header("Location: admin-index.php");
        exit;
}

// process the expenses
elseif (isset($_POST['expenses'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO expenses(name, description)
    VALUES('$name', '$description')";
    $result = mysqli_query($conn, $sql);
        header("Location: admin-index.php");
        exit;
    
}
?>