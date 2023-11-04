<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="./images/favicon.png" type="image/png" sizes="16x16">
<title>Discussion Forum</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="main.js"></script>
</head>

<?php
include '../../includes/session.php';
// End Session
include '../../includes/head.php';
?>

<body class="g-sidenav-show  bg-gray-200">
  
<?php include "../../includes/sidebar.php"?>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
<?php if ($_SESSION['role'] == "Super Administrator") { ?>
<div id="ReplyModal" class="modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" style="border: 1px solid black; height: 35px; border-radius: 10px; padding: 5px;" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reply Question</h4>
      </div>
      <div class="modal-body">
        <form name="frm1" method="post">
            <input type="hidden" id="commentid" name="Rcommentid">
        	<div class="form-group">
        	  <label for="usr">Write your name:</label>
        	  <input type="text" class="form-control" style="border: 1px solid black; border-radius: 10px; padding: 10px; margin-bottom: 10px;" name="Rname" required>
        	</div>
            <div class="form-group">
              <label for="comment">Write your reply:</label>
              <textarea class="form-control" style="border: 1px solid black; border-radius: 10px; padding: 10px; margin-bottom: 25px;" rows="5" name="Rmsg" required></textarea>
            </div>
        	 <input type="button" id="btnreply" name="btnreply" class="btn btn-dark" value="Reply">
      </form>
      </div>
    </div>

  </div>
</div>
</div>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0 text-white">Discussion Forum</h3>
        </div>
        <div class="card-body">
            <form name="frm" method="post">
                <input type="hidden" id="commentid" name="Pcommentid" value="0">
                <div class="nav-item mb-2 mt-0">
                <a href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav" role="button" aria-expanded="false">
                  <?php 
                  $getImg = mysqli_query($db, "SELECT img FROM tbl_super_ad WHERE admin_id = '$admin_id'");
                        while ($row = mysqli_fetch_array($getImg)) {
                  if (empty($row['img'])) {
                    echo '<img class="avatar" style="height:45px; width:45px; margin-bottom: 7px;" src="../../assets/img/image.png"/>';
                  } else {
                    echo ' <img class="avatar" style="height:45px; width:45px; margin-bottom: 7px;" src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" "/>';
                  } }?>

                  <label class="text-bold ms-1 ps-1"><?php echo $user_name ?></span>
                </a>
                <div class="form-group mb-3 text-black">
                    <label for="comment">Your Question:</label>
                    <textarea class="form-control" style="border: 1px solid black; border-radius: 10px; padding: 10px;" rows="5" name="msg" required></textarea>
                </div>
                <button type="button" id="butsave" name="save" class="btn btn-dark">Send</button>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h4>Recent Questions</h4>           
            <table class="table" id="MyTable" style="background-color: #fff; border:0px;border-radius:10px">
                <tbody id="record">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php } else if ($_SESSION['role'] == "Admin") { ?>
<div id="ReplyModal" class="modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" style="border: 1px solid black; height: 35px; border-radius: 10px; padding: 5px;" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reply Question</h4>
      </div>
      <div class="modal-body">
        <form name="frm1" method="post">
            <input type="hidden" id="commentid" name="Rcommentid">
        	<div class="form-group">
        	  <label for="usr">Write your name:</label>
        	  <input type="text" class="form-control" style="border: 1px solid black; border-radius: 10px; padding: 10px; margin-bottom: 10px;" name="Rname" required>
        	</div>
            <div class="form-group">
              <label for="comment">Write your reply:</label>
              <textarea class="form-control" style="border: 1px solid black; border-radius: 10px; padding: 10px; margin-bottom: 25px;" rows="5" name="Rmsg" required></textarea>
            </div>
        	 <input type="button" id="btnreply" name="btnreply" class="btn btn-dark" value="Reply">
      </form>
      </div>
    </div>

  </div>
</div>
</div>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0 text-white">Discussion Forum</h3>
        </div>
        <div class="card-body">
            <form name="frm" method="post">
                <input type="hidden" id="commentid" name="Pcommentid" value="0">
                <div class="nav-item mb-2 mt-0">
                <a href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav" role="button" aria-expanded="false">
                  <?php 
                  $getImg = mysqli_query($db, "SELECT img FROM tbl_admin WHERE ad_id = '$ad_id'");
                        while ($row = mysqli_fetch_array($getImg)) {
                  if (empty($row['img'])) {
                    echo '<img class="avatar" style="height:45px; width:45px; margin-bottom: 7px;" src="../../assets/img/image.png"/>';
                  } else {
                    echo ' <img class="avatar" style="height:45px; width:45px; margin-bottom: 7px;" src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" "/>';
                  } }?>

                  <label class="text-bold ms-1 ps-1"><?php echo $user_name ?></span>
                </a>
                <div class="form-group mb-3 text-black">
                    <label for="comment">Your Question:</label>
                    <textarea class="form-control" style="border: 1px solid black; border-radius: 10px; padding: 10px;" rows="5" name="msg" required></textarea>
                </div>
                <button type="button" id="butsave" name="save" class="btn btn-dark">Send</button>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h4>Recent Questions</h4>           
            <table class="table" id="MyTable" style="background-color: #fff; border:0px;border-radius:10px">
                <tbody id="record">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php } else if ($_SESSION['role'] == "Registrar") { ?>
<div id="ReplyModal" class="modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" style="border: 1px solid black; height: 35px; border-radius: 10px; padding: 5px;" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reply Question</h4>
      </div>
      <div class="modal-body">
        <form name="frm1" method="post">
            <input type="hidden" id="commentid" name="Rcommentid">
        	<div class="form-group">
        	  <label for="usr">Write your name:</label>
        	  <input type="text" class="form-control" style="border: 1px solid black; border-radius: 10px; padding: 10px; margin-bottom: 10px;" name="Rname" required>
        	</div>
            <div class="form-group">
              <label for="comment">Write your reply:</label>
              <textarea class="form-control" style="border: 1px solid black; border-radius: 10px; padding: 10px; margin-bottom: 25px;" rows="5" name="Rmsg" required></textarea>
            </div>
        	 <input type="button" id="btnreply" name="btnreply" class="btn btn-dark" value="Reply">
      </form>
      </div>
    </div>

  </div>
</div>
</div>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0 text-white">Discussion Forum</h3>
        </div>
        <div class="card-body">
            <form name="frm" method="post">
                <input type="hidden" id="commentid" name="Pcommentid" value="0">
                <div class="nav-item mb-2 mt-0">
                <a href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav" role="button" aria-expanded="false">
                  <?php 
                  $getImg = mysqli_query($db, "SELECT img FROM tbl_registrar WHERE reg_id = '$reg_id'");
                        while ($row = mysqli_fetch_array($getImg)) {
                  if (empty($row['img'])) {
                    echo '<img class="avatar" style="height:45px; width:45px; margin-bottom: 7px;" src="../../assets/img/image.png"/>';
                  } else {
                    echo ' <img class="avatar" style="height:45px; width:45px; margin-bottom: 7px;" src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" "/>';
                  } }?>

                  <label class="text-bold ms-1 ps-1"><?php echo $user_name ?></span>
                </a>
                <div class="form-group mb-3 text-black">
                    <label for="comment">Your Question:</label>
                    <textarea class="form-control" style="border: 1px solid black; border-radius: 10px; padding: 10px;" rows="5" name="msg" required></textarea>
                </div>
                <button type="button" id="butsave" name="save" class="btn btn-dark">Send</button>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h4>Recent Questions</h4>           
            <table class="table" id="MyTable" style="background-color: #fff; border:0px;border-radius:10px">
                <tbody id="record">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php } else if ($_SESSION['role'] == "Student") { ?>
<div id="ReplyModal" class="modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" style="border: 1px solid black; height: 35px; border-radius: 10px; padding: 5px;" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reply Question</h4>
      </div>
      <div class="modal-body">
        <form name="frm1" method="post">
            <input type="hidden" id="commentid" name="Rcommentid">
        	<div class="form-group">
        	  <label for="usr">Write your name:</label>
        	  <input type="text" class="form-control" style="border: 1px solid black; border-radius: 10px; padding: 10px; margin-bottom: 10px;" name="Rname" required>
        	</div>
            <div class="form-group">
              <label for="comment">Write your reply:</label>
              <textarea class="form-control" style="border: 1px solid black; border-radius: 10px; padding: 10px; margin-bottom: 25px;" rows="5" name="Rmsg" required></textarea>
            </div>
        	 <input type="button" id="btnreply" name="btnreply" class="btn btn-dark" value="Reply">
      </form>
      </div>
    </div>

  </div>
</div>
</div>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0 text-white">Discussion Forum</h3>
        </div>
        <div class="card-body">
            <form name="frm" method="post">
                <input type="hidden" id="commentid" name="Pcommentid" value="0">
                <div class="nav-item mb-2 mt-0">
                <a href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav" role="button" aria-expanded="false">
                  <?php 
                  $getImg = mysqli_query($db, "SELECT img FROM tbl_student WHERE student_id = '$student_id'");
                        while ($row = mysqli_fetch_array($getImg)) {
                  if (empty($row['img'])) {
                    echo '<img class="avatar" style="height:45px; width:45px; margin-bottom: 7px;" src="../../assets/img/image.png"/>';
                  } else {
                    echo ' <img class="avatar" style="height:45px; width:45px; margin-bottom: 7px;" src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" "/>';
                  } }?>

                  <label class="text-bold ms-1 ps-1"><?php echo $user_name ?></span>
                </a>
                <div class="form-group mb-3 text-black">
                    <label for="comment">Your Question:</label>
                    <textarea class="form-control" style="border: 1px solid black; border-radius: 10px; padding: 10px;" rows="5" name="msg" required></textarea>
                </div>
                <button type="button" id="butsave" name="save" class="btn btn-dark">Send</button>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h4>Recent Questions</h4>           
            <table class="table" id="MyTable" style="background-color: #fff; border:0px;border-radius:10px">
                <tbody id="record">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php } else if ($_SESSION['role'] == "Alum Stud") { ?>
<div id="ReplyModal" class="modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" style="border: 1px solid black; height: 35px; border-radius: 10px; padding: 5px;" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reply Question</h4>
      </div>
      <div class="modal-body">
        <form name="frm1" method="post">
            <input type="hidden" id="commentid" name="Rcommentid">
        	<div class="form-group">
        	  <label for="usr">Write your name:</label>
        	  <input type="text" class="form-control" style="border: 1px solid black; border-radius: 10px; padding: 10px; margin-bottom: 10px;" name="Rname" required>
        	</div>
            <div class="form-group">
              <label for="comment">Write your reply:</label>
              <textarea class="form-control" style="border: 1px solid black; border-radius: 10px; padding: 10px; margin-bottom: 25px;" rows="5" name="Rmsg" required></textarea>
            </div>
        	 <input type="button" id="btnreply" name="btnreply" class="btn btn-dark" value="Reply">
      </form>
      </div>
    </div>

  </div>
</div>
</div>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0 text-white">Discussion Forum</h3>
        </div>
        <div class="card-body">
            <form name="frm" method="post">
                <input type="hidden" id="commentid" name="Pcommentid" value="0">
                <div class="nav-item mb-2 mt-0">
                <a href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav" role="button" aria-expanded="false">
                  <?php 
                  $getImg = mysqli_query($db, "SELECT img FROM tbl_alumni WHERE alumni_id = '$alumni_id'");
                        while ($row = mysqli_fetch_array($getImg)) {
                  if (empty($row['img'])) {
                    echo '<img class="avatar" style="height:45px; width:45px; margin-bottom: 7px;" src="../../assets/img/image.png"/>';
                  } else {
                    echo ' <img class="avatar" style="height:45px; width:45px; margin-bottom: 7px;" src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" "/>';
                  } }?>

                  <label class="text-bold ms-1 ps-1"><?php echo $user_name ?></span>
                </a>
                <div class="form-group mb-3 text-black">
                    <label for="comment">Your Question:</label>
                    <textarea class="form-control" style="border: 1px solid black; border-radius: 10px; padding: 10px;" rows="5" name="msg" required></textarea>
                </div>
                <button type="button" id="butsave" name="save" class="btn btn-dark">Send</button>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h4>Recent Questions</h4>           
            <table class="table" id="MyTable" style="background-color: #fff; border:0px;border-radius:10px">
                <tbody id="record">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php } ?>

<?php include "../../includes/footer.php"?>
</body>
</html>
<!--   Core JS Files   -->
<?php include "../../includes/script.php"?>