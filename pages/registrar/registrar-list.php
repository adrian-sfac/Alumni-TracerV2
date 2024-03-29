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
<title>
  Registrar Lists
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


            <h5 class="mb-0 pt-4">Registrar Lists</h5>

            <div class="table-responsive">
              <table class="table table-flush" id="datatable-search">
                <thead class="thead-light">
                  <tr>
                    <th>Image</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $listregistrar = mysqli_query($db, "SELECT * FROM tbl_registrar");
                  while ($row = mysqli_fetch_array($listregistrar)) {
                    $id = $row['reg_id'];
                  ?>
                    <tr>
                      <td><?php if (empty($row['img'])) {
                            echo '<img class="border-radius-lg shadow-sm zoom" style="height:80px; width:80px;" src="../../assets/img/image.png"/>';
                          } else {
                            echo ' <img class=" border-radius-lg shadow-sm zoom" style="height:80px; width:80px;" src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" "/>';
                          } ?></td>
                      <td class="text-sm font-weight-normal"><?php echo $row['firstname']; ?></td>
                      <td class="text-sm font-weight-normal"><?php echo $row['lastname']; ?></td>
                      <td class="text-sm font-weight-normal"><?php echo $row['email']; ?></td>
                      <td class="text-sm font-weight-normal"><?php echo $row['username']; ?></td>
                      <td class="text-sm font-weight-normal">
                        <a class="btn btn-link text-danger text-gradient px-3 mb-0"  data-bs-toggle="modal" data-bs-target="#deleteReg<?php echo $id; ?>"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                      </td>
                    </tr>
                    <div class="modal fade" id="deleteReg<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">

                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="py-3 text-center">
                              <i class="fas fa-trash-alt text-9xl"></i>
                              <h4 class="text-gradient text-danger mt-4">
                                Delete Account!</h4>
                              <p>Are you sure you want to delete
                                <br>
                                <i><b><?php echo $row['firstname']; ?></b></i>?
                              </p>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="userData/ctrl-del-reg.php?reg_id=<?php echo $id; ?>"><button type="button" class="btn bg-gradient-danger" >Delete</button></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </tbody>
              </table>
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