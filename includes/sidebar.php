<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ed20622ed8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/sidebar.css">
  </head>
  <body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="bg-dark col-auto col-md-4 col-lg-2 p-0 min-vh-100 d-flex flex-column justify-content-between">
                <div class="bg-dark p-2">
                    <a href="#" class="d-flex text-decoration-none mt-1 align-items-center text-white">
                        <span class="fs-4 d-none d-sm-inline">Staff Payroll</span>
                    </a>
                    <ul class="nav nav-pills flex-column mt-4">
                        <li class="nav-item py-2 py-sm-0">
                            <a href="dashboard.php" class="nav-link text-white">
                            <i class="fa-solid fa-gauge"></i>
                                <span class="fs-4 d-none d-sm-inline ms-3">Dashboard</span>
                                </a>
                        </li>

                        <li class="nav-item py-2 py-sm-0">
                            <a href="viewDepartment.php" class="nav-link text-white">
                            <i class="fa-solid fa-building"></i> 
                                <span class="fs-4 d-none d-sm-inline ms-3">Department</span>
                                </a>
                        </li>

                        <li class="nav-item py-2 py-sm-0">
                            <a href="employees.php" class="nav-link text-white">
                            <i class="fa-solid fa-users"></i> 
                                <span class="fs-4 d-none d-sm-inline ms-3">Employees</span>
                                </a>
                        </li>

                        <li class="nav-item py-2 py-sm-0">
                            <a href="payslip.php" class="nav-link text-white">
                            <i class="fa-solid fa-receipt"></i> 
                                <span class="fs-4 d-none d-sm-inline ms-3">Payslip</span>
                                </a>
                        </li>
                    </ul>
                  </div>
                <div class="dropdown open p-3">
                    <button class="btn border-none dropdown-toggle text-white" type="button" id="triggerId" aria-expanded="false" data-bs-toggle="dropdown">
                        <i></i><span class="ms-2">Admin</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="triggerId">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>

            </div>

            <div class="content">
              <?php include 'navbar.php'?>
          </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
  </body>
</html>