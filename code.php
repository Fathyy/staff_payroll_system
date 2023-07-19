<?php
require __DIR__ . "/config/database.php";
//Process the form to create a department
if(isset($_POST['save_department']))
{
    $name = mysqli_real_escape_string($conn, $_POST['name']);


    if($name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'This field is mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO department (name) VALUES ('$name')";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Department Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Department Not Created'
        ];
        echo json_encode($res);
        return;
    }
}

// delete the department
if(isset($_POST['delete_department']))
{
    $department_id = mysqli_real_escape_string($conn, $_POST['department_id']);

    $query = "DELETE FROM department WHERE id='$department_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'department Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'department Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}


// create employee
if(isset($_POST['save_employee']))
{
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $department = $_POST['department'];
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);


    if($name == NULL || $department == NULL || $designation == NULL
    || $salary == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'This field is mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO employees(FullName, Department, Designation, Salary) 
    VALUES('$name', '$department', '$designation', '$salary')";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Employee Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Employee Not Created'
        ];
        echo json_encode($res);
        return;
    }
}

// view employee details
if(isset($_GET['employee_id']))
{
    $employee_id = mysqli_real_escape_string($conn, $_GET['employee_id']);

    $query = "SELECT * FROM employees WHERE id='$employee_id'";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $employee = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'employee Fetch Successfully by id',
            'data' => $employee
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'employee Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

// Update employee details
if(isset($_POST['update_employee']))
{
    $employee_id = mysqli_real_escape_string($conn, $_POST['employee_id']);

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $department = $_POST['department'];
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);

    if($name == NULL || $department == NULL || $designation == NULL
    || $salary == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE employees SET FullName='$fname', Department='$department', Designation='$designation', 
    Salary='$salary' 
                WHERE id='$employee_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Employee Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Employee Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}

// delete employee
if(isset($_POST['delete_employee']))
{
    $employee_id = mysqli_real_escape_string($conn, $_POST['employee_id']);

    $query = "DELETE FROM employees WHERE id='$employee_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'employee Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'employee Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}


?>