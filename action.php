<?php
session_start();
require __DIR__ . "/config/database.php";

if (isset($_POST['signup'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($cpassword)) {
        $_SESSION['error'] = "This field cannot be empty";
    }

    $sanitisedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ($sanitisedEmail) {
        $validatedEmail = filter_var($sanitisedEmail, FILTER_VALIDATE_EMAIL);
        if ($validatedEmail == false) {
            $_SESSION['error'] = "Incorrect email format";
        }
    }

    // check if the password contains 8 characters and has letters and numbers.
    if (! preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{8,}$/',$_POST["password"])) {
        $_SESSION['error'] = "Password must contain numbers and letters and must be at least 8 characters long!";
    }
    if ($password !== $cpassword) {
        $_SESSION['error'] ="Passwords should match";
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    if (empty($_SESSION['error'])) {
        # insert user into the DB
        $sql = "INSERT INTO admin(fname, lname, email, password_hash) VALUES('$fname', '$lname', '$email', '$password_hash')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: index.php");
            exit;
        }
        else {
            echo "There was an error signing up";
        }
    }
}

// process the login form now
elseif (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE email ='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password_hash'])) {
                $id = $row['id'];
                $fname =$row['fname'];

                $_SESSION['auth'] = array(
                    'id'=>$id,
                    'fname'=>$fname
                );
                header("Location: index.php");
                exit;
            }
        } 
    }
    // else {
    //     "Email is not found";
    // }
}
?>