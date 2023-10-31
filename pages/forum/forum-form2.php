<!DOCTYPE html>
<html lang="en">

<?php
include '../../includes/session.php';
// End Session
include '../../includes/head.php';
?>
<title>
  Forum
</title>

<body class="g-sidenav-show  bg-gray-200">

  <!-- sidebar -->
  <?php include "../../includes/sidebar.php"?>
  <!-- End sidebar -->

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php include "../../includes/navbar.php"?>
    <!-- End Navbar -->

<div id="ReplyModal" class="modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reply Question</h4>
      </div>
      <div class="modal-body">
        <form name="frm1" method="post">
            <input type="hidden" id="commentid" name="Rcommentid">
        	<div class="form-group">
        	  <label for="usr">Write your name:</label>
        	  <input type="text" class="form-control" name="Rname" required>
        	</div>
            <div class="form-group">
              <label for="comment">Write your reply:</label>
              <textarea class="form-control" rows="5" name="Rmsg" required></textarea>
            </div>
        	 <input type="button" id="btnreply" name="btnreply" class="btn btn-primary" value="Reply">
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
                <div class="form-group mb-2 text-black">
                    <label for="usr">Your Name:</label>
                    <input type="text" class="form-control" style="border: 1px solid black; border-radius: 10px; padding: 10px;" name="name" required>
                </div>
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








<?php include "../../includes/footer.php"?>
</main>
<!--   Core JS Files   -->
<?php include "../../includes/script.php"?>