<?php require __DIR__ . '/header.php';?>
    <div class="container-fluid">
        <div class="row flex-nowrap" style="overflow-x:hidden;">
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
    <?php require __DIR__ . '/footer.php';?>