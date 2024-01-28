<!--
=========================================================
* Material Dashboard 2 - v3.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<?php
include '../../includes/session.php';
// End Session 
include '../../includes/head.php';
?>
<head>
<style>
  .form-control {
    border: 1px solid #ddd;
    height: 50px;
  }
  .btn-search {
    height: 50px;
  }
</style>

</head>
<title>
    Alumni Form Lists
</title>

<body class="g-sidenav-show  bg-gray-200">

    <!-- sidebar -->
    <?php include "../../includes/sidebar.php" ?>
    <!-- End sidebar -->
 
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php include "../../includes/navbar.php" ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card px-4 pb-4">
                <h2 class="text-center mb-0 pt-4">Alumni Form List</h2>
                <!-- Search Bar -->
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form method="GET" class="form-horizontal">
                            <div class="input-group">
                                <input type="search" class="form-control form-control-lg"
                                placeholder="Search for Title, Author, Call Number..." name="search">

                                <button name="submit" type="submit" class="btn btn-lg btn-info btn-search">
                                <i class="fa fa-search"></i>
                                </button>
                                <button type="button" class="btn btn-lg btn-info mx-1" data-toggle="modal"
                                    data-target="#filter">
                                    <i class="fas fa-sliders-h"></i> Filter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <form method="POST" action="userData/ctrl-email.php">
                    <div class="d-flex">
                        <div class="dropdown pt-4">
                            <a href="javascript:;" class="btn btn-icon bg-gradient-primary "
                                data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                                <span class="material-icons">email</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                aria-labelledby="navbarDropdownMenuLink2" data-popper-placement="left-start">
                                <li><button type="submit" name="sendEmail"
                                        class="dropdown-item border-radius-md">Email All Alumni</button></li>
                            </ul>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="searchTable" class="table table-flush" style="width: 100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input mt-1" type="checkbox" value="all" name="all"
                                                id="all">
                                        </div>
                                    </th>
                                    <th>Image</th>
                                    <th>Student No.</th>
                                    <th>Fullname</th>
                                    <th>Batch</th>
                                    <th>Program</th>
                                    <th>Position</th>
                                    <th>Employment Status</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!-- Table Body Will Be Populated Dynamically -->
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

        <?php include "../../includes/footer.php" ?>
    </main>
    <?php include "../../includes/fixed-plugin.php" ?>
    <!--   Core JS Files   -->
    <?php include "../../includes/script.php" ?>


</body>

</html>