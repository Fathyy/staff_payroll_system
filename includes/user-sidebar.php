<?php
include_once __DIR__ . "/header.php";?>
        <div class="row flex-nowrap">
            <div class="bg-dark col-auto col-md-4 col-lg-2 p-0 min-vh-100 d-flex flex-column justify-content-between">
                <div class="bg-dark p-2">
                    <a href="#" class="d-flex text-decoration-none mt-1 align-items-center text-white">
                        <span class="fs-4 d-none d-sm-inline ms-3">Staff Payroll</span>
                    </a>
                    <ul class="nav nav-pills flex-column mt-4">
                        <li class="nav-item py-2 py-sm-0">
                            <a href="index.php?page=home" class="nav-link text-white">
                            <i class="fa-solid fa-gauge"></i>
                                <span class="fs-4 d-none d-sm-inline ms-3">Home</span>
                                </a>
                        </li>

                        <li class="nav-item py-2 py-sm-0">
                            <a href="index.php?page=user-payslip" class="nav-link text-white">
                            <i class="fa-solid fa-receipt"></i> 
                                <span class="fs-4 d-none d-sm-inline ms-3">My Payslips</span>
                                </a>
                        </li>

                        <li class="nav-item py-2 py-sm-0">
                            <a href="index.php?page=user-account" class="nav-link text-white">
                            <i class="fa-solid fa-receipt"></i> 
                                <span class="fs-4 d-none d-sm-inline ms-3">My Account</span>
                                </a>
                        </li>
                    </ul>
                  </div>
                <div class="dropdown open p-3">
                    <button class="btn border-none dropdown-toggle text-white" type="button" id="triggerId" aria-expanded="false" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-user"></i><span class="ms-2">User</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="triggerId">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </div>

                
        </div>
    <?php include_once __DIR__ . "/footer.php";?>